<?php
session_start();
    if(isset($_SESSION['id'])){ 
        require 'header.php';
    } else{
        require 'header_non_connexion.php';
    }
?>

<!-- Blog Details Hero Begin -->
<section class="blog-details-hero set-bg" data-setbg="ogani-master/img/blog/details/details-hero.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog__details__hero__text">
                    <h2>Un univers a explorer</h2>
                    <ul>
                        <li>By Michael Scofield</li>
                        <li>January 14, 2019</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <?php require 'blog_sidebar.php'; ?>
            <?php $blog = $DB->query('SELECT * FROM cathegories, cathegorie_blog, blog WHERE blog.id LIKE ? AND cathegories.id = cathegorie_blog.tag1  AND cathegorie_blog.id_cathegorie_blog = blog.cathegorie_article  ',array($_GET['id']));
                    foreach($blog as $bl): ?>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <img src="images/<?=$bl->image_produit_blog?>" alt="">
                    <h3><?=$bl->titre_article?>.</h3>
                    <p><?=$bl->contenu_article?></p>
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="images/<?=$bl->photo_auteur_article?>" alt="">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6><?=$bl->nom_auteur_article?></h6>
                                    <span>Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span> <?=$bl->nom_cathegorie_blog?></li>
                                    <li><span>Tags:</span> All, <?=$bl->libelle?></li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-whatsapp"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Post You May Like</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $ress = $DB->query("SELECT * FROM blog WHERE id LIKE ?", array($_GET['id'])); 
                foreach($ress as $r):
                ?>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="images/<?=$r->image_produit_blog?>" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> <?=$r->date_article?></li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="#"><?=$r->titre_article;?></a></h5>
                        <p><?=$r->apercu_article?> </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Related Blog Section End -->

<?php require 'footer.php'; ?>