<?php
/*require_once 'fonction.php';

if(isset($_POST['envoyer'])){

  $dest = 'etoundimarius237@gmail.com';
  $sujet = secur($_POST['subject']);
  $corp = secur($_POST['message']);
  $headers = "From: ". secur($_POST['email']);

  if (mail($dest, $sujet, $corp, $headers)) {
    echo "Email envoyé avec succès";
  } else {
    echo "Échec de l'envoi de l'email ";
  }
  
   
}*/

if (isset($_POST['envoyer'])) {
  if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $header = "MIME-Version: 1.0\n";
    $header .= "From:'marius'<etoundimarius237@gmail.com>";
    $header .= "Content-Type: text/html; charset='utf-8'";
    $header .= "Content-Transfer-Encoding: 8bit";

    mail($email, $subject, $message, $header);
  } else {
    die('entrez votre adresse mail');
  }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("css.php"); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include("menu.php"); ?>

  <main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">Contactez nous</h1>
          </div>
        </div>

        <div class="row gy-4">

          <div class="col-md-4">
            <div class="info-item">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>A108 Adam Street, NY 535022, USA</address>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-4">
            <div class="info-item info-item-borders">
              <i class="bi bi-phone"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+155895548855">+1 5589 55488 55</a></p>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-4">
            <div class="info-item">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@example.com</a></p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="form mt-5">
          <form action="contact.php" method="POST"  class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control"  placeholder="Your Name" >
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email"  placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject"  placeholder="Subject" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
            <div class="text-center"><button type="submit" name="envoyer" class="site-btn">Send Message</button></div>
          </form>
        </div><!-- End Contact Form -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include("footer.php"); ?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include("javascript.php") ; ?>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>