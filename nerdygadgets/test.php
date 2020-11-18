<?php

session_start();



$username="test"; // jouw gebruikersnaam
$password="test"; // jouw wachtwoord



$username1="mathias"; // jouw gebruikersnaam
$password1="test"; // jouw wachtwoord


if(!empty($_POST)) {




    $_SESSION["username"]=$_POST["username"];
    $_SESSION["password"]=$_POST["password"];

    if(( $_SESSION["username"]!=$username) || ($_SESSION["password"]!=$password)) {

        die("Je hebt een verkeerde gebruikersnaam of wachtwoord ingevoerd!<br> <a href=\"login.php\">Terug</a>");

        session_destroy();
    }else{
        header("Location: invoeren.php");
    }
}else{




}
?>

<html>
<body>
<center>

    <b>Welkom bij de easyconcept login pagina !</b>

    </br></br></br>
    <form method=post action="<?php $PHP_SELF ?>">
        Gebruikersnaam: <input name=username name=username><br>
        Wachtwoord: <input name=password type=password name=password><br>
        <input type=submit value="Inloggen!">  </center>
</form>
</body>
</html>