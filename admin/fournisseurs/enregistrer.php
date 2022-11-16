<?php 
  

  if (isset($_POST['enregistrer']))
  {
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $ville = $_POST['ville']; 
    $quartier = $_POST['quartier']; 

    if(empty($nom)){
      $error = "Veuillez entrer votre login"; 
      echo $error;
    }
    elseif(empty($ville)){ 
      $error = "Veuillez entrer votre mot de passe"; 
      echo $error;
    }
    elseif(empty($quartier)){ 
      $error = "Veuillez entrer votre mot de passe"; 
      echo $error;
    }
    else{
      include("../includes/connexion.php");
      $requete = connect()->prepare("INSERT INTO fournisseurs(nomFournisseur,mail,ville,quartier) VALUES(?,?,?,?)");
      $requete->execute(array($nom,$mail,$ville,$quartier));
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
              <h4 class="card-title text-center">Enregistrer un fournisseur</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Nom du fournisseur</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Adresse mail</label>
                  <input type="email" class="form-control" id="exampleInputMail" placeholder="E-mail" name="mail">
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Ville</label>
                  <select class="form-control" id="exampleInputVille" name="ville">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="form-control" id="exampleInputQuartier" name="quartier">
                    <option value="">--</option>
                  </select>
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

