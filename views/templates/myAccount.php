<h1 class="account_title">Mon compte</h1>

    <section class="account_container">

        <div class="account_information">
            <div class="profile_info">
                <img src="img/HK.jpg" class="profile_picture" alt="image de profil">
                <a href="#" class="profile_edit">Modifier</a><br><br>
                <span>________________________</span><br><br>
            </div>

            <div class="user_info">
                    <p class="pseudo">Admin</p>
                    <p class="member_since">Membre depuis 1 an</p>
                    <p class="subtitle">Bibliothèque</p><br>
                    <p class="num_books"> <img src="img/icones/books.png" class="books_logo" alt="Icone livre">4 livres</p>
            </div>
        </div>

        <div class="account_information">
            <div class="perso_info">
                <form action="" method="post" class="profile_form">
                    <h3>Vos informations personnelles</h3>

                    <label for="email">Adresse email :</label>
                    <input class="form_input" type="email" id="email" name="email" value="" required>
                    
                    <label for="password">Mot de passe :</label>
                    <input class="form_input" type="password" id="password" name="password" value="" required>
                    
                    <label for="pseudo">Pseudo :</label>
                    <input class="form_input" type="text" id="pseudo" name="pseudo" value="" required>
                    
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
        <!-- Foreach début -->
        <div class="bookLine">
            <div class="b_picture"><img src="img/books/le_silmarillion.jpg" alt="Book Image"></div>
            <div class="b_title">Le Silmarillion</div>
            <div class="b_author">J.R.R. Tolkien</div>
            <div class="b_description">"Le Silmarillion" de J.R.R. Tolkien est une œuvre monumentale qui s'inscrit comme un préquel essentiel à "Le Seigneur des Anneaux". Ce livre est un recueil de mythes et de légendes de la Terre du Milieu, offrant une profondeur historique et une richesse culturelle sans pareilles. Il se divise en plusieurs sections, chaque partie racontant des événements distincts mais interconnectés, de la création du monde à la fin du Premier Âge. L'écriture est dense et poétique, rappelant les épopées anciennes. Les personnages, bien que nombreux, sont soigneusement développés, chacun avec son propre arc narratif et ses motivations. Toutefois, la complexité et la structure fragmentée peuvent rebuter certains lecteurs, surtout ceux habitués à des récits plus linéaires. Pour les passionnés de fantasy et de l'univers de Tolkien, "Le Silmarillion" est une lecture incontournable qui enrichit considérablement la compréhension de ses autres œuvres. Cependant, il demande une attention particulière et une certaine patience pour pleinement apprécier ses subtilités.</div>
            
                <!-- Condition pour déterminer le texte à afficher -->
                <!-- <?php
                    // $availability = $book['availability'];

                    $availability = "Disponible";
                    
                    if ($availability == "Disponible") {
                        $availability_text = "Disponible";
                        $availability_class = "available"; 
                    } else {
                        $availability_text = "Non disponible";
                        $availability_class = "not-available"; 
                    }
                    ?> -->
                    
            <div class="b_availability">
                    <span class = <?php echo $availability_class; ?>><?php echo $availability_text; ?>
            </div>
            <div class="b_action">
                <a href="#" class="edit">Éditer</a>
                <a href="#" class="delete">Supprimer</a>
            </div>
        </div>
        <!-- Foreach fin -->

    </section>