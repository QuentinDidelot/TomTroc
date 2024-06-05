<?php
    /**
     * Affichage de tous les livres disponibles
     */
?>

<div class="all_books_container">
    <h2>Nos livres à l'échange</h2>
        <div class="all_books">
            <?php foreach($books as $book) { ?>
                <a href="" class="books_link">   
                    <article class="books_card">
                        <img src="<?= $book['image'] ?>" alt="">
                        <h3 class="book_title"><?= $book['title'] ?></h3>
                        <p class="author"><?= $book['author'] ?></p>
                        <p class="sold_by">Vendu par : <?= $book['pseudo'] ?></p>
                    </article>
                </a>
            <?php } ?>  
        </div>
</div>
