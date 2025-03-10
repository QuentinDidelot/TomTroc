<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/d8c1f4a5b2.js" crossorigin="anonymous"></script>
        <script src="js/profile.js"></script>
        <link rel="icon" type="image/png" href="img/icones/header.png">
        <link rel="stylesheet" href="./css/style.css">
        <title>TomTroc</title>
    </head>

    <body>
        <div class="main_container">

<!---------------------------- HEADER ---------------------------->

            <header>
            <nav>
                <div class="nav_left">
                    <img class="logo" src="./img/icones/header.png" alt="Logo TomTroc (TT)">
                    <span class="logo_title"> Tom Troc </span>
                    <a href="index.php?action=home">Accueil</a>
                    <a href="index.php?action=allBook" >Nos livres à l'échange</a>
                </div>

                <div class="nav_right">
                <?php   
                    if (isset($_SESSION['user_id'])) {

                    $conversationManager = new MessageManager();
                    $conversations = $conversationManager->getConversations($_SESSION['user_id']);
                }
                    if (!empty($conversations)) {
                        $latestConversationRecipientId = $conversations[0]['other_user_id']; 
                        $link = "index.php?action=viewChat&recipient_id=" . urlencode($latestConversationRecipientId);
                    } else {
                        
                        $latestConversationRecipientId = null;
                        $link = "index.php?action=messenger";
                    }
                ?>

                    <a href="<?= $link ?>"><i class="fa-regular fa-comments"></i> Messagerie</a>

                    <a href="index.php?action=myAccount"><i class="fa-regular fa-user"></i> Mon compte</a>
                    <?php 
                    // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
                    } else {
                        echo '<a href="index.php?action=connectionForm">Connexion</a>';
                    }
                     ?>
                </div> 
            </nav>

            </header>

            <main> <?= $content /* Ici est affiché le contenu réel de la page. */ ?>  </main>


<!---------------------------- FOOTER ---------------------------->


            <footer>
                <div class="links_container">
                    <a href="">Politique de confidentialité</a>
                    <a href="">Mentions légales</a>
                    <a href="">Tom Troc©</a>
                    <img src="img/icones/footer_1.png" class="logo_footer" alt="logo du site en vert (TT)">
                </div>
            </footer>   
        </div>
    </body>
</html>