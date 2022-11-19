<?php

include("../includes/connexion.php");
    
  $requete = connect()->prepare("SELECT * FROM fournisseurs"); 
  $requete->execute();
  $fournisseur = $requete->fetchAll();
   
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
                                <th>Nom</th>
                                <th>Mail</th>
                                <th>Ville</th>
                                <th>Quartier</th>
                                <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1;
                              foreach($fournisseur as $four){ 
                                $reqvil = connect()->prepare("SELECT * FROM villes");
                                $reqvil->execute();
                                $vil = $reqvil->fetchAll();
                                
                                $reqquar = connect()->prepare("SELECT * FROM quartiers");
                                $reqquar->execute();
                                $quar = $reqvil->fetchAll();
                                ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $four['nom']; ?></td>
                                <td><?php echo $four['mail']; ?></td>
                                <td><?php echo $four['ville']; ?></td>
                                <td><?php echo $four['quartier']; ?></td>
                                <td>
                                    <a type="button" class="btn btn-warning btn-rounded btn-icon"  href="modifier.php?id=<?php  echo $four['id']; ?>">
                                        <i class="typcn typcn-edit"></i>
                                    </a>
                                    <a type="button" class="btn btn-danger btn-rounded btn-icon"  href="supprimer.php?id=<?php  echo $four['id']; ?>">
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