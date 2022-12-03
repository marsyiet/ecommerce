<?php
  $dest = $_POST['email_destinataire'];
  $sujet = $_POST['subject'];
  $corp = $_POST['message'];
  $headers = "From: ". $_POST['email'];
  
  if(isset($_POST['envoyer'])){
    if (mail($dest, $sujet, $corp, $headers)) {
      echo "Email envoyé avec succès à $dest ...";
    } else {
      echo "Échec de l'envoi de l'email...";
    } 
  }

?>