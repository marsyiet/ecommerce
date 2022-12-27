<?php 
require '_header.php';
$connect = new PDO('mysql:host=localhost;dbname=ecommerce','root', ''); 

if(isset($_GET['t'],$_GET['id']) AND !empty($_GET['t']) AND !empty($_GET['id'])){
    $getid = $_GET['id'];
    $gett = (int) $_GET['t'];
    $sessionid = $_SESSION['id'];

    $check = $connect->prepare("SELECT id FROM produits WHERE id = ?");
    $check->execute(array($getid));

    if($check->rowCount() == 1){
        if($gett == 1){
            $check_like = $connect->prepare("SELECT id FROM likes WHERE id_produit = ? AND id_client = ?");
            $check_like->execute(array($getid, $sessionid));

            $del = $connect->prepare("DELETE FROM dislikes WHERE id_produit = ? AND id_client = ?");
            $del->execute(array($getid, $sessionid));
            
            if($check_like->rowCount() == 1 ){
                $del = $connect->prepare("DELETE FROM likes WHERE id_produit = ? AND id_client = ?");
                $del->execute(array($getid, $sessionid));

            }else{
                $ins = $connect->prepare("INSERT INTO likes (id_produit, id_client) VALUES (?, ?)");
                $ins->execute(array($getid, $sessionid));
            }
        }
        elseif($gett == 2){
            $check_like = $connect->prepare("SELECT id FROM dislikes WHERE id_produit = ? AND id_client = ?");
            $check_like->execute(array($getid, $sessionid));

            $del = $connect->prepare("DELETE FROM likes WHERE id_produit = ? AND id_client = ?");
            $del->execute(array($getid, $sessionid));
            
            if($check_like->rowCount() == 1 ){
                $del = $connect->prepare("DELETE FROM dislikes WHERE id_produit = ? AND id_client = ?");
                $del->execute(array($getid, $sessionid));

            }else{
                $ins = $connect->prepare("INSERT INTO dislikes (id_produit, id_client) VALUES (?, ?)");
                $ins->execute(array($getid, $sessionid));
            }
        }
        header('Location:http://localhost/commerce/index.php?id=' . $getid);
    }else{
        exit('erreur');
    }
}else{
    exit('erreur');
}