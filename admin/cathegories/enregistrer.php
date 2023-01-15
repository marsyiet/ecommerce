<?php
require '../includes/connexion.php';
    if (isset($_POST['enregistrer']))
    {
      $cathegorie = $_POST['cathegorie']; 

      if(empty($cathegorie)){
        $error = "Veuillez entrer votre cathegorie"; 
        echo $error;
      }
      else{
        $requete = connect()->prepare("INSERT INTO cathegories(libelle) VALUES(?)");
        $requete->execute(array($cathegorie));
        //var_dump($requete);die();
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
              <h4 class="card-title text-center">Enregistrer une cathégorie</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Libellé</label>
                  <input type="text" class="form-control" id="exampleInputlibelle" placeholder="Libellé" name="cathegorie">
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

