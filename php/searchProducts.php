<?php
  if(isset($_GET['brandId']) && isset($_GET['categoryId']) && isset($_GET['searchText'])){
    include 'database.php';

    $query = "SELECT itemId, itemName, unitPrice, imageLink from Item where brandId like ('%".$_GET['brandId']."%') and  categoryId like ('%".$_GET['categoryId']."%') and itemName like ('%".$_GET['searchText']."%')";

    if($result = mysqli_query($conn, $query)){
      echo "Success/|";
      $i=1;
      while($row = mysqli_fetch_assoc($result)){
        if($i%4==1) echo '<div class="row">';
        echo '<div class="products">
        <a href="product-details.php?itemId='.$row['itemId'].'"><img src="'.$row['imageLink'].'"></a>
        <h4>'.$row['itemName'].'</h4>       
        <p>LKR '.$row['unitPrice'].'</p>
        </div>';
        if($i%4==0) echo '</div>';
        $i++;
      }
      if(($i-1)%4!=0) echo '</div>';
    }
    mysqli_close($conn);
  }
?>