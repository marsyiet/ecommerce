<?php 
    include("../includes/connexion.php");

    if (isset($_POST['enregistrer']))
    {
      $paiement = $_POST['paiement']; 

      if(empty($paiement)){
        $error = "Veuillez entrer votre paiement"; 
        echo $error;
      }
      else{
        $reqpaie = connect()->prepare("INSERT INTO paiements(libelle) VALUES(?)");
        $reqpaie->execute(array($paiement));
        if($requete){
          echo "ok";
          header("Location:enregistrer.php");
        }
      }
            
    }
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
              <h4 class="card-title text-center">Enregistrer une paiement</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Libellé</label>
                  <input type="text" class="form-control" id="exampleInputlibelle" placeholder="Libellé" name="paiement">
                </div>
                <button type="submit" class="btn btn-primary mr-2" name="enregistrer">Enregistrer</button>
                <button class="btn btn-light">Cancel</button>
              </form>
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

