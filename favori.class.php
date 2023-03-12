<?php
 class favoris{

    private $DB;
    public function __construct($DB)
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['favoris'])){
            $_SESSION['favoris'] = array();
        }
        $this->DB = $DB;
        if(isset($_GET['delfavoris'])){
            $this->del($_GET['delfavoris']);
        }
    }
    public function total()
    {
        $total = 0;
        $ids = array_keys($_SESSION['favoris']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->query('SELECT id, prix FROM produits WHERE id IN ('.implode(',',$ids).')');
        }
        foreach ($products as $product) {
            $total += $product->prix * $_SESSION['favoris'][$product->id];
        }
        return $total;
    }

    public function qty($produit_id){
      return $_SESSION['favoris'][$produit_id];
    }

    public function count()
    {
        return array_sum($_SESSION['favoris']);
    }

    public function add($produit_id){
        if (isset($_SESSION['favoris'][$produit_id])) {
            $_SESSION['favoris'][$produit_id]++;
        }else{
            $_SESSION['favoris'][$produit_id] = 1;
        }    
    }

    public function inc($produit_id){
      return $_SESSION['favoris'][$produit_id]++;
    }

    public function dec($produit_id){
      return $_SESSION['favoris'][$produit_id]--;
    }

    public function del($produit_id){
        unset($_SESSION['favoris'][$produit_id]);
    }

  public function soustotalproduit($produit_id)
  {
    $soustotal = 0;
        $ids = array_keys($_SESSION['favoris']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->query('SELECT id, prix FROM produits WHERE id= ?', array($produit_id));
        }
        foreach ($products as $product) {
            $soustotal += $product->prix * $_SESSION['favoris'][$produit_id];
        }
        return $soustotal;
  }

 }