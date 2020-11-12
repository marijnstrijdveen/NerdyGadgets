<?php
include "header.php";
?>


<section class="signin-container">
     <div class="container py-5">
         <h1>Contact</h1>
         <?php if (isset($_POST["Verstuur"])) {
             $first_name = $_POST["first_name"];
             $last_name = $_POST['last_name'];
             $email_address = $_POST['email_address'];
             $subject = $_POST['subject'];
             $message = input_get('message');

             $mail = new Mail();

             $mail->addAddress("noreply@test.nl");
             $mail->isHTML(true);
             $mail->Subject = "Nieuw bericht van contactformulier";
             $mail->Body = "Voornaam: $first_name <br> Achternaam: $last_name<br> Email adres: $email_address<br> Onderwerp: $subject<br> Bericht: $message<br>";

             $mail->send();

             print("<div class=\"alert alert-info\" role=\"alert\">Het contactformulier is verzonden. U ontvangt uiterlijk binnen 48 uur bericht.</div>");
         }
         ?>
         <div class="row">
             <div class="col-md-6">
                 <form action method="post">
                     <div class="form-group">
                         <?php if (isset($_POST["Verstuur"])) {
                             print("<div class=\"alert alert-info\" role=\"alert\">Het contactformulier is verzonden. U ontvangt uiterlijk binnen 48 uur bericht.</div>");
                         }
                         ?>
                         <label for="first_namename">Naam</label>
                         <input class="form-control" type="text" name="first_name" id="first_name" placeholder="Vul hier uw voornaam in" required>
                     </div>
                     <div class="form-group">
                         <label for="last_name">Achternaam</label>
                         <input class="form-control" type="text" name="last_name" id="last_name" placeholder="Vul hier uw achternaam in " required>
                     </div>
                     <div class="form-group">
                         <label for="email">Email</label>
                         <input class="form-control" type="email" name="email_address" id="email" placeholder="Vul hier uw email in" required>
                     </div>
                     <div class="form-group">
                         <label for="subject">Onderwerp</label>
                         <input class="form-control" type="text" name="subject" placeholder="Vul hier het onderwerp in" required>
                     </div>
                     <div class="form-group">
                         <label for="msg">Bericht</label> <br>
                         <textarea class="form-control" type="message" name="message" id="message" name="user_message" rows="3" placeholder="Vul hier uw bericht in" required> </textarea>
                     </div>
                     <button class="btn btn-primary" type="submit" name="Verstuur">
                         Verstuur
                     </button>
                 </form>
             </div>
             <div class="col-md-6">
                 <div class="mapouter">
                     <div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=windesheim%20t&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/purevpn-coupon/"></a></div>
                     <style>
                         .mapouter {
                             position: relative;
                             text-align: right;
                             height: 500px;
                             width: 600px;
                         }

                         .gmap_canvas {
                             overflow: hidden;
                             background: none !important;
                             height: 500px;
                             width: 600px;
                         }
                     </style>
                 </div>
             </div>
         </div>
     </div>
</section>
<?php
include "footer.php";
?>
