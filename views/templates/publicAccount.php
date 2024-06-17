<nav class="breadcrumb">
    <a href="index.php?action=allBook">← Nos livres</a>
</nav>

<section class="publicAccountContainer">
    <div class="publicAccountProfile">
        <div class="profile_info">
            <img src="<?= !empty($user->getProfileImage()) ? htmlspecialchars($user->getProfileImage()) : 'img/icones/default_profile_image.png' ?>" class="profile_picture" alt="image de profil"><br><br>
            <span>________________________</span><br><br>
        </div>

        <div class="user_info">
            <p class="pseudo"><?= htmlspecialchars($user->getPseudo()) ?></p>
            <p class="member_since"><?= $user->getMembershipDurationString() ?></p>
            <p class="subtitle">Bibliothèque</p><br>
            <p class="num_books"> <img src="img/icones/books.png" class="books_logo" alt="Icone livre"><?= $totalBooks ?> livre<?= $totalBooks !== 1 ? 's' : '' ?></p>
        </div>

        <div class="button_container">
            <a href="" class="button_type_2">Écrire un message</a>
        </div>
    </div>

    <div class="adminBookProfile">
        <div class="bookLineProfile header">
            <div class="admin_title">Photo</div>
            <div class="admin_title">Titre</div>
            <div class="admin_title">Auteur</div>
            <div class="admin_title">Description</div>
        </div>
       
        <?php foreach ($books as $book): ?>
            <div class="bookLineProfile">
                <div class="b_picture"><img src="<?= htmlspecialchars($book['image']) ?>" alt="Book Image"></div>
                <div class="b_title"><?= htmlspecialchars($book['title']) ?></div>
                <div class="b_author"><?= htmlspecialchars($book['author']) ?></div>
                <div class="b_description"><?= htmlspecialchars($book['description']) ?></div>
            </div>
        <?php endforeach; ?>
        <div class="tableFooter">
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="index.php?action=publicAccount&userId=<?= $user->getId() ?>&page=<?= $currentPage - 1 ?>">← Précédent</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="index.php?action=publicAccount&userId=<?= $user->getId() ?>&page=<?= $i ?>"<?= $i == $currentPage ? ' class="active"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="index.php?action=publicAccount&userId=<?= $user->getId() ?>&page=<?= $currentPage + 1 ?>">Suivant →</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
