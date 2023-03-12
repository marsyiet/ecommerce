<?php
session_start();
    if(isset($_SESSION['id'])){
        require 'header.php';
    }else{
        require 'header_non_connexion.php';
    }
?>
<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    if(isset($_POST['envoyer_mail'])){
    

    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 2525;
    $phpmailer->Username = 'f0042fd7504f19';
    $phpmailer->Password = '2348440717ee13';

    $phpmailer->setFrom($_POST['adresse_email']);

    $phpmailer->addAddress('etoundimarius237@gmail.com');

    $phpmailer->isHTML(true);

    $phpmailer->Subject = $_POST['subject'];
    $phpmailer->Body = $_POST['message'];

    $phpmailer->send();

     echo
     
     "
     <script>
     alert('sent');
     document.location.href = 'contact.php';
     </script>
     ";

    }

?>

<!-- Header Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="ogani-master/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contactez-nous</h2>
                    <div class="breadcrumb__option">
                        <a href="index.php">Acceuil</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Phone</h4>
                    <p>+237 692801450</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Addresse</h4>
                    <p>60-49 Road 11378 Yaounde</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Activite</h4>
                    <p>10:00 am to 23:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>etoundimarius237@gmail.com.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
    <iframe
        src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=pharmacie emana&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Yaounde</h4>
            <ul>
                <li>Phone: +237692801450</li>
                <li>Add: Borne Fontaine Emana</li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Laissez un message</h2>
                </div>
            </div>
        </div>
        <form action="contact.php" method="post">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Votre nom" name="subject" >
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" placeholder="Votre Email" name="adresse_email" >
                </div>
                <div class="col-lg-12 text-center">
                    <textarea placeholder="Votre message" name="message" ></textarea>
                    <button type="submit" class="site-btn" name="envoyer_mail">ENVOYER LE MESSAGE</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->

<!-- Footer Section Begin -->
<?php require 'footer.php'; ?>