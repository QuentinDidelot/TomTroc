<?php
    /**
     * Affichage de tous les livres disponibles
     */
?>

<div class="all_books_container">
    <div class="all_books_head">
        <h1>Nos livres à l'échange</h1>
        <form action="index.php" method="GET" class="search-container">
            <input type="hidden" name="action" value="showBooksByTitle">
            <input type="text" class="search-input" placeholder="Rechercher un livre" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : ''; ?>" onkeydown="if (event.keyCode == 13) this.form.submit()">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
        </form>

    </div>

    <div class="all_books">
        <?php if (!empty($books)) { ?>
            <?php foreach ($books as $book) { ?>
                <a href="" class="books_link">
                    <article class="books_card">
                        <div class="cart_background">
                            <img src="<?= $book['image'] ?>" alt="">
                        </div>
                        <h3 class="book_title"><?= $book['title'] ?></h3>
                        <p class="author"><?= $book['author'] ?></p>
                        <p class="sold_by">Vendu par : <?= $book['pseudo'] ?></p>
                    </article>
                </a>
            <?php } ?>
        <?php } else { ?>
            <p class="erreur">Aucun livre trouvé.</p>
        <?php } ?>
    </div>
</div>
