<?php 
include("../includes/connexion.php");
$req = connect()->prepare("SELECT * FROM administrateurs");
$req->execute(array());
$go = $req->fetchAll();

foreach ($go as $g){
    echo $g['idAdmin'];
}
?>