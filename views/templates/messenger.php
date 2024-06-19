<section class="messengerContainer">

    <div class="allMessages">
        <h1>Messagerie</h1>
        <div class="conversationList">
            <?php if (!empty($conversations)): ?>
                <?php foreach ($conversations as $conversation): ?>
                    <div class="conversationItem">
                        <a href="index.php?action=viewChat&recipient_id=<?= $conversation['recipient_id'] ?>">
                            Conversation avec <?= $conversation['recipient_name'] ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune conversation disponible.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="currentChat">
        <div class="chatMessages">
            <?php foreach ($messages as $message): ?>
                <div class="message <?= $message['sender_id'] == $_SESSION['user_id'] ? 'sent' : 'received' ?>">
                    <?= htmlspecialchars($message['content']) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="chatInput">
            <form action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="recipient_id" value="<?= isset($_GET['recipient_id']) ? $_GET['recipient_id'] : '' ?>">
                <input type="text" name="content" placeholder="Tapez votre message ici">
                <button type="submit" class="button_type_1">Envoyer</button>
            </form>
        </div>
    </div>

</section>
