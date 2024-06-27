<?php
    /**
     * Affichage de la messagerie
     */
?>

<section class="messengerContainer">
    <div class="allMessages">
        <h1>Messagerie</h1>
        <div class="conversationList">
    <?php if (!empty($conversations)): ?>
        <?php foreach ($conversations as $conversation): ?>
            <div class="conversationItem  <?= $conversation['other_user_id'] == $_GET['recipient_id'] ? 'activeConversation' : '' ?>">
                <a href="index.php?action=viewChat&recipient_id=<?= $conversation['other_user_id'] ?>" class="conversations">
                    <div class="conversationChoice">
                        <img src="uploads/profile_pictures/<?= $conversation['recipient_image'] ?: 'default_profile_image.png' ?>" class="profile_picture_messenger" alt="">
                        <div class="conversationText">
                            <h3 class="conversationName"><?= htmlspecialchars($conversation['other_user_name']) ?></h3>
                            <p class="conversationMessage">
                                <?= htmlspecialchars($conversation['last_message']) ?>
                            </p>
                        </div>
                        <p class="conversationTime">
                            <?php 
                            $lastMessageDate = strtotime($conversation['last_message_date']);
                            if (date('Y-m-d', $lastMessageDate) == date('Y-m-d')) {
                                echo date('H:i', $lastMessageDate); // Affiche l'heure si le message est d'aujourd'hui
                            } else {
                                echo date('d.m', $lastMessageDate); // Affiche la date si le message est d'un autre jour
                            }
                            ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune conversation disponible.</p>
    <?php endif; ?>
</div>

    </div>

    <div class="currentChat">
        <h2>
            <?php
            $recipientId = null;
            $otherUserName = ''; 
            $recipientImage = 'default_profile_image.png';
            
            if (isset($_GET['recipient_id'])) {
                $recipientId = $_GET['recipient_id'];
                
                $userManager = new UserManager();
                $recipientUser = $userManager->getUserById($recipientId);
                
                if ($recipientUser) {
                    $otherUserName = htmlspecialchars($recipientUser->getPseudo());
                    $recipientImage =  ($recipientUser->getProfileImage() ?: 'default_profile_image.png');
                }
            }
            ?>
            <div class="chatHeader">
                <img src="uploads/profile_pictures/<?= $recipientImage ?>" class="profile_picture_messenger" alt="Profile Picture">
                <?= $otherUserName ?>
            </div>
        </h2>

        <div class="chatMessages">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>">
                        <div class="messageDateAndPicture">  
                            <?php if ($message['sender_id'] != $_SESSION['user_id']): ?>
                                <img src="uploads/profile_pictures/<?= $recipientImage ?>" class="profile_picture_message" alt="">
                            <?php endif; ?>
                            <?= htmlspecialchars($message['formatted_sent_date']) ?>
                        </div>
                        <div class="messageContent <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>">
                            <?= htmlspecialchars($message['content']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun message dans cette conversation.</p>
            <?php endif; ?>
        </div>



        <div class="chatInput">
            <form action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="recipient_id" value="<?= $recipientId ?>">
                <input type="text" name="content" autocomplete="off"  placeholder="Tapez votre message ici">
                <button type="submit" class="button_type_1">Envoyer</button>
            </form>
        </div>
    </div>
</section>
