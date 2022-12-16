<?php
 class panier{
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
    }

    public function add($produit_id){
        $_SESSION['panier'][$produit_id] = 1;
    }

    public function del($produit_id){
        unset($_SESSION['panier'][$produit_id]);
    }
 }