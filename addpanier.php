<?php
require '_header.php';
$json = array('error' => true);
if(isset($_GET['addpanier'])){
    $produit = $DB->query('SELECT * FROM produits WHERE id= :id', array('id' => $_GET['addpanier']));
    if (empty($produit)) {
        $json['message'] = "ce produit n'existe pas";
    }
    $json['error'] = false;
    $json['id'] = $produit[0]->id;
    $json['image'] = $produit[0]->image;
    $json['nom'] = $produit[0]->nom;
    $json['quantity'] = 1;
    $json['prix'] = $produit[0]->prix;
    $json['message'] = "produit ajouté";
    $json['soustotalproduit'] = $produit[0]->prix * 1;
}
/*elseif(isset($_GET['delpanier'])){
    $produit = $DB->query('SELECT * FROM produits WHERE id= :id', array('id' => $_GET['delpanier']));
    if (empty($produit)) {
        $json['message'] = "ce produit n'existe pas";
    }
    $json['error'] = false;
    $json['id'] = $produit[0]->id;
    $json['image'] = $produit[0]->image;
    $json['nom'] = $produit[0]->nom;
    $json['prix'] = $produit[0]->prix;
    $json['message'] = "produit supression";
}*/
else{
    $json['message'] = "vous n'avez rien ajouté";
}
echo json_encode($json);

