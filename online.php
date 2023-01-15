<?php
    $connect = new PDO('mysql:host=localhost;dbname=ecommerce','root', '');

$temps_session = 20;
$temps_actuel = date("U");
$ipuser = $_SERVER['REMOTE_ADDR'];



$req_ip_exist = $connect->prepare("SELECT * FROM online WHERE ipuser = ?");
$req_ip_exist->execute(array($ipuser));
$ip_existe = $req_ip_exist->rowCount();

if ($ip_existe == 0) {
    $add_ip = $connect->prepare('INSERT INTO online (ipuser, time) VALUES (?,?)');
    $add_ip->execute(array($ipuser, $temps_actuel));
} else {
    $update_ip = $connect->prepare('UPDATE online SET time = ? WHERE ipuser = ?');
    $update_ip->execute(array($temps_actuel, $ipuser));
}

$session_delete_time = $temps_actuel - $temps_session;

$del_ip = $connect->prepare('DELETE FROM online WHERE time < ?');
$del_ip->execute(array($session_delete_time));

$show_user_nbr = $connect->query('SELECT * FROM online');
$user_nbr = $show_user_nbr->rowcount();


?>


