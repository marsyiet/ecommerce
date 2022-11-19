<?php 
  
  include("../includes/connexion.php");

  $requete1 = connect()->prepare("SELECT * FROM villes WHERE etat = 0");
  $requete1->execute();
  $reponse1 = $requete1->fetchAll();

  $requete2 = connect()->prepare("SELECT * FROM quartiers WHERE etat = 0");
  $requete2->execute();
  $reponse2 = $requete2->fetchAll();

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
    elseif(empty($mail)){ 
      $error = "Veuillez entrer votre mail"; 
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
      $requete = connect()->prepare("INSERT INTO clients(nom,mail,ville,quartier) VALUES(?,?,?,?)");
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
              <h4 class="card-title text-center">Enregistrer un client</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Nom du client</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Adresse mail</label>
                  <input type="email" class="form-control" id="exampleInputMail" placeholder="E-mail" name="mail">
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Ville</label>
                  <select class="js-example-basic-single w-100" name="ville" style="color:black">
                    <?php foreach($reponse1 as $rep1){ ?>
                    <option value="<?php echo $rep1['id']; ?>" ><?php echo $rep1['nom']; ?></option><?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="js-example-basic-single w-100" name="quartier" style="color:black">
                    <?php foreach($reponse2 as $rep2){ ?>
                    <option value="<?php echo $rep2['id']; ?>" ><?php echo $rep2['nom']; ?></option><?php } ?>
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

