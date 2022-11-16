<?php

    include("../includes/connexion.php");
    $id = $_GET['id'];
    
    $requete1 = connect()->prepare("DELETE FROM fournisseurs WHERE id= ?"); 
    $requete1->execute(array($id));
   
    if($requete1){
      echo "suppression réussie";
      header("Location: liste.php");
    }
?>