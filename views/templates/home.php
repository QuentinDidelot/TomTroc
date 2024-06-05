           <section class="join_us">
                <div class="join">
                    <h2>Rejoignez nos lecteurs passionnés </h2>
                    <p> Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
                    <a href="index.php?action=allBook" class="button_type_1" > Découvrir </a>
                </div>

                <div class="join_picture">
                    <img class="home_picture" src="./img/home_picture.jpg" alt="homme entouré de livre, en pleine lecture">
                    <div class="caption">Hamza</div>
                </div>
            </section>

            <section class="last_books">

                <h2>Les derniers livres ajoutés</h2>

                <div class="books_container">
                    <?php foreach ($lastFourBooks as $book) { ?>
                        <a href="" class="books_link">
                            <article class="books_card">
                                <div class="cart_background">
                                    <img src="<?= $book['image'] ?>" alt="<?= $book['title'] ?>">
                                </div>
                                <h3 class="book_title"><?= $book['title'] ?></h3>
                                <p class="author"><?= $book['author'] ?></p>
                                <p class="sold_by">Vendu par : <?= $book['pseudo'] ?></p>
                            </article>
                        </a>
                    <?php } ?>
                </div>

                <div class="button_container">
                    <a href="index.php?action=allBook" class="button_type_1">Voir tous les livres</a>
                </div>

            </section>

            <section class="how_it_works">
                <h2> Comment ça marche ?</h2>
                <p>Échanger des livres avec TomTroc c'est simple et 
                    amusant ! Suivez ces étapes pour commencer : </p>
                <div class="steps_container">
                    <div class="step">
                        <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
                    </div>

                    <div class="step">
                        <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
                    </div>

                    <div class="step">
                        <p>Parcouez les livres disponibles chez d'autres membres.</p>
                    </div>

                    <div class="step">
                        <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
                    </div>
                </div>

                <div class="button_container">
                    <a href="index.php?action=allBook" class="button_type_2" > Voir tous les livres </a>
                </div>
            </section>

            <section class="banner">
                <img src="img/banner.jpg" alt="une bibliothèque">
            </section>

            <section class="values">
                <div class="values_container">
                    <h2>Nos valeurs</h2>
                    <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes <br><br>

                    Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. <br><br>

                    Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.  <br><br>
                    </p>

                    <div class="signature_container">                     
                        <p class="signature">L'équipe Tom Troc </p>
                        <img src="img/icones/heart.png" alt="un coeur vert">
                    </div>
                </div>             
            </section>
