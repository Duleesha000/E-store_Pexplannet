<!DOCTYPE html>
<html>
<head>
	<title>Product Name | E-Commerce Store</title>
	<link rel="stylesheet" type="text/css" href="siteCss.css">
</head>

<?php
include "database.php";
if (isset($_POST['query'])) {
// Get the search query from the GET parameter
$query = $_POST['query'];

// Prepare the SQL statement to search for the query in the database
$sql = "SELECT * FROM item WHERE itemName LIKE '%$query%'";

// Execute the SQL statement
$result = mysqli_query($conn, $sql);

// Check if any results were found
if (mysqli_num_rows($result) > 0) {
  // Display the results in a product grid
  while($row = mysqli_fetch_assoc($result)) {
    echo '<div class="product-card" data-product-id="'.$row['itemId'].'" onclick="location.href=\'product.php?itemId='.$row['itemId'].'\';">';//'   "onclick="location.href=\'product.php\'; ">   ';
    echo '<img src="'.$row['imageLink'].'" alt="'.$row['itemName'].'">';
    echo '<h4>'.$row['itemName'].'</h4>';
    echo '<p>LKR '.$row['unitPrice'].'</p>';
    echo '</div>';
  }
} else {
  // If no results were found, display a message to the user
  echo '<h3>No results found.</h3>';
}
}

// Close the database connection
mysqli_close($conn);
?>

</html>