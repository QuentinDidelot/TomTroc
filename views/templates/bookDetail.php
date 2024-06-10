<nav class="breadcrumb">
    <a href="index.php?action=allBook">Nos livres</a>
    <span class="separator">></span>
    <span><?= $book['title'] ?></span>
</nav>
        
 
 <section class="bookDetail">

        <div class="book_detail_left">
            <img src="<?= $book['image'] ?>" alt="couverture du livre choisi">
        </div>

  
        <div class="book_detail_right">
            <div class="detail_container_right">  
                <div class="detail_title"> 
                    <h1><?= $book['title'] ?></h1>
                    <span class="detail_author">Par <?=$book['author']?></span><br>
                </div>
                <span class="deco_line">______</span> 
                <div class="detail_book">

                    <h3 class="subtitle">Description</h3>

                    <div class="detail_description"> <?= $book['description'] ?> </div>


                    <h3 class="subtitle">Propriétaire</h3>

                    <a href="" class="book_owner">
                        <img src="<?= $book["profile_image"] ?>" class="detail_profile_picture" alt="image de profil">
                        <span><?= $book['pseudo'] ?></span>
                    </a>
                </div>

                <a href="" class="button_type_1" > Envoyer un message </a>
            </div>
        </div>   
</section>