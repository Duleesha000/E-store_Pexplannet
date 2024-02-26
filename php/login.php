<?php
  include "database.php";

  $email = $_POST['email'];
  $password = $_POST['password'];

  $loginQuery = "SELECT customerId from Customer_Login where email='".$email."' and password='".$password."'";
  $result = mysqli_query($conn, $loginQuery);
    if($result!=null){
      if(mysqli_num_rows($result)>0){
        $cId = mysqli_fetch_assoc($result)['customerId'];
        echo "Success ".$cId;
      }
      else echo "IncorrectCredentials";
    }
    else echo "Database Error";

    mysqli_close($conn);

?>