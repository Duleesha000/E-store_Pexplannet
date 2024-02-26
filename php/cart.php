<?php
  $queryResult;
  $itemCount = 0;
  $totalPrice = 0.00;
  $promotion = 0.00;
  $customerId;
  if(isset($_GET['cId'])){
    $customerId = $_GET['cId'];
    include 'database.php';

    $query = "SELECT Cart.quantity, item.itemName, item.itemId, item.unitPrice, item.imageLink, (Cart.quantity*Item.unitPrice) as total from Cart inner join Item on Cart.itemId = Item.itemId where customerId = '$customerId' ";
    
    $queryResult = mysqli_query($conn, $query);
    $itemCount = mysqli_num_rows($queryResult);
    mysqli_close($conn);
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../cart2.css">
        <link rel="stylesheet" href="../header.css">
    </head>
    <body onload="onLoad()">
        <?php include 'header.php' ?>
        <div class="cart-page">
            <div class="cart">
                <div class="table-grid">
                    <div class="table-topic">
                        <p>Shopping Cart</p>
                    </div>
                    
                    <div class="table-details">
                            <div class="table-topics">
                                <div class="details"> PRODUCT</div>
                                <div class="price"> PRICE</div>
                                <div class="qty"> QUANTITY</div>
                                <div class="total"> TOTAL</div>
                            </div>
                            <?php
                              if(mysqli_num_rows($queryResult)>0){
                                while($row=mysqli_fetch_assoc($queryResult)){
                                  echo '<div class="list-item">
                                  <div class="prod-details">
                                      <div class="prod-image-div">
                                          <img class="prod-image" src='.$row['imageLink'].'>
                                      </div>
                                      <div class="prod-info-div">
                                          <div class="prod-name">
                                             <p>'.$row['itemName'].'</p>
                                          </div>
                                          <div class="remove-div">
                                              <button class="remove-button" onclick="onItemRemove(`'.$row['itemId'].'`, `'.$row['itemName'].'`)">
                                                  Remove
                                              </button>
                                          </div>
                                      </div>                                      
                                  </div>
                                  <div class="real-price">'.$row['unitPrice'].'</div>
                                  <div class="real-qty"><input type="number" id="txtListQuan" min="1" value="'.$row['quantity'].'"  onchange="onQuantityChange(`'.$row['itemId'].'`, this.value)"></div>
                                  <div class="real-total">'.$row['total'].'</div>
                              </div>';
                              $totalPrice+=$row['total'];
                                }
                              }
                            ?>              
                    </div>
                </div>
                <div class="order-summary">
                    <div class="summary-top">
                        <div class="summary-topic">
                            <p>Order Summary</p>
                        </div>

                        <div class="items-div">
                            <div class="items-no">
                                    <p><small>Item Count: <?php echo $itemCount ?></small></p>
                            </div>
                            <div class="items-price">
                                    <p><small>Sub Total: LKR <?php echo $totalPrice ?></small></p>
                            </div>
                        </div>
                    </div>

                    <div class="payment-div">
                        <div class="promo-code-div">
                            <div class="promo-title">
                                <P><small>PROMO CODE</small></P>
                            </div>
                            <div class="promo-input-div">
                                <input type="text" placeholder="Enter your code" class="promo-code">
                            </div>
                            <div class="button-div">
                                <button class="apply-button">APPLY</button>
                            </div>
                        </div>

                        <div class="checkout-div">
                            <div class="total-cost-div">
                                <div class="cost-topic">
                                <p><small>TOTAL COST</small></p>
                                </div>
                                <div class="total-num">
                                    <small><p>LKR <?php echo $totalPrice?></small></p>
                                </div>
                            </div>
                            <div class="checkout-button-div">
                                <button class="checkout-button" onclick="location.href='checkout.php?cId=<?php echo $customerId ?>'">
                                    CHECKOUT
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    <script src="../cart.js"></script>
    </body>
</html>