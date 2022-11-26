<?php 
include("../includes/connexion.php");
  $requete1 = connect()->prepare("SELECT * FROM villes");
  $requete1->execute();
  $reponse1 = $requete1->fetchAll();

  $requete2 = connect()->prepare("SELECT * FROM quartiers");
  $requete2->execute();
  $reponse2 = $requete2->fetchAll();

  if (isset($_POST['enregistrer']))
  {
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $ville = $_POST['ville']; 
    $quartier = $_POST['quartier']; 

    if(empty($nom)){
      $error = "Veuillez entrer le nom"; 
      echo $error;
    }
    elseif(empty($ville)){ 
      $error = "Veuillez choisir une ville"; 
      echo $error;
    }
    elseif(empty($quartier)){ 
      $error = "Veuillez choisir un quartier"; 
      echo $error;
    }
    else{
      
      $requete = connect()->prepare("INSERT INTO livreurs(nom,mail,ville,quartier) VALUES(?,?,?,?)");
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
  <?php include("../includes/navbar.php"); ?>
<div class="container-fluid page-body-wrapper">
  <?php include("../includes/sidebar.html"); ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">Enregistrer un livreur</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Nom du livreur</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Adresse mail</label>
                  <input type="email" class="form-control" id="exampleInputMail" placeholder="E-mail" name="mail">
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Ville</label>
                  <select class="form-control" id="exampleville" name="ville">
                    <option value="">--</option>
                    <?php foreach($reponse1 as $rep1){ ?>
                    <option value ="<?php echo $rep1['id'] ?>"><?php echo $rep1['nom']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="form-control" id="examplequartier" name="quartier">
                    <option value="">--</option>
                    <?php foreach($reponse2 as $rep2){ ?>
                    <option value="<?php echo $rep2['id'] ?>"><?php echo $rep2['nom']; ?></option>
                    <?php } ?>
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

