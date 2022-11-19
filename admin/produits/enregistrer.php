<?php 
  
  include("../includes/connexion.php");

  $requete1 = connect()->prepare("SELECT * FROM cathegories WHERE etat = 0");
  $requete1->execute();
  $reponse1 = $requete1->fetchAll();

  $requete2 = connect()->prepare("SELECT * FROM fournisseurs WHERE etat = 0");
  $requete2->execute();
  $reponse2 = $requete2->fetchAll();

  if (isset($_POST['enregistrer']))
  {
    $image = $_FILES['image']['name'];
    $libelle = $_POST['libelle'];
    $cathegorie = $_POST['cathegorie'];
    $fourisseur = $_POST['fourisseur']; 
    $date = $_POST['date']; 
    $qte = $_POST['qte'];


    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

    if(empty($libele) && empty($cathegorie) && empty($fournisseur) && empty($image) && empty($date)){
      $error = "Veuillez remplir tous les champs"; 
      echo $error;
    }
    else{ 
        if (in_array($extension_upload, $extensions_autorisees))
        {            
          echo "extension correcte";
          $requete = connect()->prepare("INSERT INTO clients(image,libelle,cathegorie,fournisseur,dte,qte) VALUES(?,?,?,?,?,?)");
          $requete->execute(array($image,$libelle,$cathegorie,$fournisseur,$dte,$qte));
        }else{
          echo "format de l'image incorrect; veuillez entrer une image aux formats 'jpg', 'jpeg', 'gif', 'png'";
        }            
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
              <form class="forms-sample" action="enregistrer.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="image">Image</label>
                  <input type="file" class="form-control form-control-lg" id="exampleimage"  name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Nom du produit</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="libelle">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Cathégorie</label>
                  <select class="form-control" id="exampleInput1" name="cathegorie">
                    <option value="">--</option>
                    <?php foreach($reponse1 as $cat){ ?>
                    <option ><?php echo $cat['libelle'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Fournisseur</label>
                  <select class="form-control" id="exampleInput1" name="fournisseur">
                    <option value="">--</option>
                    <?php foreach($reponse2 as $four){ ?>
                    <option ><?php echo $four['nom'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputDate">Date d'acquisition</label>
                  <input type="date" class="form-control" id="exampleInputDate" name="date">
                </div>
                <div class="form-group">
                  <label for="exampleInputqte">Quantité</label>
                  <input type="number" class="form-control" id="exampleInputDate" name="qte">
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

