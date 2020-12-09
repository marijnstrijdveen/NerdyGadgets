<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

if(isset($_POST['submit'])){
    $email1 = $_POST["email"];
    $tel1 = $_POST["phone"];
    $adres1 = $_POST["address"];

    $sql = "UPDATE contact SET phone = '$tel1', email = '$email1', address = '$adres1' WHERE id = 1";
    $sql_run = mysqli_query($Connection, $sql);

    echo "<script>window.location='contact.php'</script>";
}

$headTitel = 'NerdyGadgets - Administratie';
include __DIR__ . '/header.php';
?>

<form method="POST" name="adjustment" action="">
    Email: <input type="text" name="email" value="">
    Phone number: <input type="text" name="phone" value="">
    Address: <input type="text" name="address" value="">
    <input type="submit" name='submit' value="Save">
</form>
