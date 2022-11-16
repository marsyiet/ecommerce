<?php
    $servername = "localhost";
    $username = "root";
    $password ="root";

    include("../includes/connexion.php");
    connect();
    $id = $_GET['id'];
    
    $requete1 = connect()->prepare("DELETE FROM adherant WHERE id= ?"); 
    $requete1->execute(array($id));
   
    if($requete1){
      echo "suppression réussie";
      header("Location: liste.php");
    }
?>