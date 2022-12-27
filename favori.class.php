<?php
 class favori{

    private $DB;
    public function __construct($DB)
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['favori'])){
            $_SESSION['favori'] = array();
        }
        $this->DB = $DB; 
        if(isset($_GET['delfavori'])){
            $this->del($_GET['delfavori']);
        }
        if(isset($_GET['addfavori'])){
            $this->add($_GET['addfavori']);
        }    
    }

    public function total()
    {
        $total = 0;
        $ids = array_keys($_SESSION['favori']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->query('SELECT id, prix FROM produits WHERE id IN ('.implode(',',$ids).')');
        }
        foreach ($products as $product) {
            $total += $product->prix * $_SESSION['favori'][$product->id];
        }
        return $total;
    }

    public function count()
    {
        return array_sum($_SESSION['favori']);
    }

    public function add($produit_id){
        if (isset($_SESSION['favori'][$produit_id])) {
            $_SESSION['favori'][$produit_id] = 1;
        }else{
            $_SESSION['favori'][$produit_id] = 1;
        }    
    }

    public function del($produit_id){
        unset($_SESSION['favori'][$produit_id]);
    }
 }