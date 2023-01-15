<?php
session_start();
if(isset($_SESSION['id'])){

?>
<?php require 'header.php'; ?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                
            </div>
            <div class="col-lg-9">
                
                <?php $alaune = $DB->query("SELECT * FROM baner WHERE alaune=1"); ?>
                <?php foreach ($alaune as $une): ?>
                <div class="hero__item set-bg" data-setbg="images/<?= $une->image ?>">
                    <div class="hero__text">
                        <span></span>
                        <h2><?= $une->nom ?></h2>
                        <p></p>
                        <a href="filtre.php=" class="primary-btn" >VOIR LES <?= $une->nom ?></a>
                    </div>
                </div>
                <?php endforeach ?>
                
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php $produits = $DB->query("SELECT * FROM produits ORDER BY id DESC"); ?>
                <?php foreach ($produits as $prod): ?>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="images/<?= $prod->image ?>">
                        <h5><a href="detail.php?id=<?=$prod->id?>"><?= $prod->nom ?></a></h5>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Mix des produits</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php $mix = $DB->query("SELECT * FROM cathegories"); ?>
                        <?php foreach ($mix as $m): ?>
                        <li data-filter=".<?= $m->libelle ?>"><?= $m->libelle ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
            require 'admin/includes/connexion.php';

            $count= connect()->prepare("SELECT count(id) AS cpt FROM produits");
            $count->setFetchMode(PDO::FETCH_ASSOC);
            $count->execute();
            $tcount=$count->fetchAll();
        
            @$page=$_GET["page"];
            if(empty($page)) $page=1;
            $nb_elements_page=8;
            $nb_pages=ceil($tcount[0]["cpt"]/$nb_elements_page);
            $debut=($page-1) * $nb_elements_page;
        
            $mixe = $DB->query("SELECT * FROM produits ORDER BY id DESC LIMIT $debut,$nb_elements_page"); ?>
            <?php foreach ($mixe as $g): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix ">      
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="images/<?= $g->image ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a  href="detail.php?id=<?= $g->id ?>&&d=<?= $g->id ?>"><i class="fa fa-eye"></i></a></li>
                                <li><a class="addpanier" href="addpanier.php?id=<?= $g->id ?>&&addpanier=<?= $g->id ?>&&d=<?= $g->id ?>"  value="<?= $g->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><span><a href="#"><?= $g->nom ?></a></span></h6>
                            <h5><span><?= number_format($g->prix, 0, '.', ' '); ?></h5><br />
                        </div>
                    </div> 
                </div>
            <?php endforeach ?>
        </div>
        <div class="product__pagination" style="position: absolute; left: 50%; transform: translate(-50%, -50%);">
            <?php
            for ($i=1;$i<=$nb_pages;$i++){ 
            if($page!=$i){ ?>
            <a href="?page=<?php echo $i; ?>" ><?php echo $i ?></a>
            <?php }else{ ?>
            <a style=" border: 2px solid green"><?php echo $i ?></a>
            <?php }} ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="images/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="images/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Derniers Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $late = $DB->query("SELECT * FROM produits ORDER BY id DESC LIMIT 4"); ?>
                            <?php foreach ($late as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php $late = $DB->query("SELECT * FROM produits ORDER BY id ASC LIMIT 4"); ?>
                            <?php foreach ($late as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>produits les plus likés</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id DESC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id ASC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>produits les plus commandés</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id DESC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id ASC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Product Section End -->

<!-- Footer Section Begin -->
<?php require 'footer.php'; ?>

<?php }else{ ?>
<?php require 'header_non_connexion.php'; ?>
<section class="hero">
<div class="container">
    <div class="row">
        <div class="col-lg-3">
        </div>
        <?php $alaune = $DB->query("SELECT * FROM baner WHERE alaune=1"); ?>
        <div class="col-lg-9">
            <?php foreach ($alaune as $une): ?>
            <div class="hero__item set-bg" data-setbg="images/<?= $une->image ?>">
                <div class="hero__text">
                    <span></span>
                    <h2><?= $une->nom ?></h2>
                    <p></p>
                    <a href="filtre.php?id=<?=$une->nom?>" class="primary-btn" >VOIR LES <?= $une->nom ?></a>
                </div>
            </div>
        </div>
        <?php endforeach ?>
    </div>
</div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php $produits = $DB->query("SELECT * FROM produits ORDER BY id DESC"); ?>
                <?php foreach ($produits as $prod): ?>
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="images/<?= $prod->image ?>">
                        <h5><a href="detail.php?n=<?=$prod->id?>"><?= $prod->nom ?></a></h5>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Mix des produits</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php $mix = $DB->query("SELECT * FROM cathegories"); ?>
                        <?php foreach ($mix as $m): ?>
                        <li data-filter=".<?= $m->libelle ?>"><?= $m->libelle ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
            require 'admin/includes/connexion.php';

            $count= connect()->prepare("SELECT count(id) AS cpt FROM produits");
            $count->setFetchMode(PDO::FETCH_ASSOC);
            $count->execute();
            $tcount=$count->fetchAll();
        
            @$page=$_GET["page"];
            if(empty($page)) $page=1;
            $nb_elements_page=8;
            $nb_pages=ceil($tcount[0]["cpt"]/$nb_elements_page);
            $debut=($page-1) * $nb_elements_page;
        
            $mixe = $DB->query("SELECT * FROM produits ORDER BY id DESC LIMIT $debut,$nb_elements_page"); ?>
            <?php foreach ($mixe as $g): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix ">      
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="images/<?= $g->image ?>">
                            <ul class="featured__item__pic__hover">
                                <?php if (empty($_SESSION['favori'][$g->id])) { ?>
                                <li><a  href="connexion.php"><i class="fa fa-heart"></i></a></li>
                                <?php } else { ?>
                                <li><a  href="connexion.php"><i class="fa fa-trash"></i></a></li>
                                <?php } ?>
                                <li><a  href="connexion.php"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?= $g->nom ?></a></h6>
                            <h5><?= number_format($g->prix, 0, '.', ' '); ?></h5><br />
                        </div>
                    </div> 
                </div>
            <?php endforeach ?>
        </div>
        <div class="product__pagination" style="position: absolute; left: 50%; transform: translate(-50%, -50%);">
            <?php
            for ($i=1;$i<=$nb_pages;$i++){ 
            if($page!=$i){ ?>
            <a href="?page=<?php echo $i; ?>" ><?php echo $i ?></a>
            <?php }else{ ?>
            <a style=" border: 2px solid green"><?php echo $i ?></a>
            <?php }} ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="images/banner-1.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="images/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Latest Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $late = $DB->query("SELECT * FROM produits ORDER BY id DESC LIMIT 4"); ?>
                            <?php foreach ($late as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php $late = $DB->query("SELECT * FROM produits ORDER BY id ASC LIMIT 4"); ?>
                            <?php foreach ($late as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>produits les plus likés</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id DESC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id ASC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>produits les plus commandés</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id DESC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM likes, produits WHERE likes.id_produit = produits.id ORDER BY likes.id ASC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?n=<?=$l->id?>" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="images/<?= $l->image ?>" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6><?= $l->nom ?></h6>
                                    <span><?= $l->prix ?></span>
                                </div>
                            </a>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Product Section End -->

<!-- Footer Section Begin -->
<?php require 'footer.php'; ?>
<?php }?>