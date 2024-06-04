<?php

class BookController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $bookController = new BookController(); 
        $view = new View("Accueil");
        $view->render("home");
    }
}