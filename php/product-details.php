<?php
  $itemId = "";
  $itemName ="Product Name";
  $description = "";
  $unitPrice = 0.00;
  $availableQuan=0;
  $imageLink = "";
  $resultRow;
  if(isset($_GET['itemId'])){
    $itemId = $_GET['itemId'];
    $detailQuery = "SELECT * From Item where itemId = '$itemId'";
    $suggestionQuery = "SELECT * From Item where categoryId = '$itemId'";

    include 'database.php';
    $resultRow = mysqli_fetch_assoc(mysqli_query($conn, $detailQuery));

    $itemName = $resultRow['itemName'];
    $description = $resultRow['description'];
    $unitPrice = $resultRow['unitPrice'];
    $availableQuan = $resultRow['availableQuantity'];
    $imageLink = $resultRow['imageLink'];
    $categoryId = $resultRow['categoryId'];
    
    $suggestionQuery = "SELECT itemName, imageLink, unitPrice From Item where categoryId = '$categoryId' and itemId != '$itemId' order by rand() limit 4";
    $seggestionsResult =  mysqli_query($conn, $suggestionQuery); 
    mysqli_close($conn);
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>All Products | PexxPlanet</title>
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../product_details.css">
    <link rel="stylesheet" href="../footer.css">
</head>

<body>
    <?php include 'header.php'; ?>
</div>
    <!-- Single Products -->
    <div class="small-container single-product">
        <div class="row">
            <div class="col-2">
                <img src="<?php echo $imageLink ?>" width="100%" id="ProductImg">

                <div class="small-img-row">
                    <div class="small-img-col">
                        <img src="<?php echo $imageLink ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?php echo $imageLink ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?php echo $imageLink ?>" width="100%" class="small-img">
                    </div>
                    <div class="small-img-col">
                        <img src="<?php echo $imageLink ?>" width="100%" class="small-img">
                    </div>
                </div>

            </div>
            <div class="col-2">
                <p>Home / T-Shirt</p>
                <h1><?php echo $itemName ?></h1>
                <h4>LKR <?php echo $unitPrice ?></h4>

                <input type="number" id="txtQuantity" value="1" min="1" max="<?php echo $availableQuan ?>">
                <input type="hidden" id="itemId" value="<?php echo $itemId ?>">
                <input type="hidden" id="avaiQuant" value="<?php echo $availableQuan ?>">
                <button class="btn" onclick="btnAddToCartClick()">Add To Cart</button>
                <br>
            </div>
        </div>
    </div>
    <center><h2>Product Details</h2></center>
    <p class="p2"><?php echo $description ?></p>
    <!-- title -->
    <br><br><br>
    <div class="small-container">
        <div class="row row-2">
            <h2>Related Products</h2>
        </div>
    </div>
    <!-- Products -->
    <div class="small-container">
        <div class="row">
          <?php 
            while($row = mysqli_fetch_assoc($seggestionsResult)){
              echo '<div class="items">
              <img src='.$row['imageLink'].'>
              <h4>'.$row['itemName'].'</h4>
              <p>'.$row['unitPrice'].'</p>
          </div>';
            }
          ?>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
    <!-- product gallery -->
    <script>
        var ProductImg = document.getElementById("ProductImg");
        var SmallImg = document.getElementsByClassName("small-img");

        SmallImg[0].onclick = function () {
            ProductImg.src = SmallImg[0].src;
        }
        SmallImg[1].onclick = function () {
            ProductImg.src = SmallImg[1].src;
        }
        SmallImg[2].onclick = function () {
            ProductImg.src = SmallImg[2].src;
        }
        SmallImg[3].onclick = function () {
            ProductImg.src = SmallImg[3].src;
        }

    </script>
    <script src="../productDetails.js"> </script>
</body>

</html>