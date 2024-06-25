<?php
    /**
     * Affichage de la page pour modifier les livres
     */
?>

<nav>
    <a href="index.php?action=myAccount" class="breadcrumb">← Retour</a>
    <h1 class="updateInfoTitle">Modifier les informations</h1>
</nav>

<section class="bookInfoContainer">
    <div class="bookInfoPicture">
        <div class="caption caption_left">Photo</div>
        <div>
            <img class="bookCover" src="<?= $book['image'] ?>" alt="couverture du livre choisi"><br>
            <form action="index.php?action=updateBookPhoto" method="post" enctype="multipart/form-data">
                <input type="hidden" name="bookId" value="<?= $book['id'] ?>">
                <input type="file" name="new_book_image">
                <input type="submit" class="profile_edit" value="Modifier la photo">
            </form>


        </div>
    </div>
    <div class="bookInfo">
        <form action="index.php?action=updateBook" method="post" class="bookInfoForm profile_form">
            <input type="hidden" name="bookId" value="<?= $book['id'] ?>">
            <label for="title">Titre</label>
            <input class="form_input" type="text" id="title" name="title" value="<?= $book['title'] ?>" required>
            <label for="author">Auteur</label>
            <input class="form_input" type="text" id="author" name="author" value="<?= $book['author'] ?>" required>
            <label for="description">Commentaire</label>
            <textarea id="description" name="description" required><?= $book['description'] ?></textarea>
            <label for="availability">Disponibilité</label>
            <select name="availability" id="availability">
                <option value="Disponible" <?= $book['availability'] == 'Disponible' ? 'selected' : '' ?>>Disponible</option>
                <option value="Non dispo." <?= $book['availability'] == 'Non dispo.' ? 'selected' : '' ?>>Non dispo.</option>
            </select>
            <div class="button_container">
                <input class="button_type_1" type="submit" value="Valider">
            </div>
        </form>
    </div>
</section>
