<?php

    include("../includes/connexion.php");

    $reqsel = connect()->prepare("SELECT * FROM auteurs");
    $reqsel->execute(array());
    $auteurs = $reqsel->fetchAll();
   
    $id = $_GET['id'];
    try{ 
      $requete1 = connect()->prepare("SELECT * FROM administrateurs WHERE id= ?");
                
                
    $requete1->execute(array($id));
    $reponse = $requete1->fetch();

    echo "<br>";

   if (isset($_POST['modifier'])) 
    {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $id1 = $_POST['id'];
            $error = "";
   
        
                    if(empty($login) && empty($password)){ 
                $error = "Veuillez remplir tous les champs"; 
                echo "error";
            }
            else{
                    $requete = connect()->prepare("UPDATE administrateurs SET  login = :login, password = :password WHERE id = :id1");
                    $requete->execute(array(
                      'login' => $login,
                      'password' => $password,
                      'id1' => $id1));
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
              <h4 class="card-title text-center">modifier un admin</h4>
              <form class="forms-sample" action="modifier.php" method="POST">
                <div class="form-group">
                  <input type="hidden" name="id" class="form-control" id="exampleInputId" value="<?php echo $reponse['idAdmin']; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputlogin">login</label>
                  <input type="login" class="form-control" id="exampleInputlogin" placeholder="login" name="login" value="<?php echo $reponse['login']; ?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword4">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password" name="password" value="<?php echo $reponse['password']; ?>">
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

