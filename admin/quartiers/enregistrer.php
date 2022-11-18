<?php 
  include("../includes/connexion.php");
    if (isset($_POST['enregistrer']))
    {
      $quartier = $_POST['quartier'];

      if(empty($quartier)){
        $error = "Veuillez entrer un nom de quartier existant"; 
        echo $error;
      }
      else{
        
        $reqquar = connect()->prepare("INSERT INTO quartiers(nom) VALUES(?)");
        $reqquar->execute(array($quartier));
        if($reqquar){
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
              <h4 class="card-title text-center">Enregistrer un quartier</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Quartier</label>
                  <input type="text" class="form-control" id="exampleInputNom" placeholder="Nom du quartier" name="quartier">
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

