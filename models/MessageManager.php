<?php

/**
 * Classe qui gère la messagerie
 */
class MessageManager extends AbstractEntityManager
{
    public function getMessages($userId, $recipientId = null) 
    {
        if ($recipientId !== null) {
            $sql = "SELECT * FROM message 
                    WHERE (sender_id = :userId AND recipient_id = :recipientId) 
                    OR (sender_id = :recipientId AND recipient_id = :userId) 
                    ORDER BY sent_date ASC";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':recipientId', $recipientId);
        } else {
            $sql = "SELECT * FROM message 
                    WHERE sender_id = :userId OR recipient_id = :userId 
                    ORDER BY sent_date ASC";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->bindParam(':userId', $userId);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMessage($senderId, $recipientId, $content)
    {

        $sql = "INSERT INTO message (sender_id, recipient_id, content) VALUES (?, ?, ?)";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([$senderId, $recipientId, $content]);
    }

    /**
     * Récupère toutes les conversations d'un utilisateur avec les détails du destinataire.
     * @param int $userId L'ID de l'utilisateur dont on veut récupérer les conversations.
     * @return array Tableau contenant les conversations.
     */
    public function getConversations($userId)
    {
        // Requête pour récupérer les conversations avec les détails du destinataire
        $sql = "SELECT m.id, m.sender_id, m.recipient_id, m.content, m.sent_date,
                         u.pseudo AS sender_name,
                         u2.pseudo AS recipient_name
                  FROM message m
                  INNER JOIN user u ON m.sender_id = u.id
                  INNER JOIN user u2 ON m.recipient_id = u2.id
                  WHERE m.sender_id = ? OR m.recipient_id = ?
                  GROUP BY m.sender_id, m.recipient_id
                  ORDER BY m.sent_date DESC";
        
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->execute([$userId, $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
