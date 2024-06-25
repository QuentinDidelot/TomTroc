<?php

/**
 * Classe qui gère la messagerie
 */
class MessageManager extends AbstractEntityManager
{

    /**
     * Récupère les messages entre un utilisateur et un destinataire spécifique,
     * ou tous les messages impliquant un utilisateur si aucun destinataire spécifique n'est fourni.
     * @param int $userId L'ID de l'utilisateur dont on veut récupérer les messages.
     * @param int|null $recipientId L'ID du destinataire spécifique, ou null pour récupérer tous les messages impliquant l'utilisateur.
     * @return array Tableau contenant les messages.
     */
    public function getMessages($userId, $recipientId = null) 
    {
        if ($recipientId !== null) {
            $sql = "SELECT *, DATE_FORMAT(sent_date, '%d.%m %H:%i') AS formatted_sent_date FROM message 
                    WHERE (sender_id = :userId AND recipient_id = :recipientId) 
                    OR (sender_id = :recipientId AND recipient_id = :userId) 
                    ORDER BY sent_date ASC";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':recipientId', $recipientId);
        } else {
            return [];
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    /**
     * Envoie un message d'un utilisateur à un destinataire spécifique.
     * 
     * @param int $senderId L'ID de l'utilisateur qui envoie le message.
     * @param int $recipientId L'ID du destinataire du message.
     * @param string $content Le contenu du message.
     * @return bool Retourne true en cas de succès, false en cas d'échec.
     */
    public function sendMessage($senderId, $recipientId, $content)
    {
        $sql = "INSERT INTO message (sender_id, recipient_id, content, sent_date) VALUES (?, ?, ?, NOW())";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$senderId, $recipientId, $content]);
    }

    /**
     * Récupère les conversations d'un utilisateur avec les détails du destinataire.
     * 
     * @param int $userId L'ID de l'utilisateur dont on veut récupérer les conversations.
     * @return array Tableau contenant les conversations.
     */
    public function getConversations($userId) 
    {
        $sql = "SELECT 
                    CASE
                        WHEN sender_id = :userId THEN recipient_id
                        ELSE sender_id
                    END AS other_user_id,
                    CASE
                        WHEN sender_id = :userId THEN users2.pseudo
                        ELSE users1.pseudo
                    END AS other_user_name,
                    MAX(sent_date) AS last_message_date,
                    (SELECT content
                     FROM message
                     WHERE (sender_id = conversations.sender_id AND recipient_id = conversations.recipient_id) 
                     OR (sender_id = conversations.recipient_id AND recipient_id = conversations.sender_id)
                     ORDER BY sent_date DESC
                     LIMIT 1) AS last_message,
                    CASE
                        WHEN recipient_id = :userId THEN users1.profile_image
                        ELSE users2.profile_image
                    END AS recipient_image
                FROM
                    (SELECT 
                        sender_id, recipient_id, sent_date
                    FROM 
                        message
                    WHERE 
                        sender_id = :userId OR recipient_id = :userId
                    ORDER BY 
                        sent_date ASC
                    ) AS conversations
                JOIN
                    user AS users1 ON conversations.sender_id = users1.id
                JOIN
                    user AS users2 ON conversations.recipient_id = users2.id
                GROUP BY 
                    other_user_id, other_user_name
                ORDER BY 
                    MAX(sent_date) DESC";
        
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
