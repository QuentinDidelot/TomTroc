<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

// On récupère l'action demandée par l'utilisateur.
// Si aucune action n'est demandée, on affiche la page d'accueil.
$action = Utils::request('action', 'home');

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {


        // Pages accessibles à tous.
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;

        case 'allBook':
            $bookController = new BookController();
            $bookController->showAllBook();
            break;

        case 'bookDetail':
            $bookController = New BookController();
            $bookController->showBookDetail();
            break;
            
        case 'showBooksByTitle':
            $bookController = new BookController();
            $bookController->showBooksByTitle();
            break;

        case 'myAccount' :
            $bookController = new BookController();
            $bookController->showMyAccount();
            break;
            
        // Section admin & connexion.    
        
        case 'inscriptionForm':
            $adminController = new AdminController();
            $adminController->displayInscriptionForm();
            break;

        case 'inscriptionUser':
            $adminController = new AdminController();
            $adminController->inscriptionUser();
            break;

        case 'connectionForm':
            $adminController = new AdminController();
            $adminController->displayConnectionForm();
            break;

        case 'connectUser': 
            $adminController = new AdminController();
            $adminController->connectUser();
            break;    

        case 'disconnectUser':
            $adminController = new AdminController();
            $adminController->disconnectUser();
            break;
            
        default:
        throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
?>