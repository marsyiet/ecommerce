<?php
    session_start();
    if(isset($_SESSION['id'])){
        require 'header.php';
    }else{
        require 'header_non_connexion.php';
    }
?>
<div class="container">
    <div class="row featured__filter">
        <?php
        require 'admin/includes/connexion.php';
        $count = connect()->prepare("SELECT count(id) AS cpt FROM produits");
        $count->setFetchMode(PDO::FETCH_ASSOC);
        $count->execute();
        $tcount = $count->fetchAll();

        @$page = $_GET["page"];
        if (empty($page))
            $page = 1;
        $nb_elements_page = 8;
        $nb_pages = ceil($tcount[0]["cpt"] / $nb_elements_page);
        $debut = ($page - 1) * $nb_elements_page;

        if (isset($_GET['id'])) {
            $mixe = $DB->query("SELECT * FROM produits, cathegories WHERE cathegories.libelle = ? AND cathegories.id = produits.cathegorie ORDER BY produits.id DESC LIMIT $debut,$nb_elements_page", array($_GET['id'])); 
            if(count($mixe)>0){
            foreach ($mixe as $g): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix resultats">      
                    <div class="featured__item ">
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
            <?php endforeach; ?>
                
            <?php } else { ?>
            <p style="margin: 5%;"><h2>Aucun article trouvé</h2></p>
            <?php } ?>
        <?php } elseif (isset($_GET['recherche'])) {
            $nom = $_GET['nom'];
            $mixe = $DB->query("SELECT * FROM produits WHERE nom LIKE ? ORDER BY id DESC LIMIT $debut,$nb_elements_page", array('%'.$nom.'%'));
            if(count($mixe)>0){
            foreach ($mixe as $g): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 mix resultats" id="<?=$g->id?>">      
                <div class="featured__item" >
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
            <?php endforeach; ?>
        <?php } else { ?>
            <p style="margin: 5%;"><h2>Aucun article trouvé</h2></p>
        <?php } ?>
        <?php } else { ?>
            <p style="margin: 5%;"><h2>Aucun article trouvé</h2></p>
        <?php } ?>
    </div>
<?php require 'footer.php';?>