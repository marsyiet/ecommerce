<?php 
    if (isset($_POST['enregistrer']))
    {
      $ville = $_POST['ville'];

      if(empty($ville)){
        $error = "Veuillez entrer votre login"; 
        echo $error;
      }
      else{
        include("../includes/connexion.php");
        $requete = connect()->prepare("INSERT INTO villes(nomVille) VALUES(?)");
        $requete->execute(array($ville));
        //var_dump($requete);die();
        if($requete){
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
  <?php include("../includes/navbar.html"); ?>
<div class="container-fluid page-body-wrapper">
  <?php include("../includes/sidebar.html"); ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Enregistrer une ville</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Ville</label>
                  <input type="text" class="form-control" id="exampleInputlibelle" placeholder="Nom de la ville" name="ville">
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

