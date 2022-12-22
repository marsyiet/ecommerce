<?php
require '_header.php';
$json = array('error' => true);
if(isset($_GET['addfavori'])){
    $produit = $DB->query('SELECT id FROM produits WHERE id= :id', array('id' => $_GET['addfavori']));
    if (empty($produit)) {
        $json['message'] = "ce produit n'existe pas";
    }
    $favori->add($produit[0]->id);
    $json['error'] = false;
    $json['count'] = $favori->count();
    $json['message'] = "produit ajouté";
    header('Location:javascript:history.back()');
}
else{
    $json['message'] = "vous n'avez rien ajouté";
}
echo json_encode($json);
