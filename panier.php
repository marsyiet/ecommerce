<?php require 'header.php'; ?>
<?php if(isset($_GET['del'])){
    $panier->del($_GET['del']);
}
?>
    <section class="hero">
        <div class="container">
            <div class="content-wrapper">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center"><i class="fa fa-shopping-cart"> Panier de courses </i></h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>N</th>
                                        <th> </th>
                                        <th>Nom</th>
                                        <th>Prix</th>
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
                                        foreach($produits as $prod): $i = 1
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><img src="images/<?= $prod->image?>" width="70px" height="auto"></td>
                                            <td><?= $prod->nom?></td>
                                            <td><?= $prod->prix?></td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-succed btn-icon" href="modifier.php?id=<?=$prod->id?>">
                                                    <i class="fa fa-eye"></i>A propos
                                                </a>
                                                <a type="button" class="btn btn-danger btn-rounded btn-icon" href="panier.php?del=<?=$prod->id?>">
                                                    <i class="fa fa-trash"></i>Retirer
                                                </a>            
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
<?php require 'footer.php'; ?>