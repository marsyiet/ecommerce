<?php 
  

  if (isset($_POST['enregistrer']))
  {
    $produit = $_POST['produit'];
    $client = $_POST['client'];
    $paiement = $_POST['paiement'];
    $ville = $_POST['ville']; 
    $quartier = $_POST['quartier']; 
    $date = $_POST['date'];

    if(empty($produit)){
      $error = "Veuillez choisir un produit"; 
      echo $error;
    }
    elseif(empty($client)){ 
      $error = "Veuillez choisir un client"; 
      echo $error;
    }
    elseif(empty($paiement)){ 
      $error = "Veuillez choisir un mode de paiement"; 
      echo $error;
    }
    elseif(empty($date)){ 
      $error = "Veuillez choisir une date"; 
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
      include("../includes/connexion.php");
      $requete = connect()->prepare("INSERT INTO clients(produit,client,ville,quartier,date) VALUES(?,?,?,?,?)");
      $requete->execute(array($produit,$client,$ville,$quartier,$date));
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
              <h4 class="card-title text-center">Enregistrer une commande</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
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

