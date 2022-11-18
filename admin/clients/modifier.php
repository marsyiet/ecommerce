<?php
  $id = $_GET['id'];

  try{
    include("../includes/connexion.php");
    $requete1 = connect()->prepare("SELECT * FROM clients WHERE id= ?"); 
    $requete1->execute(array($id));
    $reponse = $requete1->fetchAll();

    $requete2 = connect()->prepare("SELECT * FROM clients WHERE id= ?"); 
    $requete2->execute(array($id));
    $reponse2 = $requete2->fetchAll();

   if (isset($_POST['modifier'])){

      $nom = $_POST['nom'];
      $mail = $_POST['mail'];
      $ville = $_POST['ville'];
      $quartier = $_POST['quartier'];
      $id1 = $_POST['id'];
      $error = "";
   
        
      if(empty($login)){ 
        $error = "Veuillez remplir tous les champs"; 
        echo "error";
      }
      else{
        $requete = connect()->prepare("UPDATE administrateurs SET  nom = :nom, mail = :mail, ville = :ville, quartier = :quartier  WHERE id = :id1");
        $requete->execute(array(
        'nom' => $nom,
        'mail' => $mail,
        'ville' => $ville,
        'quartier' => $quartier,
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
              <h4 class="card-title text-center">Enregistrer un produit</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputnom">Nom du produit</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="nom" value="<?php foreach($reponse as $rep){echo $rep['nom'];} ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Adresse mail</label>
                  <input type="email" class="form-control" id="exampleInputMail" placeholder="E-mail" name="mail" value="<?php foreach($reponse as $rep){echo $rep['mail'];} ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Ville</label>
                  <select class="form-control" id="exampleInputVille" name="ville" >
                    <option value="<?php foreach($reponse1 as $rep1){echo $rep1['id'];} ?>"><?php foreach($reponse1 as $rep1){echo $rep2['nom'];} ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="form-control" id="exampleInputQuartier" name="quartier">
                    <option value="<?php foreach($reponse2 as $rep2){echo $rep2['id'];} ?>"><?php foreach($reponse2 as $rep2){echo $rep2['nom'];} ?>
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