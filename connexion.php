<?php
   session_start();

    if(isset($_POST['connexion'])){

      include("admin/includes/connexion.php");

      $mail = $_POST['mail'];
      $mdp = $_POST['password'];

        if(empty($mail) && empty($mdp)){
          $error = "veuillez entrer toutes les informations";
          echo $error;
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
<?php require 'header_non_connexion.php'; ?>
<div class="col-lg-4 mx-auto" style="margin: 2%">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Connectez-vous</h4>
                <form action="connexion.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputmail">Mail</label>
                        <input type="mail" class="form-control" id="exampleInputmail" placeholder="mail" name="mail">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="connexion">Se connecter</button>
                </form><br />
                vous n'avez pas de compte ? <a href="inscription.php"> Créer un compte </a>
            </div>
        </div> 
    </div>
    
<?php require 'footer.php'; ?>

