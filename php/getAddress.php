<?php
  include 'database.php';
  $addressId = $_GET['addressId'];
  $query = "SELECT * from Customer_Address where addressId = '$addressId'";
  $address = mysqli_query($conn, $query);

  $no="";
  $apartment = "";
  $streetName = "";
  $townCity = "";
  $district = "";
  $province = "";
  $postalCodeZip = "";
  if(mysqli_num_rows($address)>0){
    $row = mysqli_fetch_assoc($address);
    $no= $row['no'];
    $apartment = $row['apartment'];
    $streetName = $row['streetName'];
    $townCity = $row['townCity'];
    $district = $row['district'];
    $province = $row['province'];
    $postalCodeZip = $row['postalCodeZip'];
    echo $no.'&'.$apartment.'&'.$streetName.'&'.$townCity.'&'.$district.'&'.$province.'&'.$postalCodeZip;
  }
  else{
    echo "Error";
  }

  mysqli_close($conn);
?>