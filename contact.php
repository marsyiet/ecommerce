<?php require 'header.php'; ?>
  <main id="main">
    <section id="contact" class="contact mb-5">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">Contactez nous</h1>
          </div>
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
  <?php require 'footer.php'; ?>
