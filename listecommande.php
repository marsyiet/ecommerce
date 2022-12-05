<?php
include("menu.php");

if($_SESSION['id']){



    $requete = connect()->prepare("SELECT * FROM commandes WHERE etat = 1"); 
    $requete->execute();
    $commandes = $requete->fetchAll();


   
?>
<!DOCTYPE html>
<html lang="en">

<head>
<?php include("css.php"); ?> 
</head>
<body>
      <!-- partial -->
      <div class="main-panel">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="table-responsive pt-3">
              <div class="col-lg-12 text-left mb-5">
            <h3 class="page-title">Toutes vos commandes</h3>
          </div>
                <table class="table table-striped project-orders-table">
                  <thead>
                    <tr>
                      <th class="ml-5">Numéro</th>
                      <th>Nom</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1;
                    foreach($commandes as $com){ 
                    $reqprod = connect()->prepare("SELECT * FROM livres WHERE id=?");
                    $reqprod->execute(array($com['id']));
                    $produit = $reqprod->fetch();?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $produit['libelle']; ?></td>
                      <td><?php echo $com['date']; ?></td>
                    <!--  <td>
                        <div class="d-flex align-items-center">
                          <a type="button" class="btn btn-success btn-sm btn-icon-text mr-3" href="modifier.php?id=<?php  echo $aut['id']; ?>">
                            Éditer
                            <i class="typcn typcn-edit btn-icon-append"></i>                          
                    </a>
                          <a type="button" class="btn btn-danger btn-sm btn-icon-text" href="supprimer.php?id=<?php  echo $aut['id']; ?>">
                            Supprimer
                            <i class="typcn typcn-delete-outline btn-icon-append"></i>                          
                    </a>
                        </div>
                      </td> -->
                    </tr><?php $i++; } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <?php include("footer.php"); ?>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
<?php } else{ header("Location: ../login.php");} ?>