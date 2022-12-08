<?php
    session_start();
    if(isset($_SESSION["id"])){

    include("admin/includes/connexion.php");

    $reqcli = connect()->prepare("SELECT nom FROM clients WHERE id = ?");
    $reqcli->execute(array($_SESSION['id']));
    $cli = $reqcli->fetchAll();
?>
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
    <?php } ?>