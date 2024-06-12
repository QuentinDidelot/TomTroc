<?php 
/**
 * Contrôleur de la partie connexion/inscription.
 */
 
class AdminController {

    /**
     * Affichage du formulaire de connexion.
     * @return void
     */
    public function displayConnectionForm() : void 
    {
        $view = new View("Connexion");
        $view->render("connectionForm");
    }

    /**
     * Affichage du formulaire d'inscription.
     * @return void
     */
    public function displayInscriptionForm() : void 
    {
        $view = new View("Inscription");
        $view->render("inscriptionForm");
    }

    /**
     * Inscription du visiteur
     * @return void
     */
    public function inscriptionUser() : void
    {

        // Récupérer les données du formulaire
        $pseudo = Utils::request('pseudo');
        $email = Utils::request('email');
        $password = Utils::request('password');

        // Appeler le manager pour inscrire l'utilisateur
        $userManager = new UserManager();
        $result = $userManager->inscriptionUser($pseudo, $email, $password);

        if ($result['status'] === 'success') {
            // Redirection vers la page de connexion ou un autre succès
            $view = new View("Accueil");
            $view->render("home");
            exit;
        } else {
            // Affichage du message d'erreur
            $view = new View("Inscription");
            $view->render("inscriptionForm", ['errorMessage' => $result['message']]);
        }
    }

    /**
     * Connexion de l'utilisateur.
     * @return void
     */
    public function connectUser() : void 
    {
        try {
            // On récupère les données du formulaire.
            $email = Utils::request("email");
            $password = Utils::request("password");

            // On vérifie que les données sont valides.
            if (empty($email) || empty($password)) {
                throw new Exception("Tous les champs sont obligatoires.");
            }

            // On vérifie que l'utilisateur existe.
            $userManager = new UserManager();
            $user = $userManager->getUserByEmail($email);
            if (!$user) {
                throw new Exception("L'utilisateur demandé n'existe pas.");
            }

            // On vérifie que le mot de passe est correct.
            if (!password_verify($password, $user->getPassword())) {
                throw new Exception("Le mot de passe est incorrect.");
            }

            // On démarre la session si ce n'est pas déjà fait.
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // On connecte l'utilisateur.
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user->getId();  // Assurez-vous que cette méthode existe et retourne l'ID utilisateur

            // On redirige vers la page d'accueil.
            Utils::redirect("home");
        } catch (Exception $e) {
            // Gérer les erreurs de connexion
            // Vous pouvez rediriger l'utilisateur vers le formulaire de connexion avec un message d'erreur
            Utils::redirect("connectionForm", ['error' => $e->getMessage()]);
        }
    }

    /**
     * Déconnexion de l'utilisateur.
     * @return void
     */
    public function disconnectUser() : void 
    {
        // On déconnecte l'utilisateur.
        unset($_SESSION['user_id']);

        // On redirige vers la page d'accueil.
        Utils::redirect("home");
    }
}
