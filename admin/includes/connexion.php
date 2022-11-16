<?php
    function connect(){
    $connect = new PDO('mysql:host=localhost;dbname=ecommerce','root', '');
    return $connect;
}
?>