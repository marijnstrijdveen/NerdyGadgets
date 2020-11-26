<?php
include "header.php";

if(isset($_POST['submit'])){
    $email1 = $_POST["email"];
    $tel1 = $_POST["phone"];
    $adres1 = $_POST["address"];

    $sql = "UPDATE contact SET phone = '$tel1', email = '$email1', address = '$adres1' WHERE id = 1";
    $sql_run = mysqli_query($Connection, $sql);

    echo "<script>window.location='contact.php'</script>";
}
?>

<form method="POST" name="aanpassing" action="">
    Email: <input type="text" name="email" value="">
    Telefoonnummer: <input type="text" name="phone" value="">
    Adres: <input type="text" name="address" value="">
    <input type="submit" name='submit' value="Opslaan">
</form>

