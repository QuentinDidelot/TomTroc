<?php

class MessageController
{
    private $messageManager;

    public function __construct()
    {
        $this->messageManager = new MessageManager();
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!isset($_SESSION['user_id'])) {
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
    
    // Récupération des conversations
    $conversations = $this->messageManager->getConversations($userId);

    // Récupération des messages pour le destinataire spécifique ou un tableau vide s'il n'y a pas de destinataire
    $recipientId = $_GET['recipient_id'] ?? null;
    $messages = $recipientId ? $this->messageManager->getMessages($userId, $recipientId) : [];
    
    $view = new View("Messagerie");
    $view->render("messenger", [
        'messages' => $messages,
        'conversations' => $conversations,
        'recipientId' => $recipientId
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
         
        // Charge les messages pour la conversation en cours
        $messages = $this->messageManager->getMessages($userId, $recipientId);
         
        // Charge les conversations de l'utilisateur pour l'affichage dans la vue
        $conversations = $this->messageManager->getConversations($userId);
         
        $view = new View("Messagerie");
        $view->render("messenger", [
            'messages' => $messages,
            'conversations' => $conversations,
            'recipientId' => $recipientId
        ]);
    }
}

?>
