<?php
  $prePage ="";
  if(isset($_GET['prePage'])){
    $prePage = $_GET['prePage'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products | PexxPlanet</title>
    <link rel="stylesheet" href="../account.css">
    <link rel="stylesheet" href="../header.css">
</head>

<body onload="onLoad()">
    <?php include 'header.php' ?>
</div>
    <!-- Account Page -->
    <div class="header">
        <div class="account-page">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <img src="../images/image1.png" width="100%">
                    </div>
                    <div class="col-2">
                        <div class="form-container">
                            <div class="form-btn">
                                <span onclick="login()">Login</span>
                                <span onclick="register()">Register</span>
                                <hr id="Indicator">
                            </div>
                            <form id="LoginForm" onsubmit="return btnLoginClick('<?php echo $prePage ?>')">
                                <input class="txtInput" type="text" placeholder="Enter the Email" id="emailLogin">
                                <input class="txtInput" type="password" placeholder="Enter the Password" id="passwordLogin">
                                <input type="checkbox" class="check-box" id="checkRemEmail"><span style="font-size: 12px; width: auto; font-weight: normal;">Remember Email</span>
                                <input type="submit" class="btn" value="Login">
                                <a href="">Forget Password</a>
                            </form>

                            <form id="RegForm" onsubmit="return btnRegisterClick()">
                                <input class="txtInput" type="text" placeholder="First Name" id="fName">
                                <input class="txtInput" type="text" placeholder="Last Name" id="lName">
                                <input class="txtInput" type="text" placeholder="Email" id="email">
                                <input class="txtInput" type="password" placeholder="Password" id="password">
                                <input class="txtInput" type="password" placeholder="Confirm Password" id="conPassword">
                                <input type="submit" class="btn" value="Register">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Toggle Form -->
    <script src="../account.js"></script>

</body>

</html>