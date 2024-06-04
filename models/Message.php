<?php   

/**
 * Entité Message : un "message" est défini par son id, l'id de l'expéditeur, l'id du destinataire, le contenu du message et sa date d'envoi.
 */

 class Message extends AbstractEntity {

    private int $senderId;
    private int $recipientId;
    private string $content;
    private DateTime $sentDate;
 }