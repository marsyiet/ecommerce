<?php 
  

  if (isset($_POST['enregistrer']))
  {
    $nom = $_POST['nom'];
    $cathegorie = $_POST['cathegorie']; 
    $fournisseur  = $_POST['fournisseur'];
    $date  = $_POST['date'];

    if(empty($nom)){
      $error = "Veuillez entrer votre login"; 
      echo $error;
    }
    elseif(empty($cathegorie)){ 
      $error = "Veuillez entrer votre mot de passe"; 
      echo $error;
    }
    else{
      include("../includes/connexion.php");
      $requete = connect()->prepare("INSERT INTO produits(nomProduit,cathegorie,fournisseur,date) VALUES(?,?,?,?)");
      $requete->execute(array($nom,$cathegorie,$fournisseur,$date));
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
              <h4 class="card-title text-center">Enregistrer un produit</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Nom du produit</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Cathégorie</label>
                  <select class="form-control" id="exampleInput1" name="cathegorie">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Fournisseur</label>
                  <select class="form-control" id="exampleInput2" name="fournisseur">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputDate">Date d'acquisition</label>
                  <input type="date" class="form-control" id="exampleInputDate" name="date">
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

