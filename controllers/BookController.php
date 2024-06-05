<?php

class BookController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    { 
        $view = new View("Accueil");
        $view->render("home");
    }

    /**
     * Affiche la page avec tous les livres à disposition.
     * @return void
     */
    public function showAllBook() : void
    {
        $bookManager = new BookManager(); 
        $books = $bookManager->getAllBookWithOwner();

        $view = new View("Tous nos livres");
        $view->render("allBook", ['books' => $books]);
    }
}