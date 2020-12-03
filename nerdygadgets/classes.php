<?php

class shows extends db_connection {
    
    public function add_cart(){
    if (isset($_SESSION['userid'])) {
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
  }} else {
    $msg = '<div class="alert alert-danger">
            You Have to Registered and Login First!
          </div>';
  }
    
    return $msg;
  }

  public function show_cart(){
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
            if (empty($row1['ImagePath'])) {
                $sql2 = "SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = '{$id}' LIMIT 1 ";
                $result2 = mysqli_query($this->call_db(),$sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $image = "StockGroupIMG/".$row2['ImagePath'];
            }
            
              $total_price = $row['RecommendedRetailPrice']*(1+($row['TaxRate']/100));
            $info .= '
            <tr name="line_items">
            <input type="hidden" value="'.$id.'" name="StockItemID[]">
                <td><a href="cart.php?dlt_item='.$id.'" class="btn btn-danger">Remove</button></td>
                <td><img src="Public/'.$image.'" alt="" class="cart-img"></td>
                <td>'.$row['StockItemName'].'</td>
                <td><input type="text" name="qty'.$i.'" value="1"></td>
                <td><input type="text" name="price" value="'.$total_price.'" disabled></td>
                <td>&nbsp;</td>
                <td><input type="text" name="item_total" value="" jAutoCalc="{qty'.$i.'} * {price}" disabled></td>
            </tr> ';
        $i++;
          } while ($row = mysqli_fetch_assoc($result));
        }else {
        $info = '<div class="alert alert-danger">An Error Occurred!</div>';
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

    
public function checkout(){

  if (isset($_SESSION['userid'])) {
  $userid = $_SESSION['userid'];
  
  $cartitems = $_REQUEST['StockItemID'];
  // $cartitems = explode("," , $items);
  $date = date('Y-m-d');
  $sql = "INSERT INTO `orders1` (`CustomerID`,`OrderDate` ) Values ('{$userid}','{$date}')";
  $insert = mysqli_query($this->call_db(),$sql);
  
  $info = '';
  if ($insert) {
    
    $sql3 = "SELECT MAX(OrderID) AS `OrderID` FROM `orders1` WHERE `CustomerID` = '{$userid}'";
    $result3 = mysqli_query($this->call_db(),$sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $i = 1;
    foreach ($cartitems as $key => $id) {
      $sql1 = "SELECT * FROM `stockitems` WHERE `StockItemID` = '{$id}'";
      $result1 = mysqli_query($this->call_db(),$sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $oid = $row3['OrderID'];
      $desc = $row1['StockItemName'];
      $rqty = 'qty'.$i;
      $rqty = $_REQUEST[$rqty];

      $uprc = $row1['RecommendedRetailPrice'];
      $trt = $row1['TaxRate'];
      $sql2 = "INSERT INTO `orderlines1` (`OrderID`,`StockItemID`,`Description`,`Quantity`,`UnitPrice`,`TaxRate` ) Values ('{$oid}','{$id}','{$desc}','{$rqty}','{$uprc}','{$trt}')";
      $insert2 = mysqli_query($this->call_db(),$sql2);
      $i++;
    }
    
    unset($_SESSION['cart']);
    $info = '<div class="alert alert-success">Order Created!</div>';
  } else {
    $info = '<div class="alert alert-danger">Error!</div>';
  }} else {
    $info = '<div class="alert alert-danger">Login First!</div>';
  }
  return $info;
}


public function show_orders(){
  $id = $_SESSION['userid'];
  $sql1 = "SELECT * FROM `orders1` WHERE `CustomerID` = '{$id}'";
  $result1 = mysqli_query($this->call_db(),$sql1);
  $row1 = mysqli_fetch_assoc($result1);
  $show = '';
  if (mysqli_num_rows($result1)>0) {
      do {
        $oid = $row1['OrderID'];
      $sql = "SELECT COUNT(*) AS `total` FROM `orderlines1` WHERE `OrderID` = '{$oid}'";
      $result = mysqli_query($this->call_db(),$sql);
      $row = mysqli_fetch_assoc($result);
      $items = $row['total'];
        $show .= '
        <tr>
            <td>'.$row1['OrderID'].'</td>
            <td>'.$items.'</td>
            <td><a class="btn btn-info" href="orders.php?OrderID='.$row1['OrderID'].'">View Order</a></td>
        </tr>';
      } while ($row1 = mysqli_fetch_assoc($result1));
  } else {
    $info = '<td colspna="3"><div class="alert alert-danger">No Orders Yet!</div></td>';
  }
  return $show;
  
}


public function order_details(){
  $oid = $_REQUEST['OrderID'];
  $sql1 = "SELECT * FROM `orderlines1` WHERE `OrderID` = '{$oid}'";
  $result1 = mysqli_query($this->call_db(),$sql1);
  $row1 = mysqli_fetch_assoc($result1);
  $show = '';
  if (mysqli_num_rows($result1)>0) {
    $ship = 4.95;
    $subtotal = 0;
      do {
        $price = $row1['UnitPrice']*(1+($row1['TaxRate']/100));
        $item_total = $price*$row1['Quantity'];
        $show .= '
        <tr>
            <td>'.$row1['StockItemID'].'</td>
            <td>'.$row1['Description'].'</td>
            <td>'.$row1['Quantity'].'</td>
            <td>'.$price.'</td>
            <td>'.$item_total.'</td>
        </tr>';
        $subtotal = $item_total+$subtotal;
      } while ($row1 = mysqli_fetch_assoc($result1));
      $show .= '<tr>
      <td colspan="3"></td><td><b>Sub Total:</b></td><td><b>'.$subtotal.'</b></td>
      </tr><tr>
      <td colspan="3"></td><td><b>Shipping Fees:</b></td><td><b>'.$ship.'</b></td>
      </tr><tr>
      <td colspan="3"></td><td><b>Grand Total:</b></td><td><b>'.($subtotal+$ship).'</b></td>
      </tr>';
  } else {
    $info = '<td colspna="3"><div class="alert alert-danger">No Orders Yet!</div></td>';
  }
  return array($oid,$show);
  
}

}


?>