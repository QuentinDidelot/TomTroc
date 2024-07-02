<?php
    /**
     * Affichage de la page pour ajouter un livre
     */
?>

<nav>
    <a href="index.php?action=myAccount" class="breadcrumb">← Retour</a>
    <h1 class="updateInfoTitle">Ajouter un nouveau livre</h1>
</nav>


<?php if (isset($_SESSION['error_message'])): ?>
        <div class="error_message">
            <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="success_message">
            <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
        </div>
    <?php endif; ?>

<section class="bookInfoContainer">
    <div class="bookInfo">
        <form action="index.php?action=addBook" method="post" class="bookInfoForm profile_form" enctype="multipart/form-data">
            <label for="title">Titre</label>
            <input class="form_input" type="text" id="title" name="title" value="" required>
            <label for="author">Auteur</label>
            <input class="form_input" type="text" id="author" name="author" value="" required>
            <label for="description">Commentaire</label>
            <textarea id="description" name="description" required></textarea>
            <label for="availability">Disponibilité</label>
            <select name="availability" id="availability">
                <option value="Disponible">Disponible</option>
                <option value="Non dispo.">Non dispo.</option>
            </select>
            <label for="new_book_image">Photo</label>
            <input type="file" name="new_book_image" id="new_book_image">
            <div class="button_container">
                <input class="button_type_1" type="submit" value="Valider">
            </div>
        </form>
    </div>
</section>

