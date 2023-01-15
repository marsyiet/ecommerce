<?php
require '_header.php';
if(isset($_GET['addpanier'])){
    $produit = $DB->query('SELECT * FROM produits WHERE id= :id', array('id' => $_GET['addpanier']));
    $json = json_encode($produit);
}
else{
}
echo json_encode($json);