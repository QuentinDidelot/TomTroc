<h1 class="account_title">Mon compte</h1>

    <section class="account_container">

        <div class="account_information">
            <div class="profile_info">
                <img src="<?= $user->getProfileImage() ? htmlspecialchars($user->getProfileImage()) : 'img/icones/default_profile_image.png' ?>" class="profile_picture" alt="image de profil">
                <form action="index.php?action=updateProfileImage" method="post" enctype="multipart/form-data" id="profileImageForm">
                    <label for="new_profile_image" class="profile_edit" style="cursor: pointer;">Modifier</label>
                    <input type="file" name="new_profile_image" id="new_profile_image" style="display: none;" onchange="submitFormOnce()">
                    <button type="submit" style="display: none;">Enregistrer</button>
                </form>
                <span>________________________</span><br><br>
            </div>


            <div class="user_info">
                    <p class="pseudo"><?= htmlspecialchars($user->getPseudo())?></p>
                    <p class="member_since"><?= htmlspecialchars($user->getMembershipDurationString()) ?></p>
                    <p class="subtitle">Bibliothèque</p><br>
                    <p class="num_books"> <img src="img/icones/books.png" class="books_logo" alt="Icone livre"><?= count($books) ?> livre<?= count($books) !== 1 ? 's' : '' ?></p>
            </div>
        </div>

        <div class="account_information">
            <div class="perso_info">
                <form action="index.php?action=updateInfoUser" method="post" class="profile_form">
                    <h3>Vos informations personnelles</h3>

                    <label for="email">Adresse email :</label>
                    <input class="form_input" type="email" id="email" name="email" value="<?=htmlspecialchars($user->getEmail())?>" required>
                    
                    <label for="password">Mot de passe :</label>
                    <input class="form_input" type="password" id="password" name="password" value="" required>
                    
                    <label for="pseudo">Pseudo :</label>
                    <input class="form_input" type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($user->getPseudo())?>" required>
                    
                    <div class="button_container">
                        <input class="button_type_2" type="submit" value="Enregistrer">
                    </div>

                </form>
            </div>
        </div>
    </section>

    <section class="adminBook">
        <div class="bookLine header">
            <div class="admin_title">Photo</div>
            <div class="admin_title">Titre</div>
            <div class="admin_title">Auteur</div>
            <div class="admin_title">Description</div>
            <div class="admin_title">Disponibilité</div>
            <div class="admin_title">Action</div>
        </div>
        <?php foreach ($books as $book) { ?>
            <div class="bookLine">
                <div class="b_picture"><img src="<?= $book['image'] ?>" alt="Book Image"></div>
                <div class="b_title"><?= $book['title'] ?></div>
                <div class="b_author"><?= $book['author'] ?></div>
                <div class="b_description"><?= $book['description'] ?></div>
                    <!-- Condition pour déterminer le texte à afficher -->
                    <?php
                        $availability = $book['availability'];
                        
                        if ($availability == "Disponible") {
                            $availability_class = "available"; 
                        } else {
                            $availability_class = "not-available"; 
                        }
                        ?>
                    
                <div class="b_availability">
                        <span class = <?php echo $availability_class; ?>><?= $book['availability'] ?>
                </div>
                <div class="b_action">
                    <a class="edit" href="index.php?action=updateBookForm&id=<?= htmlspecialchars($book['book_id']) ?>" >Éditer</a>
                    <a class="delete" href="index.php?action=deleteBook&id=<?= htmlspecialchars($book['book_id']) ?>"  <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer ce livre ?")?> > Supprimer</a>
                </div>
            </div>
        <?php } ?>


    </section>