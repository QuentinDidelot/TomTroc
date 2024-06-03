<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/d8c1f4a5b2.js" crossorigin="anonymous"></script>

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
                        <h1> Tom Troc </h1> 
                        <a href="">Accueil</a>
                        <a href="">Nos livres à l'échange</a>
                    </div>

                    <div class="nav_right">
                        <a href=""><i class="fa-regular fa-comments"></i> Messagerie</a>
                        <a href=""><i class="fa-regular fa-user"></i> Mon compte</a>
                        <a href="">Connexion</a>
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