<?php require 'header.php'; ?>
<div class="container">
    <div class="row">
        <?php
        $ids = array_keys($_SESSION['favori']);
        if (empty($ids)) {
            $produits = array();
        }
        else{
            $produits = $DB->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
        }
        $i = 1;
        foreach($produits as $prod): 
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mix ">
            <div class="featured__item">
                <div class="featured__item__pic set-bg" data-setbg="images/<?= $prod->image ?>">
                    <ul class="featured__item__pic__hover">
                        <?php if (empty($_SESSION['favori'][$prod->id])) { ?>
                        <li><a class="add addfavori" href="addfavori.php?addfavori=<?= $prod->id ?>"><i class="fa fa-heart"></i></a></li>
                        <?php } else { ?>
                        <li><a class="" href="index.php?delfavori=<?= $prod->id ?>"><i class="fa fa-trash"></i></a></li>
                        <?php } ?>
                        <li><a href="addlike.php?t=1&id=<?= $prod->id ?>"><i class="fa fa-thumbs-up"></i></a></li>
                        <li><a class="add addpanier" href="addpanier.php?addpanier=<?= $prod->id ?>"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require 'footer.php'; ?>
