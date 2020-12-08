<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$query= "SELECT *
FROM contact";

$Statement = mysqli_query($Connection, $query);
$R = mysqli_fetch_all($Statement, MYSQLI_ASSOC);

$email = "";
$tel = "";
$adres = "";

foreach ($R as $info){
    $email = $info['email'];
    $tel = $info['phone'];
    $adres = $info['address'];
}

$headTitel = 'NerdyGadgets - Contact Page';
include __DIR__ . '/header.php';
?>

<div style="text-align: center;">
<b>Welcome to Nerdygadgets' contact page!</b> <br> <br>
<b>Over ons:</b> <br>
We are NerdyGadgets. We are very proud of our products and we believe in quality. In every home, products from NerdyGadgets will fit in perfectly.<br>
Despite the size of our company, many customers will say we appear small-scale and involved. Personal contact with our customers is very important to us.<br> <br>
<b>Email:</b> <?php echo $email?> <br>
<b>Phone number:</b> <?php echo $tel?> <br>
<b>Address:</b> <?php echo $adres?> <br> <br>
<b>Business hours:</b> <br>
Monday 08:00 - 21:00 <br>
Tuesday 08:00 - 21:00 <br>
Wednesday 08:00 - 21:00 <br>
Thursday 08:00 - 21:00 <br>
Friday 08:00 - 21:00 <br>
Saturday 08:00 - 21:00 <br>
Sunday 09:00 - 19:00 <br> <br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d78016.33903673291!2d4.835525476262086!3d52.33395389313914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c609b70dd81623%3A0xcae71b8d3adfd142!2sAmsterdam%20Centraal!5e0!3m2!1snl!2snl!4v1605522129904!5m2!1snl!2snl" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> <br>

<?php
if (!empty($_SESSION['userid'])) {
    $sql = "SELECT medewerker FROM accounts WHERE id = '" . $_SESSION['userid'] . "'";
    $sql_run = mysqli_query($Connection, $sql);
    $medewerkerStatus = mysqli_fetch_all($sql_run, MYSQLI_ASSOC);
    if ($medewerkerStatus[0]["medewerker"] == 1){
        echo "<a href='contactAdministratie.php' class='HrefDecoration'>Update page</a>";
    }
}
?>
</div>

<?php
include "footer.php";
?>