<?php
    session_start();
    if(isset($_SESSION['id'])){
        require 'header.php';
    }else{
        require 'header_non_connexion.php';
    }
?>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="ogani-master/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Tout de chez FRESHSOP</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Accueil</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>CATHEGORIES</h4>
                            <ul>
                                <?php $cat = $DB->query("SELECT * FROM cathegories");
                                    foreach($cat as $c):
                                ?>
                                <li><a href="filtre.php?id=<?=$c->id?>"><?=$c->libelle?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Prix</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="100" data-max="5000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Couleurs</h4>
                            <?php $color = $DB->query("SELECT * FROM couleurs"); ?>
                            <?php foreach($color as $co): ?>
                            <div class="sidebar__item__color sidebar__item__color--<?=$co->nomCouleur?>">
                                <label for="<?=$co->nomCouleur?>">
                                    <?=$co->nomCouleur?>
                                </label>
                                <input type="radio" id="<?=$co->id?>" value="<?=$co->nomCouleur?>" name="couleur" class="grille_couleurs" >
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="sidebar__item">
                            <h4>Tailles disponibles</h4>
                            <?php $tail = $DB->query("SELECT * FROM taille"); ?>
                            <?php foreach($tail as $ta): ?>
                            <div class="sidebar__item__size">
                                <label for="<?=$ta->nomTaille?>">
                                    <?=$ta->nomTaille?>
                                    <input type="radio" id="<?=$ta->nomTaille?>">
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Derniers produits</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php $late = $DB->query("SELECT * FROM produits ORDER BY id DESC LIMIT 4"); ?>
                                        <?php foreach ($late as $l): ?>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="images/<?=$l->image?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?=$l->nom?></h6>
                                                <span><?= number_format($l->prix,2,',',' ')?></span>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php $late = $DB->query("SELECT * FROM produits ORDER BY id ASC LIMIT 4"); ?>
                                        <?php foreach ($late as $l): ?>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="images/<?=$l->image?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?=$l->nom?></h6>
                                                <span><?= number_format($l->prix,2,',',' ')?></span>
                                            </div>
                                        </a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>En solde</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <?php $solde = $DB->query("SELECT * FROM produits, cathegories WHERE solde = 1 AND cathegories.id = produits.cathegorie"); ?>
                                <?php foreach ($solde as $sol): ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="images/<?=$sol->image?>">
                                            <div class="product__discount__percent">-<?= ceil(100 - 100 * ($sol->prix / $sol->ancien_prix)) ?> %</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="addpanier.php?id=<?=$sol->id?>&&addpanier=<?=$sol->id?>"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span><?=$sol->libelle?></span>
                                            <h5><a href="#"><?=$sol->nom?></a></h5>
                                            <div class="product__item__price"><?=$sol->prix?> <span><?=$sol->ancien_prix?></span></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php $produits = $DB->query("SELECT * FROM produits ORDER BY id DESC"); ?>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Filtrer par</span>
                                    <select>
                                        <option value="0">prix</option>
                                        <option value="0">nom</option>
                                        <option value="0">cathegorie</option>
                                        <option value="0">couleur</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span><?= count($produits) ?></span> Produits trouvés</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($produits as $prod): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6" id="product__item<?=$prod->id?>">
                            <div class="product__item" >
                                <div class="product__item__pic set-bg" data-setbg="images/<?= $prod->image ?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?= $prod->nom ?></a></h6>
                                    <h5><?= number_format($prod->prix, 2, ',', ' ') ?></h5>
                                </div>
                                <input type="hidden" value="<?=$prod->id?>" name="id">
                                <input type="hidden" value="<?=$prod->nom?>" name="nom">
                                <input type="hidden" value="<?=$prod->prix?>" name="prix" id="prix<?=$prod->id?>">
                                <input type="hidden" value="<?=$prod->couleur?>" name="couleur">
                                <input type="hidden" value="<?=$prod->taille?>" name="taille">
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
    <?php require 'footer.php'; ?>