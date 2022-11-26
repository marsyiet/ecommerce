<?php
session_start();
if(isset($_SESSION["id"])){

  include("includes/connexion.php");
    $reqcli = connect()->prepare("SELECT * FROM clients ");
    $reqcli->execute(array());
    $client = $reqcli->fetchAll();
    $nbclient=count($client);
    $reqprod = connect()->prepare("SELECT * FROM produits ");
    $reqprod->execute(array());
    $produit = $reqprod->fetchAll();
    $nbproduit = count($produit);
    $reqcom = connect()->prepare("SELECT * FROM commandes ");
    $reqcom->execute(array());
    $commande = $reqcom->fetchAll();
    $nbcommande = count($commande);
    $reqadmin = connect()->prepare("SELECT login FROM administrateurs WHERE id = ?");
    $reqadmin->execute(array($_SESSION['id']));
    $admin = $reqadmin->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PolluxUI Admin</title>
  <link rel="stylesheet" href="../template/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../template/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../template/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../template/images/favicon.png" />
</head>
<body>

  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <a class="navbar-brand brand-logo" href="index.html"><img src="../banqueImages/sillhouette.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../template/images/logo-mini.svg" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
          </button>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../banqueImages/man.png" alt="profile"/>
              <span class="nav-profile-name"><?php foreach($admin as $ad){echo $ad['login']; }?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog-outline text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item" href="deconnexion.php">
                <i class="typcn typcn-eject text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->

    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->


      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Dashboard</span>
              <div class="badge badge-danger">new</div>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Administrateurs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="administrateurs/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="administrateurs/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cathegorie" aria-expanded="false" aria-controls="cathegorie">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Cathégorie</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="cathegorie">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="cathegories/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="cathegories/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#client" aria-expanded="false" aria-controls="client">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Client</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="client">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="clients/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="clients/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#commande" aria-expanded="false" aria-controls="localisation">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Commandes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="commande">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="commandes/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="commandes/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#produit" aria-expanded="false" aria-controls="produit">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Produit</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="produit">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="produits/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="produits/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#livreur" aria-expanded="false" aria-controls="livreur">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Livreur</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="livreur">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="livreurs/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="livreurs/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#fournisseur" aria-expanded="false" aria-controls="fournisseur">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Fournisseurs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="fournisseur">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="fournisseurs/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="fournisseurs/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ville" aria-expanded="false" aria-controls="ville">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Villes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ville">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="villes/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="villes/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#quartier" aria-expanded="false" aria-controls="quartier">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Quartier</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="quartier">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="quartiers/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="quartiers/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#paiement" aria-expanded="false" aria-controls="paiement">
              <i class="typcn typcn-user-add-outline menu-icon"></i>
              <span class="menu-title">Paiement</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="paiement">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="paiement/enregistrer.php">Enregistrer</a></li>
                <li class="nav-item"> <a class="nav-link" href="paiement/liste.php">Liste</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="deconnexion.php">
              <i class="typcn typcn-device-desktop menu-icon"></i>
              <span class="menu-title">Déconnexion</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total commandes</p>
                      <h1 class="mb-0"><?php echo $nbcommande; ?></h1>
                    </div>
                    <i class="typcn typcn-briefcase icon-xl text-secondary"></i>
                  </div>
                  <canvas id="expense-chart" height="80"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total produits</p>
                      <h1 class="mb-0"><?php echo $nbproduit; ?></h1>
                    </div>
                    <i class="typcn typcn-chart-pie icon-xl text-secondary"></i>
                  </div>
                  <canvas id="budget-chart" height="80"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center justify-content-between justify-content-md-center justify-content-xl-between flex-wrap mb-4">
                    <div>
                      <p class="mb-2 text-md-center text-lg-left">Total clients</p>
                      <h1 class="mb-0"><?php echo $nbclient; ?></h1>
                    </div>
                    <i class="typcn typcn-clipboard icon-xl text-secondary"></i>
                  </div>
                  <canvas id="balance-chart" height="80"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Free <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrap dashboard</a> templates from Bootstrapdash.com</span>
                    </div>
                </div>    
            </div>        
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="../template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../template/vendors/chart.js/Chart.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../template/js/off-canvas.js"></script>
  <script src="../template/js/hoverable-collapse.js"></script>
  <script src="../template/js/template.js"></script>
  <script src="../template/js/settings.js"></script>
  <script src="../template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../template/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

<?php }else{ header("Location: connexion.php");}  ?>