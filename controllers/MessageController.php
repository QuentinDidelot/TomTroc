<?php

    class MessageController
    {
        private $messageManager;

        public function __construct()
        {
            // Initialisez votre MessageManager dans le constructeur
            $this->messageManager = new MessageManager();
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
         * Affiche la page "Messagerie" si l'utilisateur est connecté.
         * @return void
         */
        public function showMessenger() : void 
        {
            $this->checkIfUserIsConnected();
        
            $userId = $_SESSION['user_id'];
        
            
            $bookManager = new BookManager();
            $bookId = Utils::request('book_id'); 

            $sentMessages = $this->messageManager->getMessagesBySender($userId);
            $receivedMessages = $this->messageManager->getMessagesByRecipient($userId);
        
            $view = new View("Messagerie");
            $view->render("messenger", [
                'sentMessages' => $sentMessages,
                'receivedMessages' => $receivedMessages,
            ]);
        }
        
    }
