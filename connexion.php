<?php
   session_start();

    if(isset($_POST['connexion'])){

      include("admin/includes/connexion.php");

      $mail = $_POST['mail'];
      $mdp = $_POST['password'];

        if(empty($mail) && empty($mdp)){
          $error = "veuillez entrer toutes les informations";
        }
        else{
          
          $requete = connect()->prepare("SELECT * FROM clients WHERE mail = ? and password = ?");
          $requete->execute(array($mail, $mdp));
          $req = $requete->fetchAll();
        
          if(count($req) == 1){
            $_SESSION["id"] = $req[0]['id'];
            
            $_SESSION["mail"] = $req[0]['mail'];
            header("Location: index.php");
          }
          else{
           header("Location:connexion.php");
          }
          
        }

    }
   
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

<!-- Css Styles -->
<link rel="stylesheet" href="ogani-master/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/nice-select.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/jquery-ui.min.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="ogani-master/css/style.css" type="text/css">
</head>
<body>
  <div class="main-panel container-fluid page-body-wrapper full-page-wrapper">        
    <div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
    <div class="col-lg-4 mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Connectez-vous</h4>
        <form class="forms-sample" action="connexion.php" method="POST">
          <div class="form-group">
            <label for="exampleInputmail">Mail</label>
            <input type="mail" class="form-control" id="exampleInputmail" placeholder="mail" name="mail">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-primary mr-2" name="connexion">Se connecter</button>
        </form>
      </div>
    </div>
    </div>
    </div>
    </div>
    <?php include("admin/includes/footer.html"); ?>
  </div>

  <script src="ogani-master/js/jquery-3.3.1.min.js"></script>
    <script src="ogani-master/js/bootstrap.min.js"></script>
    <script src="ogani-master/js/jquery.nice-select.min.js"></script>
    <script src="ogani-master/js/jquery-ui.min.js"></script>
    <script src="ogani-master/js/jquery.slicknav.js"></script>
    <script src="ogani-master/js/mixitup.min.js"></script>
    <script src="ogani-master/js/owl.carousel.min.js"></script>
    <script src="ogani-master/js/main.js"></script>
</body>

</html>
