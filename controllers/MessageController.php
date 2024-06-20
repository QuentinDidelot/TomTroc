<?php

class MessageController
{
    private $messageManager;
    private $conversationManager;

    public function __construct()
    {
        
        $this->messageManager = new MessageManager();
        $this->conversationManager = new MessageManager();
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
        $conversations = $this->conversationManager->getConversations($userId);

        // Déterminer le recipientId de la conversation la plus récente par défaut
        $recipientId = isset($conversations[0]['other_user_id']) ? $conversations[0]['other_user_id'] : null;

        // Récupération des messages pour la conversation la plus récente
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
