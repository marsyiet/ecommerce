<?php
require '_header.php';
if(isset($_GET['add'])){
    $produit = $DB->query('SELECT id FROM produits WHERE id= :id', array('id' => $_GET['add']));
    if (empty($produit)) {
        die("ce produit n'existe pas");
    }
    $panier->add($produit[0]->id);
    header("Location:javascript:history.back()");
}
else{
    die("vous n'avez rien ajouté");
}