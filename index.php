<?php
session_start();
if(isset($_SESSION['id'])){

?>
<?php require 'header.php'; ?>

<?php require 'index_contenu.php'; ?>

<!-- Footer Section Begin -->
<?php require 'footer.php'; ?>

<?php }else{ ?>
<?php require 'header_non_connexion.php'; ?>

<?php require 'index_contenu.php'; ?>

<!-- Footer Section Begin -->
<?php require 'footer.php'; ?>
<?php }?>