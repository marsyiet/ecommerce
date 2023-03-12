<?php
   session_start();
include("admin/includes/connexion.php");

     $count= connect()->prepare("SELECT count(id) AS cpt FROM produits");
     $count->setFetchMode(PDO::FETCH_ASSOC);
     $count->execute();
     $tcount=$count->fetchAll();

     @$page=$_GET["page"];
     if(empty($page)) $page=1;
     $nb_elements_page=4;
     $nb_pages=ceil($tcount[0]["cpt"]/$nb_elements_page);
     $debut=($page-1) * $nb_elements_page;

     $reqprod = connect()->prepare("SELECT * FROM produits WHERE favori=1 ORDER BY id DESC LIMIT $debut,$nb_elements_page");
     $reqprod->setFetchMode(PDO::FETCH_ASSOC);
     $reqprod->execute();
     $repprod = $reqprod->fetchAll();
     
     ?>
    
   <!DOCTYPE html>
   <html lang="en">
   
   <head>
     <?php include("css.php"); ?>
   </head>
   
   <body>
   <?php include("menu.php"); ?>
     <main id="main">
     <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="hero__search__form" style="width:100%;">
              <form action="panier.php" method="POST">
                  <input type="text" placeholder="QUE VOULEZ VOUS" name="query">
                  <button type="submit" class="site-btn" name="rechercher">Rechercher</button>
              </form>
            </div>
          </div>
               
           <?php
            

            
           
           if (isset($_POST['rechercher']) && isset($_POST['query']) && !empty($_POST['query'])) {

            $query = $_POST['query'];

            $recherche = connect()->prepare("SELECT * FROM produits WHERE libelle LIKE ? AND favori = 1");
            $recherche->execute(array('%' . $query . '%'));
            $resultat = $recherche->fetchAll();

             


             if ($resultat) {
               foreach ($resultat as $re) { ?>
                
                <div class="col">
               <?php foreach ($resultat as $re) { ?> <br> 
                
                <div class="row" style="border-bottom: solid 1px; max-height: 300px; overflow: auto;">
                  <div class="col-lg">
                    <a><img src="images/<?php echo $re['image']; ?>" width="270" height="270"></a>
                  </div>
                  <div class="col-lg">
                  <div class="" style="position: absolute;">
                    <?php echo $re['description']; ?>
                    </div>
                    <div class="" style="position: absolute; bottom: 10px; right: 1px;">
                    <button class="site-btn" name='achat'>Retirer</button>
                    </div>
                  </div>
                  
                </div>
                
                <?php }
               }
             }
           } else {
               $recherche = connect()->prepare("SELECT * FROM produits WHERE  favori = 1");
               $recherche->execute(array());
               $resultat = $recherche->fetchAll();

               foreach ($resultat as $re) { ?> 
                  <div class="col">
                <div class="row" style="border-bottom: solid 1px; max-height: 300px; overflow: auto;">
                  <div class="col-lg">
                    <a><img src="images/<?php echo $re['image']; ?>" width="270" height="270"></a>
                  </div>
                  <div class="col-lg">
                  <div class="" style="position: absolute; max-height: 2;">
                    <?php echo $re['description']; ?>
                    </div>
                    <div class="" style="position: absolute; bottom: 10px; right: 1px;">
                    <button class="site-btn" name='achat'>Retirer</button>
                    </div>
                  </div>
                  
                </div>
                <?php }
             }
           ?>
           <br>
          
           <!--<div class="row" >
           <?php
            for ($i=1;$i<=$nb_pages;$i++){ 
              if($page!=$i){ ?>
              <a type="button" class="btn btn-block " style="background-color: rgba(0,0,0,0); color:green; border-color:green" href="?page=<?php echo $i; ?>"><?php echo $i ?></a>
              <?php }else{ ?>
              <a type="button" class="btn btn-block " style="background-color: green; color:white"><?php echo $i ?></a>
           <?php }} ?>-->
          </div>
       </section> <!-- End Post Grid Section -->
    
     <!-- ======= Footer ======= -->
     <?php include("footer.php"); ?>
   
     <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
   
     <?php include("javascript.php"); ?>
   
   </body>
   
   </html>
   