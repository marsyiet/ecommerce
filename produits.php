<?php
   //session_start();
    include("menu.php");

     $count= connect()->prepare("SELECT count(id) AS cpt FROM produits");
     $count->setFetchMode(PDO::FETCH_ASSOC);
     $count->execute();
     $tcount=$count->fetchAll();

     @$page=$_GET["page"];
     if(empty($page)) $page=1;
     $nb_elements_page=4;
     $nb_pages=ceil($tcount[0]["cpt"]/$nb_elements_page);
     $debut=($page-1) * $nb_elements_page;
     /*$reqex = connect()->prepare("SELECT * FROM livres WHERE etat =0");
     $reqex->execute(array());
     $nbexemplaires = $reqex->fetchAll();
    
     $nb_elements_page = 12;
     $nb_pages = ceil($tcount[0]["cpt"]/$nb_elements_page);
     echo $nb_pages;*/

     $reqprod = connect()->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT $debut,$nb_elements_page");
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
    
     <main id="main">
     <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
               <div class="row">
               <?php foreach($repprod as $prod){ ?> <br> 
                 <div class="col-md-3">
                 <a><img src="images/<?php echo $prod['image']; ?>" ></a><br>
               </div>
               <?php } ?>
           </div> <!-- End .row -->
           <br>
          
           <div class="row" >
           <?php
            for ($i=1;$i<=$nb_pages;$i++){ 
              if($page!=$i){ ?>
              <a type="button" class="btn btn-block " style="background-color: rgba(0,0,0,0); color:green; border-color:green" href="?page=<?php echo $i; ?>"><?php echo $i ?></a>
              <?php }else{ ?>
              <a type="button" class="btn btn-block " style="background-color: green; color:white"><?php echo $i ?></a>
           <?php }} ?>
          </div>
         </div>
       </section> <!-- End Post Grid Section -->
    
     <!-- ======= Footer ======= -->
     <?php include("footer.php"); ?>
   
     <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
   
     <?php include("javascript.php"); ?>
   
   </body>
   
   </html>
   