<?php
require 'db.class.php';
require 'panier.class.php';
require 'favori.class.php';
$DB = new DB();
$panier = new panier($DB);
$favori = new favori($DB);
?>