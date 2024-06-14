<?php 
/**
 * Contrôleur de la partie utilisateur.
 */
 
class UserController {


    /**
     * Affichage du profil utilisateur
     * @return void
     */
    public function showPublicAccount() : void 
    {
        $view = new View("Profil");
        $view->render("publicAccount");
    }

}