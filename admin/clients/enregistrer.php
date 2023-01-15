<?php 
include("../includes/connexion.php");
  $reqquar = connect()->prepare("SELECT * FROM quartiers");
  $reqquar->execute();
  $repquar = $reqquar->fetchAll();

  $reqvil = connect()->prepare("SELECT * FROM villes");
  $reqvil->execute();
  $repvil = $reqvil->fetchAll();

  if (isset($_POST['enregistrer']))
  {
  $image = $_POST['image'];
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
      
      $requete = connect()->prepare("INSERT INTO fournisseurs(image,nom,mail,ville,quartier) VALUES(?,?,?,?,?)");
      $requete->execute(array($image,$nom,$mail,$ville,$quartier));
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
              <h4 class="card-title text-center">Enregistrer un client</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnim">image</label>
                  <input type="file" class="form-control" id="exampleInputim"  name="image">
                </div>
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
                  <select class="form-control" id="exampleville" name="ville">
                    <option value="">--</option>
                    <?php foreach($repvil as $repv){ ?>
                    <option value ="<?php echo $repv['id'] ?>"><?php echo $repv['nomVille']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="form-control" id="examplequartier" name="quartier">
                    <option value="">--</option>
                    <?php foreach($repquar as $repq){ ?>
                    <option value="<?php echo $repq['id'] ?>"><?php echo $repq['nomQuartier']; ?></option>
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


