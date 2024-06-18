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

        // Vérifier si l'email est déjà utilisé
        $userManager = new UserManager();
        if ($userManager->emailExists($email)) {
            $errorMessage = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
            $view = new View("Inscription");
            $view->render("inscriptionForm", ['errorMessage' => $errorMessage]);
            exit;
        }
    
        // Appeler le manager pour inscrire l'utilisateur
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
            $_SESSION['error'] = $e->getMessage();
            Utils::redirect("connectionForm");
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


    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // Si l'utilisateur est connecté alors on récupère son ID.
        if (!isset($_SESSION['user_id'])) {
            // Rediriger vers la page de connexion ou afficher une erreur
            Utils::redirect("connectionForm");
            exit;
        }
    }

    /**
     * Affiche la page "Mon compte" si l'utilisateur est connecté
     * @return void
     */
    public function showMyAccount() : void 
    {
        $this->checkIfUserIsConnected();

        $userId = $_SESSION['user_id'];

        $bookManager = new BookManager();
        $userManager = new UserManager();


        
        $books = $bookManager->getAllBooksByUser($userId);
        $user = $userManager->getUserById($userId);

        $view = new View("Mon Compte");
        $view->render("myAccount", ['books' => $books, 'user' => $user]);
    }

    /**
     * Affiche la page "Messagerie" si l'utilisateur est connecté
     * @return void
     */
    public function showMessenger() : void 
    {
        $this->checkIfUserIsConnected();

        $userId = $_SESSION['user_id'];


        $view = new View("Messagerie");
        $view->render("messenger");
    }

    /**
     * Affichage du formulaire d'édition de livre.
     * @return void
     */
    public function showUpdateBookForm() : void 
    {
        $this->checkIfUserIsConnected();
        
        $id = Utils::request('id');
        if (!$id) {
            throw new Exception("ID du livre non spécifié.");
        }
    
        $bookManager = new BookManager();
        $book = $bookManager->getBookById($id);
    
        if (!$book) {
            throw new Exception("Le livre demandé n'existe pas.");
        }
        
        $view = new View("Edition d'un livre");
        $view->render("updateBookForm", ['book' => $book]);
    }

    /**
     * Met à jour les informations d'un livre.
     * @return void
     */
    public function updateBook() : void
    {
        $this->checkIfUserIsConnected();
        
        $id = Utils::request('bookId');
        $title = Utils::request('title');
        $author = Utils::request('author');
        $description = Utils::request('description');
        $availability = Utils::request('availability');

        $bookManager = new BookManager();
        $bookManager->updateBook($id, $title, $author, $description, $availability);

        Utils::redirect('myAccount');
    }


    /**
     * Met à jour les informations de l'utilisateur
     * @return void
     */
    public function updateInfoUser() : void
    {
        $this->checkIfUserIsConnected();

        $id = $_SESSION['user_id'];
        $pseudo = Utils::request('pseudo');
        $email = Utils::request('email');
        $password = Utils::request('password');

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $userManager = new UserManager();
        $userManager->updateInfoUser($id, $pseudo, $email, $hashedPassword);

        Utils::redirect('myAccount');
    }

    /**
     * Met à jour la photo d'un livre.
     * @return void
     */
    public function updateBookPhoto() : void
    {
        $this->checkIfUserIsConnected();
        
        $bookId = Utils::request('bookId');
        $bookManager = new BookManager();

        // Gestion du téléchargement de la nouvelle image
        if ($_FILES['new_book_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = $this->handleBookImageUpload();

            if ($uploadResult['success']) {
                $bookManager->updateBookPhoto($bookId, $uploadResult['filePath']);
                Utils::redirect('updateBookForm&id=' . $bookId);
            } else {
                throw new Exception($uploadResult['message']);
            }
        } else {
            throw new Exception("Erreur lors du téléchargement de l'image.");
        }
    }

    public function deleteBook() : void
    {
        $this->checkIfUserIsConnected();
        
        $bookId = Utils::request('id'); 
        $bookManager = new BookManager();
        
        
        $bookManager->deleteBook($bookId);
        
        Utils::redirect('myAccount');
    }


    /**
     * Gère le téléchargement de la nouvelle image de livre.
     * @return array : Résultat du téléchargement (success, message, filePath).
     */
    private function handleBookImageUpload() : array
    {
        $targetDir = "uploads/book_covers/";
        $targetFile = $targetDir . basename($_FILES["new_book_image"]["name"]);
    
        if ($_FILES["new_book_image"]["error"] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => "Erreur lors du téléchargement: code " . $_FILES["new_book_image"]["error"]];
        }
    
        // Check file size
        if ($_FILES["new_book_image"]["size"] > 500000) {
            return ['success' => false, 'message' => "Le fichier est trop volumineux. Assurez-vous qu'il ne dépasse pas 500 KB."];
        }
    
        // Allow certain file formats
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES["new_book_image"]["type"], $allowedTypes)) {
            return ['success' => false, 'message' => "Type de fichier non autorisé. Seuls les fichiers JPG, PNG et GIF sont autorisés."];
        }
    
        // Move uploaded file
        if (move_uploaded_file($_FILES["new_book_image"]["tmp_name"], $targetFile)) {
            return ['success' => true, 'message' => "L'image du livre a été mise à jour.", 'filePath' => $targetFile];
        } else {
            return ['success' => false, 'message' => "Erreur lors du déplacement du fichier téléchargé."];
        }
    }


    /**
     * Met à jour l'image de profil de l'utilisateur.
     * @return void
     */
    public function updateProfileImage() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['new_profile_image'])) {
            $userId = $_SESSION['user_id'];
            $profileImage = $_FILES['new_profile_image'];
    
            if ($profileImage['error'] === UPLOAD_ERR_OK) {
                $targetDir = "uploads/profile_pictures/";
                $targetFile = $targetDir . basename($profileImage["name"]);
                move_uploaded_file($profileImage["tmp_name"], $targetFile);
    
                $userManager = new UserManager();
                $userManager->updateProfileImage($userId, $targetFile);
    
                // Redirection vers la page de profil après la mise à jour
                Utils::redirect("myAccount");
            } else {
                throw new Exception("Erreur lors du téléchargement de l'image.");
            }
        }
    }

    private function handleProfilePictureUpload(): array 
    {
        $targetDir = "uploads/profile_pictures/"; // Dossier où sauvegarder les fichiers
        $targetFile = $targetDir . basename($_FILES["new_profile_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Vérifie si le fichier image est réel ou une fausse image
        $check = getimagesize($_FILES["new_profile_image"]["tmp_name"]);
        if ($check === false) {
            return ['success' => false, 'message' => "Le fichier n'est pas une image."];
        }

        // Vérifie si le fichier existe déjà
        if (file_exists($targetFile)) {
            return ['success' => false, 'message' => "Désolé, ce fichier existe déjà."];
        }

        // Vérifie la taille du fichier
        if ($_FILES["new_profile_image"]["size"] > 500000) {
            return ['success' => false, 'message' => "Désolé, votre fichier est trop volumineux."];
        }

        // Autorise certains formats de fichiers
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            return ['success' => false, 'message' => "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés."];
        }

        // Essayez de télécharger le fichier
        if (move_uploaded_file($_FILES["new_profile_image"]["tmp_name"], $targetFile)) {
            return ['success' => true, 'filePath' => $targetFile];
        } else {
            return ['success' => false, 'message' => "Désolé, une erreur s'est produite lors du téléchargement de votre fichier."];
        }
    }
}