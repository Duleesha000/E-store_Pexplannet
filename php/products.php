<?php
$brandId ="";
  if(isset($_GET['brandId'])){
    $brandId = $_GET['brandId'];
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Products | Pexx Planet</title>
    <link rel="stylesheet" href="../product.css">
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../footer.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/d7a20b2e71.js">
   
</head>

<body onload="searchProduct(`<?php echo $brandId ?>`, ``, ``);  onLoad()">
    <?php include 'header.php' ?>
        </div>
    </div>

    <!-- All Products -->
    <div class="search-container">
        <div class="search-group">
            <div class="custom-select" style="width:200px;">
                <select id="categorySelect">
                  <option value="">Category</option>
                  <?php
                    include 'database.php';
                    
                    $query = "SELECT * from Category";
                    if($result = mysqli_query($conn, $query)){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'.$row['categoryId'].'">'.$row['name'].'</option>';
                      }
                    }
                  ?>
                </select>
              </div>
              <div class="custom-select" style="width:200px;">
                <select id="brandSelect">
                  <option value="">Brand</option>
                  <?php
                    $query = "SELECT * from Brand";
                    if($result = mysqli_query($conn, $query)){
                      while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'.$row['brandId'].'">'.$row['name'].'</option>';
                      }
                    }
                    mysqli_close($conn);
                  ?>
                </select>
              </div>
            <div class="search">
                <input type="text" class="search-input" id="searchTxt" placeholder="Search for Products">
                <button class="btn-search" type="submit" onclick="searchClick()"><svg class="svg-icon" viewBox="0 0 20 20">
                    <path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
                </svg></i></button>
            </div>
        </div>

    </div>

    <div class="small-container">
        <div class="row-2">
            <h2>Products</h2>
        </div>
        <div id="itemList">
            
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php' ?>
    <script src="../product.js"></script>
</body>

</html>