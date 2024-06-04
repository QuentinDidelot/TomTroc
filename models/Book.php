<?php   

/**
 * Entité Book : un "book" est défini par son id, son userId, son titre, son auteur, son image de couverture, sa description et sa disponibilité.
 */

 class Book extends AbstractEntity {

    private int $userId;
    private string $title;
    private string $author;
    private string $image;
    private string $description;
    private string $availability;


    /**
     * Getter pour le userId.
     * @return int
     */
    public function getUserId() : int 
    {
        return $this->userId;
    }


    /**
     * Setter pour le userId.
     * @param int $userId
     */
    public function setUserId(int $userId) : void 
    {
        $this->userId = $userId;
    }

    /**
     * Getter pour le title.
     * @return string
     */
    public function getTitle() : string 
    {
        return $this->title;
    }


    /**
     * Setter pour le title.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour l'auteur'.
     * @return string
     */
    public function getAuthor() : string 
    {
        return $this->author;
    }


    /**
     * Setter pour l'auteur'.
     * @param string $author
     */
    public function setAuthor(string $author) : void 
    {
        $this->author = $author;
    }

    /**
     * Getter pour l'image du livre.
     * @return string
     */
    public function getImage() : string 
    {
        return $this->image;
    }


    /**
     * Setter pour l'image du livre.
     * @param string $image
     */
    public function setImage(string $image) : void 
    {
        $this->image = $image;
    }

    /**
     * Getter pour la description.
     * @return string
     */
    public function getDescription() : string 
    {
        return $this->description;
    }


    /**
     * Setter pour la description.
     * @param string $description
     */
    public function setDescription(string $description) : void 
    {
        $this->description = $description;
    }

    /**
     * Getter pour la disponibilité.
     * @return string
     */
    public function getAvailability() : string 
    {
        return $this->availability;
    }


    /**
     * Setter pour la disponibilité.
     * @param string $availability
     */
    public function setAvailability(string $availability) : void 
    {
        $this->availability = $availability;
    }

 }