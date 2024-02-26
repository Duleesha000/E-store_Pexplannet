<?php
  include "database.php";

  $fName = $_POST['fName'];
  $lName = $_POST['lName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $nextCid = getNextCId($conn);

  $available = mysqli_num_rows(mysqli_query($conn,"SELECT customerId from Customer_Login where email='".$email."'"))>0? false : true;
  if($available){
    $registerQuery = "Insert into Customer (`customerId`,`firstName`, `lastName`) values ('$nextCid', '$fName', '$lName')";
    if(mysqli_query($conn, $registerQuery)){
      $registerQuery = "Insert into Customer_Login (`customerId`,`email`, `password`) values ('$nextCid', '$email', '$password')";
      if(mysqli_query($conn, $registerQuery)){
        echo "Success";
      }
      else echo "Registration Failed";
    }
    else echo "Registration Failed";
  }
  else {
    mysqli_close($conn);
    die("UsedEmail");
  }
  
  mysqli_close($conn);

  function getNextCId($conn){
    $query = "SELECT max(customerId) as maxCid from Customer" ;
    $cIdresult = mysqli_query($conn, $query);
    $cid = mysqli_fetch_assoc($cIdresult)['maxCid'];
    $nextCid1 = 'C'.((int) filter_var($cid, FILTER_SANITIZE_NUMBER_INT)+1);
    return $nextCid1;
  }
?>