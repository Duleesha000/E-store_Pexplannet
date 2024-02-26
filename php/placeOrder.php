<?php
  include 'database.php';
  if(isset($_POST['name'])&&isset($_POST['cn'])&&isset($_POST['phn'])&&isset($_POST['payType'])){
    $customerId = $_POST['cId'];
    $name = $_POST['name'];
    $companyName = $_POST['cn'];
    $phone = $_POST['phn'];
    $payType = $_POST['payType'];
    $addressId = "";
    $addressSuccess = true;
    $orderId = getNextOId($conn);
    if(isset($_POST['addId'])){
      $addressId = $_POST['addId'];
    }
    else{
      $addressSuccess = false;
      $addressId = getNextAddId($conn);
      $addressQuery = "INSERT INTO `customer_address`(`addressId`, `customerId`, `no`, `apartment`, `streetName`, `townCity`, `district`, `province`, `postalCodeZip`) 
      VALUES ('$addressId','$customerId','".$_POST['no']."','".$_POST['apartment']."','".$_POST['streetName']."','".$_POST['townCity']."','".$_POST['district']."','".$_POST['province']."','".$_POST['postalCodeZip']."')";
      if(mysqli_query($conn, $addressQuery)){
        $addressSuccess =true;
      }
    }
    if($addressSuccess){
      $getTotalQuery = "SELECT sum(Item.unitPrice * Cart.quantity) as total from Cart inner join Item on Cart.itemId = Item.itemId where customerId = '$customerId'";
      $total= mysqli_fetch_assoc(mysqli_query($conn, $getTotalQuery))['total'];
      $placeOrderQuery = "INSERT INTO `orders`(`orderId`, `customerId`, `total`, `paymentType`, `name`, `addressId`, `companyName`, `phone`, `status`) 
                          VALUES ('$orderId','$customerId','$total','$payType','$name','$addressId','$companyName','$phone','Placed')";
      if(mysqli_query($conn, $placeOrderQuery)){
        $updateOrderItemQuery = "INSERT into Order_Item SELECT '$orderId', Cart.itemId, unitPrice, quantity FROM Cart inner join Item on Cart.itemId = Item.itemId where customerId = '$customerId'";
        if(mysqli_query($conn, $updateOrderItemQuery)){
          $deleteQuery = "DELETE from Cart where customerId='$customerId'";
          mysqli_query($conn, $deleteQuery);
          echo "Success";
        }
        else{
          echo 'Error';
        }
      }
      else{
        echo 'Error';
      }
    }
    
  }
  
  function getNextAddId($conn){
    $query = "SELECT max(addressId) as maxAddId from Customer_Address" ;
    $addIdresult = mysqli_query($conn, $query);
    $cid = mysqli_fetch_assoc($addIdresult)['maxAddId'];
    $nextCid1 = 'A'.((int) filter_var($cid, FILTER_SANITIZE_NUMBER_INT)+1);
    return $nextCid1;
  }

  function getNextOId($conn){
    $query = "SELECT max(orderId) as maxOid from Orders" ;
    $oIdresult = mysqli_query($conn, $query);
    $cid = mysqli_fetch_assoc($oIdresult)['maxOid'];
    $nextOid1 = 'O'.((int) filter_var($cid, FILTER_SANITIZE_NUMBER_INT)+1);
    return $nextOid1;
  }
?>