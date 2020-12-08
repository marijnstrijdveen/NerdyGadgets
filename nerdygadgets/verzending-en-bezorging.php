<?php
include __DIR__ . '/init.php';
/** @var $Connection mysqli */

$headTitel = 'NerdyGadgets - Bezirging informatie';
include __DIR__ . '/header.php';
?>

    <div style="text-align: center;">
    <h2>Shipping and Delivery</h2>
        <br>
        <br>
    <h3>Delivery time</h3>
    <p>If you place your order before 12:00 AM on a weekday, your package will usually be delivered to you the next working day. <br>
        Did you place an order on a Saturday or a Sunday? In this case it might take us two days to deliver your package. <br>
        The shipment of your package is provided by PostNL, we depend on their delivery.
    </p>

    <h3>Free Shipping</h3>
    <p>The standard shipping costs are € 4.95. Take advantage of free shipping on orders above €50,-. <br>
        In the checkout process you’ll see exactly what the shipping costs will be for your order.
    </p>

    <h3>Home delivery</h3>
    <p>Packages are delivered to your home by PostNL. If you are not at home, the delivery person offers the package to your neighbors. <br>
        If the neighbors do not respond, we will try to deliver your order on another day, at a different time.
    </p>

    <h3>Delivery to a different address</h3>
    <p>if you are not at home all day because of work, you can have your package delivered to your workplace, <br>
        a family member or a neighbor.
    </p>

    <h3>Follow your package via Track & Trace</h3>
    <p>Early in the morning on the day of delivery,  <br> you will receive an email with the Track & Trace data of your order.  <br>
        Via the link in this email you can see exactly when your order is going to be delivered.
        Either that or via the <a href="https://jouw.postnl.nl/#!/" target="_blank">webpage PostNL Track & Trace</a>.
    </p>
    </div>


<?php include "footer.php" ?>