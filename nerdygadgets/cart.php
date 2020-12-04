<?php
session_start();
include('defines/connection.php');
include('classes.php');
$shows = new shows();

$info = '';
if (!isset($_SESSION['cart'])) {
    $info = '<div class="alert alert-danger">Cart is Empty!</div>';
}
$info_dlt = '';
if (isset($_GET['dlt_item'])) {
    $info_dlt = $shows->dlt_item($conn);
}
$checkout = '';
if (isset($_REQUEST['checkout'])) {
    $checkout = $shows->checkout($conn);
} 
$empty = '';
if (isset($_GET['empty'])) {
    unset($_SESSION['cart']);
    $empty = '<div class="alert alert-success">Cart Emptied!</div>';
}
$items = '';
if (isset($_SESSION['cart'])) {
    $items = $shows->show_cart($conn);
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="Public/JS/fontawesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.1.1/flatly/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <title>Cart</title>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="dist/jautocalc.js"></script>
    <link rel="stylesheet" href="Public/CSS/Style.css?a=<?php echo time();   ?>" type="text/css">
    <link rel="apple-touch-icon" sizes="57x57" href="Public/Favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="Public/Favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="Public/Favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="Public/Favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="Public/Favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="Public/Favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="Public/Favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="Public/Favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="Public/Favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="Public/Favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="Public/Favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="Public/Favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="Public/Favicon/favicon-16x16.png">
    <link rel="manifest" href="Public/Favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="Public/Favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script type="text/javascript">
        $(document).ready(function() {

            function autoCalcSetup() {
                $('form[name=cart]').jAutoCalc('destroy');
                $('form[name=cart] tr[name=line_items]').jAutoCalc({
                    keyEventsFire: true,
                    decimalPlaces: 2,
                    emptyAsZero: true
                });
                $('form[name=cart]').jAutoCalc({
                    decimalPlaces: 2
                });
            }
            autoCalcSetup();


            $('button[name=remove]').click(function(e) {
                e.preventDefault();

                var form = $(this).parents('form')
                $(this).parents('tr').remove();
                autoCalcSetup();

            });

            $('button[name=add]').click(function(e) {
                e.preventDefault();

                var $table = $(this).parents('table');
                var $top = $table.find('tr[name=line_items]').first();
                var $new = $top.clone(true);

                $new.jAutoCalc('destroy');
                $new.insertBefore($top);
                $new.find('input[type=text]').val('');
                autoCalcSetup();

            });

        });
    </script>
    <style>
        .main-cart{
            margin-top: 220px;
        }
    </style>
</head>

<body>
<div class="row" id="Header">
    <div class="col-2"><a href="./" id="LogoA">
            <div id="LogoImage">
                <img src="Public/Img/Logo1.jpg" name="Logo1">
            </div>
            </a></div>
        <div class="col-8" id="CategoriesBar">
            <ul id="ul-class">
                                    <li>
                        <a href="browse.php?category_id=1" class="HrefDecoration">Novelty Items</a>
                    </li>
                                        <li>
                        <a href="browse.php?category_id=2" class="HrefDecoration">Clothing</a>
                    </li>
                                        <li>
                        <a href="browse.php?category_id=4" class="HrefDecoration">T-Shirts</a>
                    </li>
                                        <li>
                        <a href="browse.php?category_id=6" class="HrefDecoration">Computing Novelties</a>
                    </li>
                                        <li>
                        <a href="browse.php?category_id=7" class="HrefDecoration">USB Novelties</a>
                    </li>
                                        <li>
                        <a href="browse.php?category_id=9" class="HrefDecoration">Toys</a>
                    </li>
                                    <li>
                    <a href="categories.php" class="HrefDecoration">Categories</a>
                </li>
            </ul>
        </div>
    <ul id="ul-class-navigation">
        <?php
        if (isset($_SESSION["userid"])){
            echo "<li><a href='account.php'class='HrefDecoration'>Account | </a></li>";
            echo "<li><a href='logout.php'class='HrefDecoration'>Log out |</a></li>";
        } else {
            echo "<li><a href='inloggen.php'class='HrefDecoration'>Log in</a></li>";
        }
        ?>
        <li>
            <a href="verlanglijstje.php" class="HrefDecoration">Wishlist</a>
        </li>
        <li>
            <a href="cart.php" class="HrefDecoration"><i class="fas fa-shopping-cart" style="color:#676EFF;" aria-hidden="true"></i> Cart</a>
        </li>
        <li>
            <a href="browse.php" class="HrefDecoration"><i class="fas fa-search" style="color:#676EFF;" aria-hidden="true"></i> Zoeken</a>
        </li>
    </ul>
    </div>
    <div class="row main-cart">
    <div class="container">
        <h1>Cart - NerdyGadgets</h1>
        <?php echo $checkout;?>
        <?php echo $info_dlt; echo $empty; echo $info; ?>
        <form name="cart" method="POST">
            <table name="cart" class="table  table-bordered">
                <tr>
                    <th></th>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>&nbsp;</th>
                    <th>Item Total</th>
                </tr>
                <?php echo $items; ?>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td>Subtotal</td>
                    <td>&nbsp;</td>
                    <td><input type="text" name="sub_total" value="" jAutoCalc="SUM({item_total})" disabled></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td>
                        Shipping Fee :
                    </td>
                    <td>&nbsp;</td>
                    <td><input type="text" name="tax_total" value="4.95" disabled></td>
                </tr>
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td>Total</td>
                    <td>&nbsp;</td>
                    <td><input type="text" name="grand_total" value="" jAutoCalc="{sub_total} + {tax_total}" disabled></td>
                </tr>
                <tr>
                    <td colspan="99"><a href="cart.php?empty" class="btn btn-danger">Empty Cart</a>&nbsp&nbsp <button name="checkout" class="btn btn-success">Checkout with IDEAL</button></td>
                </tr>
            </table>
        </form>
    </div>
    </div>
</body>
<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'jqueryscript.net']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })();
</script>

</html>