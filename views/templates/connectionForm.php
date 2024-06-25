<?php
    /**
     * Affichage du formulaire de connexion
     */
?>

<section class="connexion_form">
    <div class="left_half_connexion">
        <div class="form_container">


            <h1 class="form_title">Connexion</h1>

            <?php if (!empty($errorMessage)) : ?>
                <div class="error-message"><?= $errorMessage ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_inscription'])): ?>
                <div class="success_message">
                    <?= htmlspecialchars($_SESSION['success_inscription']) ?>
                    <?php unset($_SESSION['success_inscription']); ?>
                </div>
            <?php endif; ?>

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
