<?php 
    include("../includes/connexion.php");

    if (isset($_POST['enregistrer']))
    {
      $login = $_POST['login'];
      $password = $_POST['password']; 
      $image = $_POST['image'];

      if(empty($login)){
        $error = "Veuillez entrer votre login"; 
        echo $error;
      }
      elseif(empty($password)){ 
        $error = "Veuillez entrer votre mot de passe"; 
        echo $error;
      }
      else{
        $requete = connect()->prepare("INSERT INTO administrateurs(photo,login,password) VALUES(?,?,?)");
        $requete->execute(array($image,$login,$password));
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
              <h4 class="card-title text-center">Enregistrer un utilisateur</h4>
              <form class="forms-sample" action="enregistrer.php" method="POST">
                <div class="form-group">
                  <label for="exampleInputimage">Image</label>
                  <input type="file" class="form-control" id="exampleInputimage" placeholder="Photo de profil" name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputlogin">login</label>
                  <input type="login" class="form-control" id="exampleInputlogin" placeholder="login" name="login">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password">
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

