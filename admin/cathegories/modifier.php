<?php
  $id = $_GET['id'];
  try{
    include("../includes/connexion.php");
    $requete1 = connect()->prepare("SELECT * FROM cathegories WHERE id= ?"); 
    $requete1->execute(array($id));
    $reponse = $requete1->fetchAll();

   if (isset($_POST['modifier'])){

      $libelle = $_POST['libelle'];
      $id1 = $_POST['id'];
      $error = "";
   
        
      if(empty($libelle)){ 
        $error = "Veuillez remplir tous les champs"; 
        echo "error";
      }
      else{
        $requete = connect()->prepare("UPDATE cathegories SET  libelle = :libelle WHERE id = :id1");
        $requete->execute(array(
        'libelle' => $libelle,
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
              <h4 class="card-title text-center">modifier une cathégorie</h4>
              <form class="forms-sample" action="modifier.php" method="POST">
                <div class="form-group">
                  <input type="hidden"  class="form-control" id="exampleInputId" value="<?php foreach($reponse as $rep){echo $rep['id'];} ?>" name="id">
                </div>
                <div class="form-group">
                  <label for="exampleInputlibelle">Libellé</label>
                  <input type="login" class="form-control" id="exampleInputlibelle"  value="<?php foreach($reponse as $rep){echo $rep['libelle'];} ?>" name="libelle">
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

