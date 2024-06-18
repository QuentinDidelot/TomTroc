<?php

/**
 * Classe qui gère la messagerie
 */
class MessageManager extends AbstractEntityManager{

    public function getMessagesBySender($senderId) {
        $sql = "SELECT * FROM `message` WHERE `sender_id` = ?";
        $result = $this->db->getPDO()->prepare($sql);
        $result->execute([$senderId]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessagesByRecipient($recipientId) {
        $sql = "SELECT * FROM `message` WHERE `recipient_id` = ?";
        $result = $this->db->getPDO()->prepare($sql);
        $result->execute([$recipientId]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function sendMessage($senderId, $recipientId, $content) {
        $sql = "INSERT INTO `message` (`sender_id`, `recipient_id`, `content`) VALUES (?, ?, ?)";
        $result = $this->db->getPDO()->prepare($sql);
        $result->execute([$senderId, $recipientId, $content]);
        return $this->pdo->lastInsertId();
    }
}