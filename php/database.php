<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "pexxplanet";

$conn = mysqli_connect($server, $username, $password, $dbname);
if(!$conn){
  die("Database Connection Failed");
}
?>