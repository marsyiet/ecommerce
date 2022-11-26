<?php
  include("../includes/connexion.php");  
  $id = $_GET['id'];

    $reqvil = connect()->prepare("SELECT * FROM villes WHERE etat = 0");
    $reqvil->execute();
    $repvil = $reqvil->fetchAll();

    $reqquar = connect()->prepare("SELECT * FROM quartiers WHERE etat = 0");
    $reqquar->execute();
    $repquar = $reqquar->fetchAll();

  try{
    
    $requete1 = connect()->prepare("SELECT * FROM fournisseurs WHERE id= ?"); 
    $requete1->execute(array($id));
    $reponse = $requete1->fetchAll();

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
        $requete = connect()->prepare("UPDATE administrateurs SET  nom = :nom, mail = :mail, ville = :ville, quartier = :quartier WHERE id = :id1");
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
  <?php include("../includes/navbar.php"); ?>
<div class="container-fluid page-body-wrapper">
  <?php include("../includes/sidebar.html"); ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-center">modifier un fournisseur</h4>
              <form class="forms-sample" action="modifier.php" method="POST">
                <div class="form-group">
                  <input type="hidden"  class="form-control" id="exampleInputId" value="<?php foreach($reponse as $rep){echo $rep['id'];} ?>" name="id">
                </div>
                <div class="form-group">
                  <label for="exampleInputlogin">Nom</label>
                  <input type="text" class="form-control" id="exampleInputlogin"  value="<?php foreach($reponse as $rep){echo $rep['nom'];} ?>" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputlogin">N</label>
                  <input type="mail" class="form-control" id="exampleInputlogin"  value="<?php foreach($reponse as $rep){echo $rep['mail'];} ?>" name="mail">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Ville</label>
                  <input type="text" class="form-control" id="exampleInputville"  value="<?php foreach($repvil as $vil){echo $vil['nom'];} ?>" name="ville">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Quartier</label>
                  <input type="text" class="form-control" id="exampleInputquartier"  value="<?php foreach($repquar as $quar){echo $quar['nom'];} ?>" name="quartier">
                </div>
                <button type="submit" class="btn btn-primary mr-2" name="modifier" >Modifier</button>
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

