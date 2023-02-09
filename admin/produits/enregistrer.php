<?php 
  
  include("../includes/connexion.php");

  $requete1 = connect()->prepare("SELECT * FROM cathegories WHERE etat = 0");
  $requete1->execute();
  $reponse1 = $requete1->fetchAll();

  $requete2 = connect()->prepare("SELECT * FROM fournisseurs WHERE etat = 0");
  $requete2->execute();
  $reponse2 = $requete2->fetchAll();

  $requete3 = connect()->prepare("SELECT * FROM couleurs");
  $requete3->execute();
  $reponse3 = $requete3->fetchAll();

  $requete4 = connect()->prepare("SELECT * FROM taille");
  $requete4->execute();
  $reponse4 = $requete4->fetchAll();

  if (isset($_POST['enregistrer']))
  {
    $image = $_FILES['image']['name'];
    $nom = $_POST['nom'];
    $cathegorie = $_POST['cathegorie'];
    $fournisseur = $_POST['fournisseur']; 
    $date = $_POST['date']; 
    $qte = $_POST['qte'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];
    $couleur = $_POST['couleur'];
    $taille = $_POST['taille'];


    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

    if(empty($nom) && empty($cathegorie) && empty($fournisseur) && empty($date) && empty($qte) && empty($prix) && empty($description) && empty($couleur) && empty($taille)){
      $error = "Veuillez remplir tous les champs"; 
      echo $error;
    }
    else{ 
        if (in_array($extension_upload, $extensions_autorisees))
        {            
          echo "extension correcte";
          $requete = connect()->prepare("INSERT INTO produits(image,nom,prix,cathegorie,fournisseur,date,qte,description,couleur,taille) VALUES(?,?,?,?,?,?,?,?,?,?)");
          $requete->execute(array($image,$nom,$prix,$cathegorie,$fournisseur,$date,$qte,$description,$couleur,$taille));
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
  <?php include("../includes/navbar.php"); ?>
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
                  <label for="exampleimage">Image</label>
                  <input type="file" class="form-control" id="exampleimage"  name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Libelle</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Libellé" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Prix</label>
                  <input type="number" class="form-control" id="exampleInputprix" name="prix">
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Cathégories</label>
                  <select class="js-example-basic-single w-100" name="cathegorie" style="color:black">
                    <?php foreach($reponse1 as $rep1){ ?>
                    <option value="<?php echo $rep1['id']; ?>" ><?php echo $rep1['libelle']; ?></option><?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">fournisseurs</label>
                  <select class="js-example-basic-single w-100" name="fournisseur" style="color:black">
                    <?php foreach($reponse2 as $rep2){ ?>
                    <option value="<?php echo $rep2['id']; ?>" ><?php echo $rep2['nom']; ?></option><?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="password">Date d'acquisition</label>
                  <input type="date" class="form-control " id="exampleInputDate" name="date">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Quantité</label>
                  <input type="number" class="form-control" id="exampleInputMail" name="qte">
                </div>
                <div class="form-group">
                  <label for="exampleInputdes">Description</label>
                  <textarea class="form-control" id="exampleInputdes" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputcouleur">Couleur</label>
                  <select class="js-example-basic-single w-100" name="couleur" style="color:black">
                    <?php foreach($reponse3 as $rep3){ ?>
                    <option value="<?php echo $rep3['id']; ?>" ><?php echo $rep3['nomCouleur']; ?></option><?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputtaille">Taille</label>
                  <select class="js-example-basic-single w-100" name="taille" style="color:black">
                    <?php foreach($reponse4 as $rep4){ ?>
                    <option value="<?php echo $rep4['id']; ?>" ><?php echo $rep4['nomTaille']; ?></option><?php } ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2 "  name="enregistrer">Enregistrer</button>
                <a type="button" href="index.php" class="btn btn-light">Cancel</button>
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

