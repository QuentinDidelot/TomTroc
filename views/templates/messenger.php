<section class="messengerContainer">

    <div class="allMessages">
        <h1>Messagerie</h1>
        <div class="messageList">
            <div class="messageItem">Message 1</div>
            <div class="messageItem">Message 2</div>
            <div class="messageItem">Message 3</div>
        </div>
    </div>

    <div class="currentChat">
        <div class="chatHeader">
            <img src="img\HK.jpg" class="detail_profile_picture" alt="image de profil">
            <span>Admin</span>
        </div>
        <div class="chatMessages">
            <div class="message received">Bonjour !</div>
            <div class="message sent">Salut !</div>
            <div class="message received">Comment ça va ?</div>
        </div>
        <div >
            <form class="chatInput" action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="recipient_id" value="">
                <input type="text" name="content" placeholder="Tapez votre message ici">
                <button type="submit" class="button_type_1">Envoyer</button>
            </form>
        </div>
    </div>

</section>
