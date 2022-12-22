<?php
require '_header.php';
$json = array('error' => true);
if(isset($_GET['add'])){
    $produit = $DB->query('SELECT id FROM produits WHERE id= :id', array('id' => $_GET['add']));
    if (empty($produit)) {
        $json['message'] = "ce produit n'existe pas";
    }
    $panier->add($produit[0]->id);
    $json['error'] = false;
    $json['total'] = $panier->total();
    $json['count'] = $panier->count();
    $json['message'] = "produit ajouté";
}
else{
    $json['message'] = "vous n'avez rien ajouté";
}
echo json_encode($json);


if(isset($_GET['connect'])){
    $json['message'] = "ce produit n'existe pas";
}
echo json_encode($json);