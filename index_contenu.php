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
        <div class="row" >
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
        <div class="row featured__filter" style="height:800px; overflow-y:scroll; ">
            <?php
            require 'admin/includes/connexion.php';

            $count= connect()->prepare("SELECT count(id) AS cpt FROM produits");
            $count->setFetchMode(PDO::FETCH_ASSOC);
            $count->execute();
            $tcount=$count->fetchAll();
        
            @$page=$_GET["page"];
            if(empty($page)) $page=1;
            $nb_elements_page=12;
            $nb_pages=ceil($tcount[0]["cpt"]/$nb_elements_page);
            $debut=($page-1) * $nb_elements_page;
        
            
            $selection = $DB->query("SELECT * FROM cathegories, produits  WHERE produits.cathegorie = cathegories.id ORDER BY produits.id DESC") ?>
            
            <?php foreach ($selection as $s): ?>
                <?php if($s->solde == 1){ ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix <?=$s->libelle?>">  
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="images/<?=$s->image?>">
                            <div class="product__discount__percent">-<?= ceil(100 - 100 * ($s->prix / $s->ancien_prix)) ?> %</div>
                            <ul class="product__item__pic__hover">
                                <li><a  href="detail.php?id=<?= $s->id ?>&&nom=<?= $s->nom ?>"><i class="fa fa-eye"></i></a></li>
                                <li><a class="addpanier" href="addpanier.php?id=<?= $s->id ?>&&addpanier=<?= $s->id ?>"  value="<?= $s->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span><?=$s->libelle?></span>
                            <h5><a href="#"><?=$s->nom?></a></h5>
                            <div class="product__item__price"><?=number_format($s->prix, 0, '.', ' ');?> <span><?=number_format($s->ancien_prix, 0, '.', ' ');?></span></div>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>  
                <div class="col-lg-3 col-md-4 col-sm-6 mix <?=$s->libelle?>">    
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="images/<?= $s->image ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a  href="detail.php?id=<?= $s->id ?>&&nom=<?= $s->nom ?>"><i class="fa fa-eye"></i></a></li>
                                <li><a class="addpanier" href="addpanier.php?id=<?= $s->id ?>&&addpanier=<?= $s->id ?>&&d=<?= $s->id ?>"  value="<?= $s->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><span><a href="#"><?= $s->nom ?></a></span></h6>
                            <h5><span><?= number_format($s->prix, 0, '.', ' '); ?></h5><br />
                        </div>
                    </div>
                </div>
                <?php } ?> 
            <?php endforeach ?>
        </div>
            
        <div class="col-lg-9 col-md-7" style="margin-top: 30px">
            <div class="product__discount">
                <div class="section-title product__discount__title">
                    <h2>En solde</h2>
                </div>
                <div class="row">
                    <div class="product__discount__slider owl-carousel">
                        <?php $solde = $DB->query("SELECT * FROM cathegories, produits WHERE solde = 1 AND cathegories.id = produits.cathegorie"); ?>
                        <?php foreach ($solde as $sol): ?>
                        <div class="col-lg-4">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                    data-setbg="images/<?=$sol->image?>">
                                    <div class="product__discount__percent">-<?= ceil(100 - 100 * ($sol->prix / $sol->ancien_prix)) ?> %</div>
                                    <ul class="product__item__pic__hover">
                                        <li><a  href="detail.php?id=<?= $sol->id ?>&&nom=<?= $sol->nom ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a class="addpanier" href="addpanier.php?id=<?= $sol->id ?>&&addpanier=<?= $sol->id ?>"  value="<?= $sol->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">
                                    <span><?=$sol->libelle?></span>
                                    <h5><a href="#"><?=$sol->nom?></a></h5>
                                    <div class="product__item__price"><?=$sol->prix?> <span><?=$sol->ancien_prix?></span></div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
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
                    <h4>Derniers Produits</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $late = $DB->query("SELECT * FROM produits ORDER BY id DESC LIMIT 4"); ?>
                            <?php foreach ($late as $l): ?>
                            <a href="detail.php?id=<?=$l->id?>&&nom=<?=$l->nom?>" class="latest-product__item">
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
                            <a href="detail.php?id=<?=$l->id?>&&nom=<?=$l->nom?>" class="latest-product__item">
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
                            <a href="detail.php?id=<?=$l->id?>&&nom=<?=$l->nom?>" class="latest-product__item">
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
                            <a href="detail.php?id=<?=$l->id?>&&nom=<?=$l->nom?>" class="latest-product__item">
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
                    <h4>produits les mieux notés</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            <?php $lik = $DB->query("SELECT * FROM avis, produits WHERE avis.produit = produits.id ORDER BY avis.note ASC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?id=<?=$l->id?>&&nom=<?=$l->nom?>" class="latest-product__item">
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
                        <?php $lik = $DB->query("SELECT * FROM avis, produits WHERE avis.produit = produits.id ORDER BY avis.note ASC LIMIT 4"); ?>
                            <?php foreach ($lik as $l): ?>
                            <a href="detail.php?id=<?=$l->id?>&&nom=<?=$l->nom?>" class="latest-product__item">
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

