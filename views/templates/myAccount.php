<h1 class="account_title">Mon compte</h1>

    <section class="account_container">

        <div class="account_information">
            <div class="profile_info">
                <img src="img/HK.jpg" class="profile_picture" alt="image de profil">
                <a href="#" class="profile_edit">Modifier</a><br><br>
                <span>________________________</span><br><br>
            </div>

            <div class="user_info">
                    <p class="pseudo">Quentin</p>
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