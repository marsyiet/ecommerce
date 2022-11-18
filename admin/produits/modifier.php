<?php
include("../includes/connexion.php");
  $id = $_GET['id'];

  $reqcat = connect()->prepare("SELECT * FROM cathegories WHERE etat =0");
  $reqcat->execute();
  $repcat = $reqcat->fetchAll();

  $reqfour = connect()->prepare("SELECT * FROM fournissuers WHERE etat =0");
  $reqfour->execute();
  $repfour = $reqfour->fetchAll();

  try{
    
    $reqprod = connect()->prepare("SELECT * FROM produits WHERE id= ?"); 
    $reqprod->execute(array($id));
    $repprod = $reqprod->fetchAll();

   if (isset($_POST['modifier'])){

      $libelle = $_POST['libelle'];
      $fournisseur = $_POST['fournisseur'];
      $date = $_POST['date'];
      $qte = $_POST['qte'];
      $id1 = $_POST['id'];
      $error = "";
   
        
      if(empty($login)){ 
        $error = "Veuillez remplir tous les champs"; 
        echo "error";
      }
      else{
        $requete = connect()->prepare("UPDATE produits SET  libelle = :libelle, fournisseur = :fournisseur, date = :date, qte = :qte  WHERE id = :id1");
        $requete->execute(array(
        'libelle' => $libelle,
        'fournisseur' => $fournisseur,
        'date' => $date,
        'qte' => $qte,
        'id1' => $id1 ));

        if($requete){
          echo "inscription ok";
          header("Location: liste.php");
        }
              
      }
        
        
    }
    }
    catch (PDOException $e ){
        echo "Erreur de connection a la base de donnée : ". $e->getMessage();
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
              <h4 class="card-title text-center">Modifier un produit</h4>
              <form class="forms-sample" action="modifier.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Nom du produit</label>
                  <input type="text" class="form-control" id="exampleInputnom" value="<?php foreach($repprod as $prod){ echo $prod['nom'];}?>" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Cathégorie</label>
                  <select class="form-control" id="exampleInput1" name="cathegorie">
                    <option value="">--</option>
                    <?php foreach($repcat as $cat){ ?>
                    <option ><?php echo $cat['libelle'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Fournisseur</label>
                  <select class="form-control" id="exampleInput1" name="cathegorie">
                    <option value="">--</option>
                    <?php foreach($repprod as $prod){ ?>
                    <option ><?php echo $prod['libelle'] ?></option>
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
                <button type="submit" class="btn btn-primary mr-2" name="modifier">Modifier</button>
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

