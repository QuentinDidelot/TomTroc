<section class="messengerContainer">

<div class="allMessages">
        <h1>Messagerie</h1>
        <div class="conversationList">
                <?php if (!empty($conversations)): ?>
                    <?php foreach ($conversations as $conversation): ?>
                        <div class="conversationItem">
                            <a href="index.php?action=viewChat&recipient_id=<?= $conversation['other_user_id'] ?>" class="conversations">
                                <div>
                                    <h3><img src="uploads/profile_pictures/<?= $conversation['recipient_image'] ? : 'default_profile_image.png' ?>" class="profile_picture" alt=""><?= htmlspecialchars($conversation['other_user_name']) ?></h3>
                                    <?php if (!empty($conversation['last_sent_message'])): ?>
                                        <p>Dernier message envoyé : <?= htmlspecialchars($conversation['last_sent_message']) ?></p>
                                    <?php elseif (!empty($conversation['last_received_message'])): ?>
                                        <p>Dernier message reçu : <?= htmlspecialchars($conversation['last_received_message']) ?></p>
                                    <?php else: ?>
                                        <p>Aucun message dans cette conversation.</p>
                                    <?php endif; ?>
                                    <p>Date du dernier message : <?= date('d/m H:i', strtotime($conversation['last_message_date'])) ?></p>
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
            if (isset($_GET['recipient_id'])) {
                $recipientId = $_GET['recipient_id'];
                $otherUserName = ''; 
                
                foreach ($conversations as $conversation) {
                    if ($conversation['other_user_id'] == $recipientId) {
                        $otherUserName = htmlspecialchars($conversation['other_user_name']);
                        break;
                    }
                }
            }
            ?>
            <div>
                <img src="uploads/profile_pictures/<?= $conversation['recipient_image'] ? : 'default_profile_image.png' ?>" class="profile_picture" alt="">
                <?= $conversation['other_user_name'] ?>
            </div>

        </h2>

        <div class="chatMessages">
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $message): ?>
      
                    <div class="message <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>">
                        <div class="messageMeta <?= $message['sender_id'] == $_SESSION['user_id'] ? 'text-right' : '' ?>">
                            <span class="messageDate"><?= htmlspecialchars($message['formatted_sent_date']) ?></span>
                        </div>
                        <div class="messageContent">
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
                <input type="text" name="content" placeholder="Tapez votre message ici">
                <button type="submit" class="button_type_1">Envoyer</button>
            </form>
        </div>
    </div>

</section>