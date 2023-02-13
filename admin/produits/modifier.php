<?php
  $id = $_GET['id'];
  include("../includes/connexion.php");

  $reqcat = connect()->prepare("SELECT * FROM cathegories WHERE etat =0");
  $reqcat->execute();
  $repcat = $reqcat->fetchAll();

  $reqfour = connect()->prepare("SELECT * FROM fournisseurs WHERE etat =0");
  $reqfour->execute();
  $repfour = $reqfour->fetchAll();

  $reqcoul = connect()->prepare("SELECT * FROM couleurs");
  $reqcoul->execute();
  $repcoul = $reqcoul->fetchAll();

  $reqtail = connect()->prepare("SELECT * FROM taille");
  $reqtail->execute();
  $reptail = $reqtail->fetchAll();

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
      $description = $_POST['description'];
      $couleur = $_POST['couleur'];
      $taille = $_POST['taille'];
      $id1 = $_POST['id'];
      $ancien_prix = $_POST['ancien_prix'];
      $error = "";
      //$solde = $_POST['solde'];
   
        
      if(empty($nom) && empty($fournisseur) && empty($cathegorie) && empty($qte)){ 
        $error = "Veuillez remplir tous les champs"; 
        echo $error;
      }
      else{
        $requete = connect()->prepare("UPDATE produits SET  image= :image, nom = :nom, prix = :prix, cathegorie = :cathegorie, fournisseur = :fournisseur, date = :date, qte = :qte, description = :description, couleur = :couleur, taille = :taille, /*solde = :solde, */  ancien_prix = :ancien_prix, WHERE id = :id1");
        $requete->execute(array(
        'image' => $image,
        'nom' => $nom,
        'prix' => $prix,
        'cathegorie' => $cathegorie,
        'fournisseur' => $fournisseur,
        'date' => $date,
        'qte' => $qte,
        'description' => $description,
        'couleur' => $couleur,
        'taille' => $taille,
        //'solde' => $solde,
        'ancien_prix' => $ancien_prix,
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
                  <label for="exampleInputimage">image</label>
                  <input type="file" class="form-control" id="exampleInputnom" value="<?php foreach($repprod as $prod){ echo $prod['image'];}?>" name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Libellé</label>
                  <input type="text" class="form-control" id="exampleInputnom" value="<?php foreach($repprod as $prod){ echo $prod['nom'];}?>" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputprix">Prix</label>
                  <input type="number" class="form-control" id="exampleInputprix" name="prix" value="<?php foreach($repprod as $prod){ echo $prod['prix'];}?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputancien">Ancien prix</label>
                  <input type="number" class="form-control" id="exampleInputancien" name="ancien_prix" value="<?php foreach($repprod as $prod){ echo $prod['ancien_prix'];}?>">
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
                  <input type="number" class="form-control" id="exampleInputqte" name="qte" value="<?php foreach($repprod as $prod){ echo $prod['qte'];}?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputdes">Description</label>
                  <textarea class="form-control" id="exampleInputdes" name="description" value="<?php foreach($repprod as $prod){ echo $prod['description'];}?>"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputcoul">Couleur</label>
                  <select class="form-control" id="exampleInputcoul" name="couleur">
                    <?php foreach($repcoul as $coul){ ?>
                    <option ><?php echo $coul['nomCouleur'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputtaille">Taille</label>
                  <select class="form-control" id="exampleInputtaille" name="taille">
                    <?php foreach($reptail as $tail){ ?>
                    <option ><?php echo $tail['nomTaille'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <!--<div class="form-group">
                  <label for="exampleInputsolde">Solde</label>
                  <div class="row" >
                  <label for="exampleInputsoldenon">Non</label>
                  <input type="radio" class="form-control" id="exampleInputsoldenon" name="solde" value="0">
                  <label for="exampleInputsoldeoui">oui</label>
                  <input type="radio" class="form-control" id="exampleInputsoldeoui" name="solde" value="1">
                  </div>
                </div>-->
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

