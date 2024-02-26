<?php
  $customerId ="";
  if(isset($_GET['cId'])){
    $customerId = $_GET['cId'];
  }

  include 'database.php';
  $detailsQuery = "SELECT * from Customer where customerId= '$customerId'";
  $details = mysqli_fetch_assoc(mysqli_query($conn, $detailsQuery));

  $addressQuery = "SELECT * from Customer_Address where customerId= '$customerId'";
  $addresses = mysqli_query($conn, $addressQuery);

  $cartQuery = "SELECT itemName, quantity, (unitPrice*quantity) as subTotal from Cart inner join Item on Cart.itemId = Item.itemId where customerId = '$customerId'";
  $cartResult = mysqli_query($conn, $cartQuery);

  mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../checkout2.css"/>
        <title>Checkout | PexxPlanet</title>
    </head>
    <body onload="addressChanged()">
<div class="container">
    <div class="title">
        <h2>Checkout</h2>
    </div>
  <div class="d-flex">
    <form action="" method="post">
    <input type="hidden" id="cId" value="<?php echo $customerId?>">
      <label>
        <span class="fname">First Name <span class="required">*</span></span>
        <input type="text" id="fname" name="fname" value="<?php echo $details['firstName'] ?>">
      </label>
      <label>
        <span class="lname">Last Name <span class="required">*</span></span>
        <input type="text" id="lname" name="lname" value="<?php echo $details['lastName'] ?>">
      </label>      
      <label>
        <span>Company Name (Optional)</span>
        <input type="text" id="companyName" name="companyName" value="<?php echo $details['companyName'] ?>">
      </label>
      <label>        
        <span>Select Address <span class="required">*</span></span>
        <select id="addresses" onchange="addressChanged()">
          <?php
            while($row = mysqli_fetch_assoc($addresses)){
              $address = $row['no'].",". $row['apartment'].",". $row['streetName'].",". $row['townCity'].",". $row['district'].",". $row['province'].",". $row['postalCodeZip'];
              echo "<option value=".$row['addressId'].">$address</option>";
            }
          ?>
        </select>
      </label>
      <div class="address">
      <label>        
          <span>House No <span class="required">*</span></span>
          <input type="text" id="no" name="houseadd" placeholder="House number" required>
        </label>
        <label>
          <span>&nbsp;</span>
          <input type="text" id="apartment" name="apartment" placeholder="Apartment, suite, unit etc. (optional)">
        </label>
        <label>
          <span>Street Name <span class="required">*</span></span>
          <input type="text" id="streetName" name="streetName" placeholder="Street Name">
        </label>
        <label>
          <span>Town / City <span class="required">*</span></span>
          <input type="text" id="townCity" name="townCity"> 
        </label>
        <label>
          <span>District <span class="required">*</span></span>
          <select name="district" id="district">
              <option value="select">Select Your District</option>
              <option value="AB">Ampara</option>
              <option value="AD">Anuradhapura</option>
              <option value="BD">Badulla</option>
              <option value="BT">Batticaloa</option>
              <option value="CO">Colombo</option>
              <option value="GA">Galle</option>
              <option value="GM">Gampaha</option>
              <option value="HT">Hambantota</option>
              <option value="JF">Jaffna</option>
              <option value="KD">Kandy</option>
              <option value="KG">Kegalle</option>
              <option value="KN">Kilinochchi</option>
              <option value="KN">Kurunegala</option>
              <option value="MT">Mannar</option>
              <option value="MT">Matale</option>
              <option value="MR">Monaragala</option>
              <option value="MT">Mullaitivu</option>
              <option value="NE">Nuwara Eliya</option>
              <option value="PT">Puttalam</option>
              <option value="PL">Polonnaruwa</option>
              <option value="RT">Ratnapura</option>
              <option value="TC">Trincomalee</option>
              <option value="VY">Vavuniya</option>            
          </select>
        </label>
        <label>
          <span>Province<span class="required">*</span></span>
          <select name="province" id="province">
              <option value="select">Select Your Province</option>
              <option value="CP">Central Province</option>
              <option value="EP">Eastern Province</option>
              <option value="NC">Northern Province</option>
              <option value="NW">North Western Province</option>
              <option value="NP">North Central Province</option>
              <option value="SB">Sabaragamuwa Province</option>
              <option value="SP">Southern Province</option>
              <option value="UP">Uva Province</option>
              <option value="WP">Western Province</option>
          </select>
        </label>
        <label>
          <span>Postcode / ZIP <span class="required">*</span></span>
          <input type="text" id="postalCodeZip" name="postalCodeZip"> 
        </label>
      </div>
      
      <label>
        <span>Phone <span class="required"  value="<?php echo $details['phone'] ?>">*</span></span>
        <input id="phone" type="phone" name="city"> 
      </label>
    </form>
    <div class="Yorder">
      <table>
        <tr>
          <th colspan="2">Your Order</th>
        </tr>
        
          <?php
            $cartTotal = 0.00;
            while($row = mysqli_fetch_assoc($cartResult)){
              echo "<tr>
                      <td>".$row['itemName']."- ".$row['quantity']."(Qty)</td>
                      <td>".$row['subTotal']."</td>
                    </tr>";
              $cartTotal+= $row['subTotal'];
            }
          ?>
          
        
        <tr>
          <td>Subtotal</td>
          <td>LKR <?php echo sprintf("%0.2f", $cartTotal); ?></td>
        </tr>
        <tr>
          <td>Shipping</td>
          <td>Free shipping</td>
        </tr>
      </table><br>
      <div>
        <input type="radio" name="dbt" value="directBT" id="payType" checked>Direct Bank Transfer
      </div>
      <p>
          Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
      </p>
      <div>
        <input type="radio" name="dbt" value="cashOD" id="payType">Cash on Delivery
      </div>
      <div>
        <input type="radio" name="dbt" value="cardP" id="payType">Card Payment
        <span>
        <img src="https://www.logolynx.com/images/logolynx/c3/c36093ca9fb6c250f74d319550acac4d.jpeg" alt="" width="50">
        </span>
      </div>
      <button type="submit" onclick="checkout()">Place Order</button>
    </div><!-- Yorder -->
   </div>
  </div>
  <script src="../checkout.js"></script>
</body>
</html>