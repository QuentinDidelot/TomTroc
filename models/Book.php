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
    private DateTime $registrationDate;
    private string $availability;
 }