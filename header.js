var currentPage = window.location.href.split("?")[0];
var MenuItems = document.getElementById("MenuItems");
MenuItems.style.maxHeight = "0px";
function menutoggle() {
    if (MenuItems.style.maxHeight == "0px") {
        MenuItems.style.maxHeight = "200px"
    }
    else {
        MenuItems.style.maxHeight = "0px"
    }
}

function btnAccountClick(){
    var customerId = sessionStorage.customerId;
    if(customerId=="" && !currentPage.includes("account.php")){
      window.location.href = "account.php?prePage="+currentPage;
    }
    else if(customerId!=""){
      if(confirm("Are you sure your want to log out?\nIf Yes press Ok")){
        window.location.href = currentPage;
        sessionStorage.customerId = "";
      }
      
    }
  }

  function onLoad(){
    var customerId = sessionStorage.customerId;
    if(customerId!=="udefined" && customerId!==""){
      document.getElementById('headerLoginBtn').innerHTML="Log Out";
    }
  }
  
  function btnCartClick(){
    var customerId = sessionStorage.customerId;
    if(customerId==""){
      window.location.href = "account.php?prePage="+currentPage;
    }
    else{
      location.replace('cart.php?cId='+customerId);      
    }
  }