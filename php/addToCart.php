<?php
  include 'database.php';

  if(isset($_POST['cId']) && isset($_POST['itemId']) && isset($_POST['quantity'])){
    $customerId = $_POST['cId'];
    $itemId = $_POST['itemId'];
    $quantity = $_POST['quantity'];
    if(isset($_POST['update'])){
      $query = "UPDATE Cart set quantity=quantity+$quantity where customerId='$customerId' and itemId='$itemId'";

      if(mysqli_query($conn, $query)) echo "Success";
      else echo "Error";
    }
    else{
      $checkQuery = "SELECT itemId from Cart where customerId='$customerId' and itemId='$itemId'";
    $result = mysqli_query($conn, $checkQuery);
    if(mysqli_num_rows($result)>0){
      echo "Already Exists";
    }
    else{
      $query = "INSERT into Cart values ('$customerId', '$itemId', $quantity)";

      if(mysqli_query($conn, $query)) echo "Success";
      else echo "Error";
    }   
    }
    
  }
  mysqli_close($conn);
?>