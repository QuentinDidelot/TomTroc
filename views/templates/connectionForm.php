<section class="connexion_form">
    <div class="left_half_connexion">
        <div class="form_container">


            <h1 class="form_title">Connexion</h1>

            <?php
            // Afficher le message d'erreur s'il existe dans la session
            if (isset($_SESSION['error'])) {
                echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
                // Une fois affiché, supprimer le message d'erreur de la session
                unset($_SESSION['error']);
            }
            ?>
            <form action="index.php?action=connectUser" method="post">
                <label for="email">Adresse mail :</label>
                <input class="form_input" type="email" id="email" name="email" required>
                
                <label for="password">Mot de passe :</label>
                <input class="form_input" type="password" id="password" name="password" required>
                
                <input class="button_type_1" type="submit" value="Se connecter">
            </form>
            <p>Pas de compte ? <a href="index.php?action=inscriptionForm" class="form_link">Inscrivez-vous</a></p>
        </div>

    </div>

    <div class="right_half_connexion">
        <img src="img/connexion_form_books.jpg" alt="">
    </div>
</section>
