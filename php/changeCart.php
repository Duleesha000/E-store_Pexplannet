<?php
  if(isset($_POST['cId']) && isset($_POST['itemId'])){
    if(isset($_POST['quantity'])){
      include 'database.php';
      $customerId = $_POST['cId'];
      $itemId = $_POST['itemId'];
      $quantity = $_POST['quantity'];
      $query = "UPDATE Cart set quantity = $quantity where customerId='$customerId' and itemId='$itemId'";

      if(mysqli_query($conn, $query)){
        echo "Success";
      }
      else{
        echo "Error";
      }
      mysqli_close($conn);
    }
    else{
      include 'database.php';
      $customerId = $_POST['cId'];
      $itemId = $_POST['itemId'];
      $query = "DELETE from Cart where customerId='$customerId' and itemId='$itemId'";

      if(mysqli_query($conn, $query)){
        echo "Success";
      }
      else{
        echo "Error";
      }
      mysqli_close($conn);
    }
  }
?>