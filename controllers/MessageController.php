<?php

class MessageController
{
    private $messageManager;
    private $conversationManager;

    public function __construct()
    {
        // Initialisez votre MessageManager dans le constructeur
        $this->messageManager = new MessageManager();
        $this->conversationManager = new MessageManager();
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
     * Affiche la page "Messagerie" avec les messages et les conversations de l'utilisateur connecté.
     * @return void
     */
    public function showMessenger() : void 
    {
        $this->checkIfUserIsConnected();
    
        $userId = $_SESSION['user_id'];
    
        // Récupération des messages
        $allMessages = $this->messageManager->getMessages($userId);
    
        // Récupération des conversations
        $conversations = $this->conversationManager->getConversations($userId);
    
        $view = new View("Messagerie");
        $view->render("messenger", [
            'messages' => $allMessages,
            'conversations' => $conversations
        ]);
    }


    /**
     * Envoie un message à un destinataire spécifique.
     * @return void
     */
    public function sendMessage() : void
    {
        $this->checkIfUserIsConnected();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $senderId = $_SESSION['user_id'];
            $recipientId = $_POST['recipient_id'];
            $content = $_POST['content'];
            
            if ($this->messageManager->sendMessage($senderId, $recipientId, $content)) {
                // Redirection vers la vue de conversation avec le destinataire
                Utils::redirect("viewChat&recipient_id=" . $recipientId);
            } else {
                // Gestion de l'erreur d'envoi
                echo "Erreur lors de l'envoi du message.";
            }
        }
    }
    

    /**
     * Affiche la conversation avec un destinataire spécifique.
     * @return void
     */

     public function viewChat() : void
     {
         $this->checkIfUserIsConnected();
         
         $userId = $_SESSION['user_id'];
         $recipientId = $_GET['recipient_id'] ?? null;
         
         if (!$recipientId) {
             echo "Destinataire non spécifié.";
             return;
         }
         
         $messages = $this->messageManager->getMessages($userId, $recipientId);
         $conversations = $this->conversationManager->getConversations($userId);
         
         $view = new View("Messagerie");
         $view->render("messenger", [
             'messages' => $messages,
             'conversations' => $conversations,
             'recipientId' => $recipientId
         ]);
     }
}
?>
