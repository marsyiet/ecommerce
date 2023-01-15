<?php
 class panier{

    private $DB;
    public function __construct($DB)
    {
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
        $this->DB = $DB;
        if(isset($_GET['delpanier'])){
            $this->del($_GET['delpanier']);
        }
        if(isset($_POST['panier'])){
            $this->recalc();
        }
    }

    public function recalc()
    {
        foreach($_SESSION['panier'] as $produit_id => $quantite){
            if (isset(['panier']['quantite'][$produit_id])) {
                $_SESSION['panier'][$produit_id] = $_POST['panier']['quantite'][$produit_id];
            }
        }
        $_SESSION['panier'] = $_POST['panier']['quantite'];
    }
    public function total()
    {
        $total = 0;
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->query('SELECT id, prix FROM produits WHERE id IN ('.implode(',',$ids).')');
        }
        foreach ($products as $product) {
            $total += $product->prix * $_SESSION['panier'][$product->id];
        }
        return $total;
    }

    public function qty($produit_id){
      return $_SESSION['panier'][$produit_id];
    }

    public function count()
    {
        return array_sum($_SESSION['panier']);
    }

    public function add($produit_id){
        if (isset($_SESSION['panier'][$produit_id])) {
            $_SESSION['panier'][$produit_id]++;
        }else{
            $_SESSION['panier'][$produit_id] = 1;
        }    
    }

    public function inc($produit_id){
      return $_SESSION['panier'][$produit_id]++;
    }

    public function dec($produit_id){
      return $_SESSION['panier'][$produit_id]--;
    }

    public function del($produit_id){
        unset($_SESSION['panier'][$produit_id]);
    }

  public function soustotalproduit($produit_id)
  {
    $soustotal = 0;
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $products = array();
        } else {
            $products = $this->DB->query('SELECT id, prix FROM produits WHERE id= ?', array($produit_id));
        }
        foreach ($products as $product) {
            $soustotal += $product->prix * $_SESSION['panier'][$produit_id];
        }
        return $soustotal;
  }

 }