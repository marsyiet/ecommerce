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
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Cathégories</span>
                        </div>
                        <ul>
                            <?php $cathegorie = $DB->query("SELECT * FROM cathegories ORDER BY id DESC");?>
							<?php foreach($cathegorie as $cat): ?>
                            <li><a href="#"><?= $cat->libelle ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            
                            
                            <form action="index.php" method="POST">
                                <div class="hero__search__categories">
                                    RECHERCHER
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="Que voulez vous?" name="element">
                                <button type="submit" class="site-btn" name="recherche">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+237 692801450</h5>
                                <span>Actif 7j/7</span>
                            </div>
                        </div>
                    </div>
                    <div class="row"">
                    <?php                  
                        if(isset($_POST['recherche']) && isset($_POST['element']) && !empty($_POST['element'])){
                            $element = $_POST['element'];
                            $resultat = $DB->query("SELECT * FROM produits  WHERE nom LIKE ? ORDER BY id DESC",array('%'.$element.'%'));    
                            if ($resultat) {
                                foreach ($resultat as $re):
                    ?>
                        <div class=" col-md-4">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="images/<?= $re->image ?>">
                                    <ul class="featured__item__pic__hover">
                                        <?php if (empty($_SESSION['favori'][$re->id])) { ?>
                                        <li><a class="add addfavori" href="index.php?addfavori=<?= $re->id ?>"><i class="fa fa-heart"></i></a></li>
                                        <?php } else { ?>
                                        <li><a class=" addfavori" href="index.php?delfavori=<?= $re->id ?>"><i class="fa fa-trash"></i></a></li>
                                        <?php } ?>
                                        <li><a href="#"><i class="fa fa-thumbs-up"></i></a></li>
                                        <li><a class="add addpanier" href="addpanier.php?addpanier=<?= $re->id ?>"><i class="fa fa-shopping-cart"></i></a></li> 
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#"><?= $re->nom ?></a></h6>
                                    <h5><?= number_format($re->prix, 0, '.', ' '); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                    <?php }}else{ ?>
                    <?php $alaune = $DB->query("SELECT * FROM produits, cathegories WHERE alaune=1 AND cathegories.id = produits.cathegorie"); ?>
                    <?php foreach ($alaune as $une): ?>
                    <div class="hero__item set-bg" data-setbg="">
                        <div class="hero__text">
                            <span><?= number_format($une->prix,0,'.',' ') ?></span>
                            <h2><?= $une->nom ?><br /><?= $une->libelle ?></h2>
                            <p></p>
                            <a href="#" class="primary-btn">ACHETER MAINTENANT</a>
                        </div>
                        <img src="images/<?= $une->image ?>">
                    </div>
                    <?php endforeach ?>
                    <?php } ?>
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
                            <h5><a href="#"><?= $prod->nom ?></a></h5>
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
                $connect = new PDO('mysql:host=localhost;dbname=ecommerce','root', ''); 

                $count= $connect->prepare("SELECT count(id) AS cpt FROM produits");
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
                                <li><a class="add addfavori" href="index.php?addfavori=<?= $g->id ?>"><i class="fa fa-heart"></i></a></li>
                                <?php } else { ?>
                                <li><a class="" href="index.php?delfavori=<?= $g->id ?>"><i class="fa fa-trash"></i></a></li>
                                <?php } ?>
                                <li><a href="addlike.php?t=1&id=<?= $g->id ?>"><i class="fa fa-thumbs-up"></i></a></li>
                                <li><a class="add addpanier" href="addpanier.php?addpanier=<?= $g->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                           </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?= $g->nom ?></a></h6>
                            <h5><?= number_format($g->prix, 0, '.', ' '); ?></h5><br />
                            <?php
                                $connect = new PDO('mysql:host=localhost;dbname=ecommerce','root', '');
                                $likes = $connect->prepare("SELECT id FROM likes WHERE id_produit = ?");
                                $likes->execute(array($g->id));
                                $likes = $likes->rowCount();

                                $connect = new PDO('mysql:host=localhost;dbname=ecommerce','root', '');
                                $dislikes = $connect->prepare("SELECT id FROM dislikes WHERE id_produit = ?");
                                $dislikes->execute(array($g->id));
                                $dislikes = $dislikes->rowCount();
                            ?>
                            <h6><a href="addlike.php?t=1&id=<?= $g->id ?>">j'aime</a>(<?= $likes ?>)</h6>
                            <h6><a href="addlike.php?t=2&id=<?= $g->id ?>">j'aime pas</a>(<?= $dislikes ?>)</h6>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
            <div class="row">
                <div style="position: absolute; left: 50%; transform: translate(-50%, -50%);">
                    <?php
                        for ($i=1;$i<=$nb_pages;$i++){ 
                        if($page!=$i){ ?>
                        <a type="button" class="site-btn" style="background-color: rgba(0,0,0,0); color:green; border-color:green" href="?page=<?php echo $i; ?>"><?php echo $i ?></a>
                        <?php }else{ ?>
                        <a type="button" class="site-btn" style="background-color: green; color:white"><?php echo $i ?></a>
                    <?php }} ?>
                </div>
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
                                <a href="#" class="latest-product__item">
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
                                <a href="#" class="latest-product__item">
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
                                <a href="#" class="latest-product__item">
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
                                <a href="#" class="latest-product__item">
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
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
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
<?php require '_header.php'; ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="ogani-master/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="ogani-master/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Francais</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="connexion.php"><i class="fa fa-user"></i> Se connecter</a>
                <a href="inscription.php"><i class="fa fa-user"></i> S'inscrire</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Accueil</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Soldes</a></li>
                        <li><a href="./shoping-cart.html">Informations</a></li>
                    </ul>
                </li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li>Nos adresses <i class="fa fa-envelope"></i> etoundimarius237@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li>Nos adresses <i class="fa fa-envelope"></i> etoundimarius237@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Francais</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="connexion.php"><i class="fa fa-user"></i> Se connecter</a>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="inscription.php"><i class="fa fa-user"></i> S'inscrire</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Accueil</a></li>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shoping-cart.html">Soldes</a></li>
                                    <li><a href="./checkout.html">informations</a></li>
                                </ul>
                            </li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Cathégories</span>
                        </div>
                        <ul>
                            <?php $cathegorie = $DB->query("SELECT * FROM cathegories ORDER BY id DESC");?>
							<?php foreach($cathegorie as $cat): ?>
                            <li><a href="#"><?= $cat->libelle ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            
                            
                            <form action="index.php" method="POST">
                                <div class="hero__search__categories">
                                    RECHERCHER
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="Que voulez vous?" name="element">
                                <button type="submit" class="site-btn" name="recherche">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+237 692801450</h5>
                                <span>Actif 7j/7</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php 
                        if(isset($_POST['recherche']) && isset($_POST['element']) && !empty($_POST['element'])){
                        $element = $_POST['element'];
                        $resultat = $DB->query('SELECT * FROM produits WHERE nom LIKE ?', array('%'.$element.'%'));    
                            if ($resultat) {
                                foreach ($resultat as $re):
                    ?>
                        <div class=" col-md-4">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="images/<?= $re->image ?>">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#"><?= $re->nom ?></a></h6>
                                    <h5><?= number_format($re->prix, 0, '.', ' '); ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    </div>
                    <?php }}else{ ?>
                    <?php $alaune = $DB->query("SELECT * FROM produits, cathegories WHERE alaune=1 AND cathegories.id = produits.cathegorie"); ?>
                    <?php foreach ($alaune as $une): ?>
                    <div class="hero__item set-bg" data-setbg="">
                        <div class="hero__text">
                            <span><?= number_format($une->prix,0,'.',' ') ?></span>
                            <h2><?= $une->nom ?><br /><?= $une->libelle ?></h2>
                            <p></p>
                            <a href="#" class="primary-btn">ACHETER MAINTENANT</a>
                        </div>
                        <img src="images/<?= $une->image ?>">
                    </div>
                    <?php endforeach ?>
                    <?php } ?>
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
                            <h5><a href="#"><?= $prod->nom ?></a></h5>
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
                <?php $mixe = $DB->query("SELECT * FROM produits, cathegories WHERE cathegories.id = produits.cathegorie"); ?>
                <?php foreach ($mixe as $g): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix .<?= $g->libelle ?>.' '.<?= $g->libelle ?>.">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="images/<?= $g->image ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?= $g->nom ?></a></h6>
                            <h5><?= number_format($g->prix, 0, '.', ' '); ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
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
                                <a href="#" class="latest-product__item">
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
                                <a href="#" class="latest-product__item">
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
                                <a href="#" class="latest-product__item">
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
                                <a href="#" class="latest-product__item">
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
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
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