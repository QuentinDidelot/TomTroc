<section class="connexion_form">
    <div class="left_half_connexion">
        <div class="form_container">
            <h1 class="form_title">Inscription</h1>

            <form action="index.php?action=inscriptionUser" method="post">
                <label for="pseudo">Pseudo :</label>
                <input class="form_input" type="pseudo" id="pseudo" name="pseudo" required>


                <label for="email">Adresse mail :</label>
                <input class="form_input" type="email" id="email" name="email" required>
                
                <label for="password">Mot de passe :</label>
                <input class="form_input" type="password" id="password" name="password" required>
                
                <input class="button_type_1" type="submit" value="S'inscrire">
            </form>
            <p>Déjà inscrit ? <a href="index.php?action=connectionForm" class="form_link">Connectez-vous</a></p>
        </div>

    </div>

    <div class="right_half_connexion">
        <img src="img/connexion_form_books.jpg" alt="">
    </div>
</section>
