<?php
session_start();
    if(isset($_SESSION['id'])){ 
        require 'header.php';
    } else{
        require 'header_non_connexion.php';
    }
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="ogani-master/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Blog</h2>
                    <div class="breadcrumb__option">
                        <a href="index.php">Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <?php require 'blog_sidebar.php'; ?>
            <div class="col-lg-8 col-md-7 ">
                <div class="row">
                    <?php $blog = $DB->query('SELECT * FROM blog ORDER BY id DESC LIMIT 6');
                        foreach($blog as $bl): ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 resultat_blog">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="images/<?=$bl->image_produit_blog?>" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i><?=$bl->date_article?></li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="#"><?=$bl->titre_article?></a></h5>
                                <p><?=$bl->contenu_article?></p>
                                <a href="blog_details.php?id=<?=$bl->id?>" class="blog__btn">LA SUITE <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<?php require 'footer.php'; ?>