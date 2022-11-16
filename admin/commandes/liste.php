<?php

include("../includes/connexion.php");
    
  $requete = connect()->prepare("SELECT * FROM commandes"); 
  $requete->execute();
  $commande = $requete->fetchAll();
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("../includes/head.html"); ?>
</head>
<body>

  <div class="container-scroller">
    <?php include("../includes/navbar.html"); ?>
    <div class="container-fluid page-body-wrapper">
      <?php include("../includes/sidebar.html"); ?>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Liste des Utilisateurs</h4>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>N</th>
                                <th>Numéro de commande</th>
                                <th>Produit</th>
                                <th>Client</th>
                                <th>Mode de paiement</th>
                                <th>Ville</th>
                                <th>Quartier</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1;
                              foreach($commande as $com){ 
                                $reqvil = connect()->prepare("SELECT * FROM villes");
                                $reqvil->execute();
                                $vil = $reqvil->fetchAll();
                                
                                $reqquar = connect()->prepare("SELECT * FROM quartiers");
                                $reqquar->execute();
                                $quar = $reqquar->fetchAll();

                                $reqpaie = connect()->prepare("SELECT * FROM paiement");
                                $reqpaie->execute();
                                $paie = $reqpaie->fetchAll();

                                $reqclient = connect()->prepare("SELECT * FROM clients");
                                $reqclient->execute();
                                $cli = $reqcli->fetchAll();

                                $reqprod = connect()->prepare("SELECT * FROM produits");
                                $reqprod->execute();
                                $prod = $reqprod->fetchAll();
                                ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $com['idCommande']; ?></td>
                                <td><?php echo $cli['nom']; ?></td>
                                <td><?php echo $prod['nom']; ?></td>
                                <td><?php echo $paie['libelle']; ?></td>
                                <td><?php echo $vil['nomVille']; ?></td>
                                <td><?php echo $quar['nomQuartier']; ?></td>
                                <td>
                                    <a type="button" class="btn btn-warning btn-rounded btn-icon" href="modifier.php">
                                        <i class="typcn typcn-edit"></i>
                                    </a>
                                    <a type="button" class="btn btn-danger btn-rounded btn-icon" href="supprimer.php">
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