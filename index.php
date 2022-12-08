<?php
    session_start();
    if(isset($_SESSION["id"])){
        //var_dump($_SESSION['id']);die();
    include("admin/includes/connexion.php");

    $reqcat = connect()->prepare("SELECT * FROM cathegories WHERE etat=0");
    $reqcat->execute();
    $repcat = $reqcat->fetchAll();

    $reqprod = connect()->prepare("SELECT * FROM produits ORDER BY id LIMIT DESC 12");
    $reqprod->execute(array());
    $repprod = $reqprod->fetchAll();

    $reqprod1 = connect()->prepare("SELECT * FROM produits WHERE alaune=1");
    $reqprod1->execute(array());
    $repprod1 = $reqprod1->fetchAll();


    $reqcli = connect()->prepare("SELECT nom FROM clients WHERE id = ?");
    $reqcli->execute(array($_SESSION['id']));
    $cli = $reqcli->fetchAll();


    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("css.php") ?>
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
            <a href="#"><img src="images/eam.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="favoris.php"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="panier.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="ogani-master/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="index.php">Accueil</a></li>
                <li><a href="produits.php">nouveautés</a></li>
                <li><a href="listecommande.php">Historique</a></li>
                <li><a href="contact.php">Contact</a></li>
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
                <li><i class="fa fa-user"></i><?php foreach($cli as $c){echo $c['nom']; }?></li> 
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
                                <li><i class="fa fa-user"></i><?php foreach($cli as $c){echo $c['nom']; }?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                <a href="deconnexion.php"><i class="fa fa-user"></i>Deconnexion</a>
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
                        <a href="./index.html"><img src="ogani-master/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="index.php">Accueil</a></li>
                            <li><a href="produits.php">nouveautés</a></li>
                            <li><a href="listecommande.php">Historique</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="favoris.php"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="panier.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">Total panier: <span>XAF 0.00</span></div>
                    </div>
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
                            <span>Nos articles</span>
                        </div>
                        <ul>
                            <?php foreach($repcat as $cat){ ?>
                            <li><a href="#"><?php echo $cat['libelle'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <!-- moteur de recherche -->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="text" placeholder="Que voulez vous?" name="query">
                                <button class="site-btn" name="rechercher" value="rechercher"> Rechercher</button>
                            </form>
                        </div>
                        
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+237 692 801 450</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                     
                    <div class="selection" style="max-height: 387px; overflow-Y: scroll;">
                    <div class="quitter section-title"> 
                        <h4>votre recherche</h4>
                        <?php if(isset($_POST['quit'])){ ?> <style> .selection{ display: none ;} </style> <?php } ?>
                    </div>
                    <?php 
                        if (isset($_POST['rechercher']) && isset($_POST['query']) && !empty($_POST['query'])) {
                            
                        $query = $_POST['query'];

                        $recherche = connect()->prepare("SELECT * FROM produits WHERE libelle LIKE ?");
                        $recherche->execute(array('%' . $query . '%'));
                        $resultat = $recherche->fetchAll();


                        if ($resultat) {
                            foreach ($resultat as $re) { ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 ">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" data-setbg="images/<?php echo $re['image']; ?>">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="#"><?php echo $re['libelle']; ?></a></h6>
                                            <h5><?php echo $re['prix']; ?><span>  Fcfa</span></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php }
        } else {
            echo "aucun resultat"; ?>
       <?php }} else { ?>
        <style>
            .selection{ display: none;}
            </style>
   <?php }?>
                    </div>
                    
                    <div class="hero__item set-bg" data-setbg>
                        <div class="hero__text">
                            <span>A la une</span>
                            <h2><?php foreach($repprod1 as $rep1){ echo $rep1['libelle']; } ?></h2>
                            <p>Disponible a seulement ...</p>
                            <a href="#" class="primary-btn">ACHETER MAINTENANT</a>
                        </div>
                        <img src="images/<?php foreach($repprod1 as $rep1){ echo $rep1['image']; } ?>">
                    </div>
                       
                </div>
            </div>
        </div>
    </section>
    
    <!-- Hero Section End -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>DERNIERS ARTICLES</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php 
                    $reqprod2 = connect()->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 12");
                    $reqprod2->execute(array());
                    $repprod2 = $reqprod2->fetchAll();  
                    
                    foreach($repprod2 as $prod2){ ?>
                        <div class="col-lg-3 col-md-4 col-sm-6  ">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="images/<?php echo $prod2['image']; ?>">
                                    <ul class="featured__item__pic__hover">
                                        <li><button name="favori"  style="border:0px; border-radius: 50%;"><i class="fa fa-heart"></i></button></li>
                                            <?php if (isset($_POST['favori'])) {
                                            $requete = connect()->prepare("UPDATE produits SET  etat = :etat WHERE id = :id1");
                                            $requete->execute(array(
                                            'etat' => $etat,
                                            'id1' => $id1 ));} ?> 
                                        <li><a href=""><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="achat.php"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#"><?php echo $prod2['libelle']; ?></a></h6>
                                    <h5><?php echo $prod2['prix']; ?><span>  Fcfa</span></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

            </div>
        </div>
    </section>
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="ogani-master/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="ogani-master/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Footer Section Begin -->
    <?php include("footer.php") ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include("javascript.php") ?>
</body>

</html>




<?php } else{ 
    include("admin/includes/connexion.php");

    $reqcat = connect()->prepare("SELECT * FROM cathegories WHERE etat=0");
    $reqcat->execute();
    $repcat = $reqcat->fetchAll();

    $requete = connect()->prepare("SELECT * FROM cathegories WHERE etat=0");
    $requete->execute();
    $reponse = $requete->fetchAll();

    $reqprod = connect()->prepare("SELECT * FROM produits WHERE etat=0");
    $reqprod->execute();
    $repprod = $reqprod->fetchAll();    

    $reqprod1 = connect()->prepare("SELECT * FROM produits WHERE alaune=1");
    $reqprod1->execute(array());
    $repprod1 = $reqprod1->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("css.php") ?>
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
            <a href="#"><img src="images/eam.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="ogani-master/img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="index.php">Accueil</a></li>
                <li><a href="produits.php">nouveautés</a></li>
                <li><a href="listecommande.php">Historique</a></li>
                <li><a href="contact.php">Contact</a></li>
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
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                                <a href="connexion.php"><i class="fa fa-user"></i>Se connecter</a>
                            </div>
                            <span> ¦¦ </span>
                            <div class="header__top__right__auth">
                                <a href="inscription.php"><i class="fa fa-id-card"></i>S'inscrire</a>
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
                        <a href="./index.html"><img src="ogani-master/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="index.php">Accueil</a></li>
                            <li><a href="produits.php">nouveautés</a></li>
                            <li><a href="listecommande.php">Historique</a></li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="favoris.php"><i class="fa fa-heart"></i> <span>2</span></a></li>
                            <li><a href="panier.php"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">Total panier: <span>XAF 0.00</span></div>
                    </div>
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
                            <span>Nos articles</span>
                        </div>
                        <ul>
                            <?php foreach($repcat as $cat){ ?>
                            <li><a href="#"><?php echo $cat['libelle'] ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <!-- moteur de recherche -->
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="text" placeholder="Que voulez vous?" name="query">
                                <button class="site-btn" name="rechercher" value="rechercher"> Rechercher</button>
                            </form>
                        </div>
                        
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+237 692 801 450</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                     
                    <div class="selection" style="max-height: 387px; overflow-Y: scroll;">
                    <div class="quitter section-title"> 
                        <h4>votre recherche</h4>
                        <?php if(isset($_POST['quit'])){ ?> <style> .selection{ display: none ;} </style> <?php } ?>
                    </div>
                    <?php 
                        if (isset($_POST['rechercher']) && isset($_POST['query']) && !empty($_POST['query'])) {
                            
                        $query = $_POST['query'];

                        $recherche = connect()->prepare("SELECT * FROM produits WHERE libelle LIKE ?");
                        $recherche->execute(array('%' . $query . '%'));
                        $resultat = $recherche->fetchAll();


                        if ($resultat) {
                            foreach ($resultat as $re) { ?>
                                <div class="col-lg-3 col-md-4 col-sm-6 ">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" data-setbg="images/<?php echo $re['image']; ?>">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="#"><?php echo $re['libelle']; ?></a></h6>
                                            <h5><?php echo $re['prix']; ?><span>  Fcfa</span></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php }
        } else {
            echo "aucun resultat"; ?>
       <?php }} else { ?>
        <style>
            .selection{ display: none;}
            </style>
   <?php }?>
                    </div>
                    
                    <div class="hero__item set-bg" data-setbg>
                        <div class="hero__text">
                            <span>A la une</span>
                            <h2><?php foreach($repprod1 as $rep1){ echo $rep1['libelle']; } ?></h2>
                            <p>Disponible a seulement ...</p>
                            <a href="#" class="primary-btn">ACHETER MAINTENANT</a>
                        </div>
                        <img src="images/<?php foreach($repprod1 as $rep1){ echo $rep1['image']; } ?>">
                    </div>
                       
                </div>
            </div>
        </div>
    </section>
    
    <!-- Hero Section End -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>DERNIERS ARTICLES</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php 
                    $reqprod2 = connect()->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 12");
                    $reqprod2->execute(array());
                    $repprod2 = $reqprod2->fetchAll();  
                    
                    foreach($repprod2 as $prod2){ ?>
                        <div class="col-lg-3 col-md-4 col-sm-6  ">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="images/<?php echo $prod2['image']; ?>">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#"><?php echo $prod2['libelle']; ?></a></h6>
                                    <h5><?php echo $prod2['prix']; ?><span>  Fcfa</span></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

            </div>
        </div>
    </section>
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="ogani-master/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="ogani-master/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Footer Section Begin -->
    <?php include("footer.php") ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <?php include("javascript.php") ?>
</body>

</html>

<?php } ?>
     
