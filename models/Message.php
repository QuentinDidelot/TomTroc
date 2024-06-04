<?php   

/**
 * Entité Message : un "message" est défini par son id, l'id de l'expéditeur, l'id du destinataire, le contenu du message et sa date d'envoi.
 */

 class Message extends AbstractEntity {

    private int $senderId;
    private int $recipientId;
    private string $content;
    private DateTime $sentDate;

    /**
     * Getter pour l'id de l'expéditeur.
     * @return int
     */
    public function getSenderId(): int 
    {
        return $this->senderId;
    }

    /**
     * Setter pour l'id de l'expéditeur.
     * @param int $senderId
     * @return void
     */
    public function setSenderId(int $senderId): void 
    {
        $this->senderId = $senderId;
    }

    /**
     * Getter pour l'id du destinataire.
     * @return int
     */
    public function getRecipientId(): int 
    {
        return $this->recipientId;
    }

    /**
     * Setter pour l'id du destinataire.
     * @param int $recipientId
     * @return void
     */
    public function setRecipientId(int $recipientId): void 
    {
        $this->recipientId = $recipientId;
    }

    /**
     * Getter pour le contenu.
     * @return string
     */
    public function getContent(): string 
    {
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void 
    {
        $this->content = $content;
    }

        /**
     * Getter pour la date d'envoi.
     * @return DateTime
     */
    public function getSentDate() : DateTime
    {
        return $this->sentDate;
    }
 

    /**
     * Setter pour la date d'envoi. 
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $sentDate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setSentDate(string|DateTime $sentDate, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($sentDate)) {
            $sentDate = DateTime::createFromFormat($format, $sentDate);
        }
        $this->sentDate = $sentDate;
    }
 }