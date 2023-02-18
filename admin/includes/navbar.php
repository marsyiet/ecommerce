<?php 
  session_start();
  if(isset($_SESSION["id"])){

  $reqadmin = connect()->prepare("SELECT * FROM administrateurs WHERE id = ?");
  $reqadmin->execute(array($_SESSION['id']));
  $admin = $reqadmin->fetchAll();
?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex justify-content-center">
    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
      <a class="navbar-brand brand-logo" href="index.html"><img src="../../images/FreshShop.png" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../template/images/logo-mini.svg" alt="logo"/></a>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="typcn typcn-th-menu"></span>
      </button>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
          <img src="../../images/<?php foreach($admin as $ad){echo $ad['photo']; }?>" alt="profile"/>
          <span class="nav-profile-name"><?php foreach($admin as $ad){echo $ad['login']; }?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="typcn typcn-cog-outline text-primary"></i>
            Parametres
          </a>
          <a class="dropdown-item" href="../deconnexion.php">
            <i class="typcn typcn-eject text-primary"></i>
            Déconnexion
          </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="typcn typcn-th-menu"></span>
    </button>
  </div>
</nav>
<?php }else{ header("Location: connexion.php");}  ?>