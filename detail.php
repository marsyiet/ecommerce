<?php
session_start();
    if(isset($_SESSION['id'])){
        require 'header.php';
    }else{
        require 'header_non_connexion.php';
    }
?>
<?php
if (isset($_GET['id'], $_GET['nom'])) {
    
        if(isset($_POST['go'])){
            $note = $_POST['note'];
            $nom = $_POST['nom'];
            $commentaire = $_POST['commentaire'];
            $mail = $_POST['mail'];
        if (empty($nom) && empty($commentaire) && empty($mail)) {

        }else{
            $av = $DB->query('INSERT INTO avis(nom,mail,produit,note,commentaire) VALUES(?,?,?,?,?)', array($nom, $mail, $_GET['id'], $note, $commentaire));
            if ($av) {
                header('Location:google.com');
            }
        }
        }
    ?>
<!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="ogani-master/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Détails des produits</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Accueil</a>
                            <a href="filtre.php">Cathegorie</a>
                            <span>Détails du produit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            
            <?php
            
                $produit = $DB->query('SELECT * FROM produits WHERE id = ?', array($_GET['id']));
                $ressemble = $DB->query('SELECT * FROM produits WHERE nom like ? ORDER BY id DESC', array('%'.$_GET['nom'].'%'));
                foreach ($produit as $prod):


                    ?>
                    <?php
            $total = 0;
            for ($i = 0; $i <= 5; $i++) {
                
                $nbre[$i] = $DB->query('SELECT * FROM avis WHERE produit = ? AND note = ?', array($_GET['id'], $i));                                            
            }  
            $tout = $DB->query('SELECT * FROM avis');
            $total = 1 * count($nbre[1]) + 2 * count($nbre[2]) + 3 * count($nbre[3]) + 4 * count($nbre[4]) + 5 * count($nbre[5]);
            $global = ceil($total/count($tout))
            ?>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="images/<?= $prod->image ?>" alt="">
                        </div>

                        <div class="product__details__pic__slider owl-carousel">
                            <?php foreach($ressemble as $r): ?>
                                <a href="detail.php?id=<?= $r->id ?>&&nom=<?= $r->nom ?>">
                            <img data-imgbigurl="images/<?= $r->image ?>"
                                src="images/<?= $r->image ?>" alt="">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?= $prod->nom ?> Package</h3>
                        <?php $com = $DB->query('SELECT * FROM avis WHERE produit = ? ORDER BY id DESC LIMIT 3', array($prod->id)) ?>
                        <div class="product__details__rating">
                            <?php
                            $i = 0;
                            while($i < $global){ ?>
                            <i class="fa fa-star"></i>
                            <?php $i++; } ?>
                            <?php for($i = 0; $i < 5-$global; $i++){ ?>
                            <i class="fa fa-star-o empty"></i>
                            <?php } ?>
                            <span>(<?=count($com)?> reviews)</span>
                        </div>
                        <div class="product__details__price"><?= number_format($prod->prix, 2, ',', ' ') ?></div>
                        <p><?= $prod->description; ?></p>
                        <div class="product__details__quantity">
                            <div class="quantity" >
                                <div id="char-qty" style="display: none;">
                                    <div class='pro-qty'>
                                        <input type="text" value="1" name="<?=$prod->id?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="primary-btn addpanier" id="ajout" href="addpanier.php?id=<?= $prod->id ?>&&addpanier=<?= $prod->id ?>&&d=<?= $prod->id ?>">AJOUTER AU PANIER</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        <ul>
                            <li><b>Disponibilite</b> <span><?php if ($prod->qte > 0) {
                                echo 'En Stock';
                            } else {
                                echo '<samp>Indisponible</samp>';} ?></span></li>
                            <li><b>Livraison</b> <span>Estimé 24H. <samp>Free pickup today</samp></span></li>
                            <li><b>Poids</b> <span>0.5 kg</span></li>
                            <li><b>Partger sur</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Reviews <span>(<?=count($com)?>)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Notes et avis</h6>
                                    <div class="row">
										<!-- Rating -->
                                        <?php
                                        $total = 0;
                                        for ($i = 0; $i <= 5; $i++) {
                                            
                                            $nbre[$i] = $DB->query('SELECT * FROM avis WHERE produit = ? AND note = ?', array($prod->id, $i));                                            
                                        }  
                                        $tout = $DB->query('SELECT * FROM avis');
                                        $total = 1 * count($nbre[1]) + 2 * count($nbre[2]) + 3 * count($nbre[3]) + 4 * count($nbre[4]) + 5 * count($nbre[5]);
                                        $global = ceil($total/count($tout))
                                        ?>
                                        
                                         
                                        <div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span><?=$global?></span>
													<div class="rating-stars">
                                                    <?php 
                                                        $i = 0;
                                                        while($i < $global){ ?>
                                                        <i class="fa fa-star"></i>
                                                        <?php $i++; } ?>
                                                        <?php for($i = 0; $i < 5-$global; $i++){ ?>
                                                        <i class="fa fa-star-o empty"></i>
                                                    <?php  } ?>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
                                                            <div style="width: <?=count($nbre[5]) * 100 / count($tout)?>%;"></div>
														</div>
														<span class="sum"><?=count($nbre[5])?></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
                                                            <div style="width: <?=count($nbre[4]) * 100 / count($tout)?>%;"></div>
														</div>
														<span class="sum"><?=count($nbre[4])?></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: <?=count($nbre[3]) * 100 / count($tout)?>%;"></div>
														</div>
														<span class="sum"><?=count($nbre[3])?></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: <?=count($nbre[2]) * 100 / count($tout)?>%;"></div>
														</div>
														<span class="sum"><?=count($nbre[2])?></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
                                                            <div style="width: <?=count($nbre[1]) * 100 / count($tout)?>%;"></div>
														</div>
														<span class="sum"><?=count($nbre[1])?></span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->
                                        <?php $com = $DB->query('SELECT * FROM avis WHERE produit = ? ORDER BY id DESC LIMIT 3', array($prod->id)) ?>
                                        
                                        <div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
                                                    <?php foreach($com as $co): ?>
													<li>
														<div class="review-heading">
															<h5 class="name"><?=$co->nom?></h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
                                                                <?php 
                                                                $i = 0;
                                                                while($i < $co->note){ ?>
																<i class="fa fa-star"></i>
                                                                <?php $i++; } ?>
                                                                <?php for($i = 0; $i < 5-$co->note; $i++){ ?>
																<i class="fa fa-star-o empty"></i>
                                                                <?php  } ?>
															</div>
														</div>
														<div class="review-body">
															<p><?=$co->commentaire?></p>
														</div>
													</li>
                                                    <?php endforeach; ?>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->
                                        <div class="col-md-3">
                                            <div id="review-form">
                                                
                                                <form class="review-form" action="detail.php?id=<?=$prod->id?>&&nom=<?=$prod->nom?>" method="POST">
                                                    <input class="input" type="text" placeholder="Nom" name="nom">
                                                    <input class="input" type="email" placeholder="Email" name="mail">
                                                    <textarea class="input" placeholder="Laisser un commentaire" name="commentaire"></textarea>
                                                    <div class="input-rating">
                                                        <span>Votre note: </span>
                                                        <div class="rates">
                                                            <i class="lar la-star" data-value="1"></i><i class="lar la-star" data-value="2"></i><i class="lar la-star" data-value="3"></i><i class="lar la-star" data-value="4"></i><i class="lar la-star" data-value="5"></i>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="note" value="0" id="note"> 
                                                    <button type="submit" name="go" class="site-btn"> Envoyer un avis</button>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Description</h6>
                                    <p><?= $prod->description ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Inforamitions du produit</h6>
                                    <?php $inf = $DB->query('SELECT * FROM produits WHERE id = ?', array($prod->id)) ?>
                                    nom : <?=$prod->nom?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Produits liés</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach($ressemble as $r): ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="images/<?= $r->image ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a class="addpanier" href="addpanier.php?id=<?= $r->id ?>&&addpanier=<?= $r->id ?>&&d=<?= $r->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#"><?= $r->nom ?></a></h6>
                            <h5><?= number_format($r->prix,2,',',' ') ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endforeach; }?>

    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php require 'footer.php'; ?>