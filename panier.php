<?php require 'header.php'; ?>
    <section class="hero">
        <div class="container">
            <div class="content-wrapper">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center"><i class="fa fa-shopping-cart"> Panier de courses </i></h4>
                            <form method="POST" action="panier.php">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>N</th>
                                            <th> </th>
                                            <th>Nom</th>
                                            <th>Prix</th>
                                            <th>Quantité</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ids = array_keys($_SESSION['panier']);
                                            if (empty($ids)) {
                                                $produits = array();
                                            }
                                            else{
                                                $produits = $DB->query('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
                                            }
                                            $i = 1;
                                            foreach($produits as $prod): 
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><img src="images/<?= $prod->image?>" width="70px" height="auto"></td>
                                                <span class="nom"><td><?= $prod->nom?></td></span>
                                                <span class="prix"><td><?= $prod->prix?></td></span>
                                                <span class="quantite"><td><input type="text" name="panier[quantite][<?= $prod->id; ?>]" value="<?= $_SESSION['panier'][$prod->id];?>"></td></span>
                                                <span class="actions">
                                                    <td>
                                                        <a type="button" class="btn btn-warning btn-succed btn-icon" href="modifier.php?id=<?=$prod->id?>">
                                                            <i class="fa fa-eye"></i>A propos
                                                        </a>
                                                        <a type="button" class="btn btn-danger btn-rounded btn-icon" href="panier.php?delpanier=<?=$prod->id?>">
                                                            <i class="fa fa-trash"></i>Retirer
                                                        </a>            
                                                    </td>
                                                </span>
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <input type="submit" value="Recalculer" name="recalculer" class="site-btn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
<?php require 'footer.php'; ?>