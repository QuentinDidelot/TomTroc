<?php

class BookController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    { 
        $bookManager = new BookManager();
        $lastFourBooks = $bookManager->getLastFourBooks();

        $view = new View("Accueil");
        $view->render("home",['lastFourBooks' => $lastFourBooks]);
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


    /**
     * Affiche la page avec les détails du livre choisi
     * @return void
     */
    public function showBookDetail() : void
    {
        // Récupération de l'id du livre demandé.
        $id = Utils::request("id", -1);
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }
        $view = new View("Détail du livres");
        $view->render("bookDetail", ['book' => $book]);
    }
    
    
    /**
     * Affiche la page avec les livres filtrés par titre.
     * @return void
     */
    public function showBooksByTitle() : void
    {
        $titleSearch = isset($_GET['title']) ? $_GET['title'] : '';
        
        $bookManager = new BookManager(); 
        $books = $bookManager->getBooksByTitle($titleSearch);

        $view = new View("Livres filtrés par titre");
        $view->render("allBook", ['books' => $books]);
    }

    /**
     * Affiche la page "Mon compte" si l'utilisateur est connecté
     * @return void
     */
    public function showMyAccount() : void 
    {
       // Récupération de l'id du livre demandé.

        $bookManager = new BookManager();
        $userManager = new UserManager();

        // $user =;
        // $books =;

        $view = new View("Mon Compte");
        $view->render("myAccount");
    }
}
