<nav>
    <a href="index.php?action=myAccount" class="breadcrumb">← Retour</a>
    <h1 class="updateInfoTitle">Modifier les informations</h1>
</nav>




<section class="bookInfoContainer">
    <div class="bookInfoPicture">
        <div class="caption caption_left">Photo</div>
        <img class="" src="img/books/le_silmarillion.jpg" alt="couverture du livre choisi">
    </div>

    <div class="bookInfo">
        <form action="" method="post" class="bookInfoForm profile_form">
        
            <label for="title">Titre</label>
            <input class="form_input" type="title" id="title" name="title" value="" required>
            
            <label for="author">Auteur</label>
            <input class="form_input" type="text" id="author" name="author" value="" required>
            
            <label for="comment">Commentaire</label>
            <textarea id="description" name="description" value="" required></textarea>
            
            <label for="availability">Disponibilité</label>
            <select name="" id="availability">
                <option value="Disponible">Disponible</option>
                <option value="Non dispo.">Non dispo.</option>
            </select>

            <div class="button_container">
                <input class="button_type_1" type="submit" value="Valider">
            </div>

        </form>
    </div>

</section>