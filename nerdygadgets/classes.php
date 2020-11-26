<?php

class shows extends db_connection {

    public function add_cart(){
        if (isset($_GET['add']) & !empty($_GET['add'])) {

            if (isset($_SESSION['cart']) & !empty($_SESSION['cart'])) {
                $items = $_SESSION['cart'];
                $cartitems = explode("," , $items);
                if (in_array($_GET['add'], $cartitems)) {
                    $msg = '
        <div class="alert alert-danger">
          Product Already in Cart.
        </div>';
                }else {
                    $items .= "," . $_GET['add'];
                    $_SESSION['cart'] = $items;
                    $msg = '<div class="alert alert-success">
        Added To Cart.
      </div>';
                }

            }else {
                $items =  $_GET['add'];
                $_SESSION['cart'] = $items;
                $msg = '<div class="alert alert-success">
      Added To Cart.
    </div>';
            }
            return $msg;}
    }

    public function show_cart(){
        if (!$_SESSION['cart']) {
            header('Location: index.php?empty');
        }else {
            $items = $_SESSION['cart'];
            $cartitems = explode("," , $items);
            $total = '';
            $i = 1;
            $j = 1;
            $qty = 1;
            $info = '';
            foreach ($cartitems as $key => $id) {
                $sql = "SELECT * FROM `stockitems` WHERE `StockItemID` = '{$id}'";
                $result = mysqli_query($this->call_db(),$sql);
                $row = mysqli_fetch_assoc($result);

                if ($result) {
                    do {
                        $sql1 = "SELECT `ImagePath` FROM `stockitemimages` WHERE `StockItemID` = '{$id}'";
                        $result1 = mysqli_query($this->call_db(),$sql1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $image = "StockItemIMG/".$row1['ImagePath'];
                        if (empty($row['ImagePath'])) {
                            $sql2 = "SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = '{$id}' LIMIT 1 ";
                            $result2 = mysqli_query($this->call_db(),$sql2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $image = "StockGroupIMG/".$row2['ImagePath'];
                        }

                        $total_price = $row['RecommendedRetailPrice']*(1+($row['TaxRate']/100));
                        $info .= '</tr>
            <tr name="line_items">
                <td><a href="cart.php?dlt_item='.$id.'" class="btn btn-danger">Remove</button></td>
                <td><img src="Public/'.$image.'" alt="" class="cart-img"></td>
                <td>'.$row['StockItemName'].'</td>
                <td><input type="text" name="qty" value="1"></td>
                <td><input type="text" name="price" value="'.$total_price.'" disabled></td>
                <td>&nbsp;</td>
                <td><input type="text" name="item_total" value="" jAutoCalc="{qty} * {price}" disabled></td>
            </tr> ';
                        $i++;
                    } while ($row = mysqli_fetch_assoc($result));
                }else {
                    $info = '<div class="alert alert-danger">An Error Occurred!</div>';
                }
            }
        }
        return $info;


    }


    public function dlt_item(){

        $items = $_SESSION['cart'];
        $cartitems = explode("," , $items);
        $info = '';
        $delitem = $_REQUEST['dlt_item'];
        if (($key = array_search($delitem, $cartitems)) !== false) {
            unset($cartitems[$key]);
        }
        $itemids = implode("," , $cartitems);
        $_SESSION['cart'] = $itemids;

        $info = '<div class="alert alert-success">Item Deleted!</div>';

        return $info;
    }


}


?>