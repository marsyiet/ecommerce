<?php 
  
  include("admin/includes/connexion.php");

  $requete1 = connect()->prepare("SELECT * FROM villes WHERE etat = 0");
  $requete1->execute();
  $reponse1 = $requete1->fetchAll();

  $requete2 = connect()->prepare("SELECT * FROM quartiers WHERE etat = 0");
  $requete2->execute();
  $reponse2 = $requete2->fetchAll();

  if (isset($_POST['enregistrer']))
  {
    $image = $_FILES['image']['name'];
    $nom = $_POST['nom'];
    $mail = $_POST['mail'];
    $ville = $_POST['ville']; 
    $quartier = $_POST['quartier']; 
    $password = $_POST['password'];


    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
    $extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

    if(empty($nom) && empty($ville) && empty($quartier) && empty($password) && empty($image)){
      $error = "Veuillez remplir tous les champs"; 
      echo $error;
    }
    else{ 
        if (in_array($extension_upload, $extensions_autorisees))
        {            
          echo "extension correcte";
          $requete = connect()->prepare("INSERT INTO clients(image,nom,mail,ville,quartier,password) VALUES(?,?,?,?,?,?)");
          $requete->execute(array($image,$nom,$mail,$ville,$quartier,$password));
        }else{
          echo "format de l'image incorrect; veuillez entrer une image aux formats 'jpg', 'jpeg', 'gif', 'png'";
        }            
        if($requete){
          header("Location:index.php?");
        }
              
    }
          
  }
?>
<?php include 'header_non_connexion.php'; ?>

    <div class="col-lg-4 mx-auto" style="margin: 2%">
    <div class="card">
      <div class="card-body">
              <h4 class="card-title text-center">S'INSCRIRE</h4>
              <form class="forms-sample" action="inscription.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleimage">Avatar</label>
                  <input type="file" class="form-control" id="exampleimage"  name="image">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Votre nom</label>
                  <input type="text" class="form-control" id="exampleInputnom" placeholder="Nom" name="nom">
                </div>
                <div class="form-group">
                  <label for="exampleInputnom">Adresse mail</label>
                  <input type="email" class="form-control" id="exampleInputMail" placeholder="E-mail" name="mail">
                </div>
                <div class="form-group">
                  <label for="exampleInputVille">Ville</label>
                  <select class="js-example-basic-single w-100" name="ville" style="color:black">
                    <?php foreach($reponse1 as $rep1){ ?>
                    <option value="<?php echo $rep1['id']; ?>" ><?php echo $rep1['nomVille']; ?></option><?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputQuartier">Quartier</label>
                  <select class="js-example-basic-single w-100" name="quartier" style="color:black">
                    <?php foreach($reponse2 as $rep2){ ?>
                    <option value="<?php echo $rep2['id']; ?>" ><?php echo $rep2['nomQuartier']; ?></option><?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" class="form-control " id="exampleInputpassword1" placeholder="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary mr-2 " style="background-color:green" name="enregistrer">M'enregistrer</button>
                <a type="button" href="index.php" class="btn btn-light">Cancel</a>
              </form>
            </div>
          </div>
        </div>
    <?php include 'footer.php'; ?>
</div>


</body>

</html>

