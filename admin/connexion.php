<?php
   session_start();

    if(isset($_POST['connexion'])){

      include("includes/connexion.php");

      $login = $_POST['login'];
      $mdp = $_POST['password'];

        if(empty($login) && empty($mdp)){
          $error = "veuillez entrer toutes les informations";
        }
        else{
          
          $requete = connect()->prepare("SELECT * FROM administrateurs WHERE login = ? and password = ?");
          $requete->execute(array($login, $mdp));
          $req = $requete->fetchAll();
        
          if(count($req) == 1){
            $_SESSION["id"] = $req[0]['idAdmin'];
            
            $_SESSION["login"] = $req[0]['login'];
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
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PolluxUI Admin</title>
  <link rel="stylesheet" href="../template/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../template/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../template/images/favicon.png" />
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
            <label for="exampleInputLogin">Login</label>
            <input type="login" class="form-control" id="exampleInputLogin" placeholder="Login" name="login">
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
    <?php include("includes/footer.html"); ?>
  </div>

  <script src="../template/vendors/js/vendor.bundle.base.js"></script>
  <script src="../template/vendors/chart.js/Chart.min.js"></script>
  <script src="../template/js/off-canvas.js"></script>
  <script src="../template/js/hoverable-collapse.js"></script>
  <script src="../template/js/template.js"></script>
  <script src="../template/js/settings.js"></script>
  <script src="../template/js/todolist.js"></script>
  <script src="../template/js/dashboard.js"></script>
</body>

</html>

