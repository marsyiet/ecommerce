<?php
  $id = $_GET['id'];
  include("../includes/connexion.php");

  $reqcat = connect()->prepare("SELECT * FROM cathegories WHERE etat =0");
  $reqcat->execute();
  $repcat = $reqcat->fetchAll();

  $reqfour = connect()->prepare("SELECT * FROM fournisseurs WHERE etat =0");
  $reqfour->execute();
  $repfour = $reqfour->fetchAll();

  try{
        $reqprod = connect()->prepare("SELECT * FROM produits WHERE id= ?"); 
        $reqprod->execute(array($id));
        $repprod = $reqprod->fetchAll();

   if (isset($_POST['modifier'])){
      $image = $_POST['image'];
      $nom = $_POST['nom'];
      $cathegorie = $_POST['cathegorie'];
      $fournisseur = $_POST['fournisseur'];
      $date = $_POST['date'];
      $qte = $_POST['qte'];
      $prix = $_POST['prix'];
      $id1 = $_POST['id'];
      $error = "";
   
        
      if(empty($nom) && empty($fournisseur) && empty($cathegorie) && empty($qte)){ 
        $error = "Veuillez remplir tous les champs"; 
        echo $error;
      }
      else{
        $requete = connect()->prepare("UPDATE produits SET  image= :image, nom = :nom, prix = :prix, cathegorie = :cathegorie, fournisseur = :fournisseur, date = :date, qte = :qte  WHERE id = :id1");
        $requete->execute(array(
        'image' => $image,
        'nom' => $nom,
        'prix' => $prix,
        'cathegorie' => $cathegorie,
        'fournisseur' => $fournisseur,
        'date' => $date,
        'qte' => $qte,
        'id1' => $id1 ));

        

        if($requete){
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
  <?php include("../includes/navbar.php"); ?>
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
                  <input type="hidden" class="form-control" id="exampleInputnom" value="<?php foreach($repprod as $prod){ echo $prod['id'];}?>" name="id">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">image</label>
                  <input type="file" class="form-control" id="exampleInputnom" value="<?php foreach($repprod as $prod){ echo $prod['image'];}?>" name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Libellé</label>
                  <input type="text" class="form-control" id="exampleInputnom" value="<?php foreach($repprod as $prod){ echo $prod['nom'];}?>" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputqte">Prix</label>
                  <input type="number" class="form-control" id="exampleInputprix" name="prix" value="<?php foreach($repprod as $prod){ echo $prod['prix'];}?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Cathégorie</label>
                  <select class="form-control" id="exampleInput1" name="cathegorie">
                    <?php foreach($repcat as $cat){ ?>
                    <option ><?php echo $cat['libelle'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Fournisseur</label>
                  <select class="form-control" id="exampleInput1" name="fournisseur">
                    <?php foreach($repfour as $four){ ?>
                    <option ><?php echo $four['nom'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputDate">Date d'acquisition</label>
                  <input type="date" class="form-control" id="exampleInputDate" name="date" value="<?php foreach($repprod as $prod){ echo $prod['date'];}?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputqte">Quantité</label>
                  <input type="number" class="form-control" id="exampleInputDate" name="qte" value="<?php foreach($repprod as $prod){ echo $prod['qte'];}?>">
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

