<?php
include "header.php";

$query= "SELECT * FROM contact";

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
//TODO remove
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact page</title>
</head>
<body>
<div style="text-align: center;">
<b>Welkom op de contactpagina van NerdyGadgets!</b> <br> <br>
<b>Over ons:</b> <br>
Wij zijn Nerdygadgets. We zijn trots op onze producten en geloven in kwaliteit. In ieder huis vindt een product van Nerdygadgets zijn thuis.<br>
Ondanks onze grootte zien klanten ons als kleinschalig en betrokken. Persoonlijk klantcontact staat bij ons hoog in het vaandel. <br> <br>
<b>Email:</b> <?php echo $email?> <br>
<b>Telefoon nummer:</b> <?php echo $tel?> <br>
<b>Adres:</b> <?php echo $adres?> <br> <br>
<b>Openingstijden:</b> <br>
Maandag 08:00 - 21:00 <br>
Dinsdag 08:00 - 21:00 <br>
Woensdag 08:00 - 21:00 <br>
Donderdag 08:00 - 21:00 <br>
Vrijdag 08:00 - 21:00 <br>
Zaterdag 08:00 - 21:00 <br>
Zondag 09:00 - 19:00 <br> <br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d78016.33903673291!2d4.835525476262086!3d52.33395389313914!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c609b70dd81623%3A0xcae71b8d3adfd142!2sAmsterdam%20Centraal!5e0!3m2!1snl!2snl!4v1605522129904!5m2!1snl!2snl" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> <br>

    <?php
   if (!empty($_SESSION['userid'])) {
    $sql = "SELECT medewerker FROM accounts WHERE id = '" . $_SESSION['userid'] . "'";
    $sql_run = mysqli_query($Connection, $sql);
    $medewerkerStatus = mysqli_fetch_all($sql_run, MYSQLI_ASSOC);
      //TODO console log
       // debug_to_console("test" . (string) $medewerkerStatus);
        if ($medewerkerStatus[0]["medewerker"] == 1){
       echo "<a href='contactAdministratie.php' class='HrefDecoration'>Pagina bijwerken</a>";
        }
   }
    ?>

</div>

</body>
</html>

<?php
include "footer.php";
?>