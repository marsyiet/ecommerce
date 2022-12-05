<?php 
    include("admin/includes/connexion.php");
    if(isset($_POST['query']) && !empty($_POST['query'])){

        $query = $_POST['query']; 

        $recherche = connect()->prepare("SELECT * FROM produits WHERE libelle LIKE ?");
        $recherche->execute(array('%'.$query.'%'));
        $resultat = $recherche->fetchAll();
    }
    else{
    echo "aucune recherche";
    }
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="text" placeholder="Que voulez vou?" name="query">
        <input type="submit"  name="s" value="Rechercher" class="site-btn">
    </form>
    <div class="row">
        <?php foreach($resultat as $re){ ?>
            <div class="set-bg" data-setbg="images/<?php echo $re['image']; ?>">
            </div>
        <?php } ?>
    </div>