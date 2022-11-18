<?php
  $id = $_GET['id'];

  try{
    include("../includes/connexion.php");
    $requete1 = connect()->prepare("SELECT * FROM commandes WHERE id= ?"); 
    $requete1->execute(array($id));
    $reponse = $requete1->fetchAll();

   if (isset($_POST['modifier'])){

      $numCommande = $_POST['numCommande'];
      $ville = $_POST['ville'];
      $quartier = $_POST['quartier'];
      $client = $_POST['client'];
      $produit = $_POST['produit'];
      $paiement = $_POST['paiement'];
      $id1 = $_POST['id'];
      $error = "";
   
        
      if(empty($login)){ 
        $error = "Veuillez remplir tous les champs"; 
        echo "error";
      }
      else{
        $requete = connect()->prepare("UPDATE administrateurs SET  nom = :nom, ville = :ville, quartier = :quartier, mail = :mail WHERE id = :id1");
        $requete->execute(array(
        'login' => $login,
        'ville' => $ville,
        'quartier' => $quartier,
        'mail' => $mail,
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
              <h4 class="card-title text-center">Modifier une commande</h4>
              <form class="forms-sample" action="modifier.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputProduit">Produit</label>
                  <select class="form-control" id="exampleInputProduit" name="produit">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputClient">Client</label>
                  <select class="form-control" id="exampleInputClient" name="client">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPaiement">Paiement</label>
                  <select class="form-control" id="exampleInputClient" name="paiement">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Ville</label>
                  <select class="form-control" id="exampleInputVille" name="ville">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="form-control" id="exampleInputQuartier" name="quartier">
                    <option value="">--</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputProduit">Date</label>
                  <input type="date" class="form-control" id="exampleInputDate" name="date">
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

