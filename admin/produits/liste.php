<?php

include("../includes/connexion.php");
    
  $requete = connect()->prepare("SELECT * FROM produits"); 
  $requete->execute();
  $produit = $requete->fetchAll();
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("../includes/head.html"); ?>
</head>
<body>

  <div class="container-scroller">
    <?php include("../includes/navbar.php"); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include("../includes/sidebar.html"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Liste des produits</h4>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>N</th>
                                <th>Libellé</th>
                                <th>Prix</th>
                                <th>Cathégorie</th>
                                <th>Date d'achat</th>
                                <th>Quantité</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1;
                              foreach($produit as $prod){ 
                                $reqcat = connect()->prepare("SELECT * FROM cathegorie");
                                $reqcat->execute();
                                $cat = $reqcat->fetchAll();
                                
                                ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $prod['libelle']; ?></td>
                                <td><?php echo $prod['prix']; ?></td>
                                <td><?php echo $prod['cathegorie']; ?></td>
                                <td><?php echo $prod['date']; ?></td>
                                <td><?php echo $prod['qte']; ?></td>
                                <td>
                                    <a type="button" class="btn btn-warning btn-rounded btn-icon"  href="modifier.php?id=<?php  echo $prod['id']; ?>">
                                        <i class="typcn typcn-edit"></i>
                                    </a>
                                    <a type="button" class="btn btn-danger btn-rounded btn-icon"  href="supprimer.php?id=<?php  echo $prod['id']; ?>">
                                        <i class="typcn typcn-trash"></i>
                                    </a>            
                                </td>
                              </tr>
                              </tr><?php $i++; } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                </div>
              </div>
        </div>
        <?php include("../includes/footer.html"); ?>
      </div>
    </div>
  </div>
</body>

</html>