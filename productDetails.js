var currentPage = window.location.href.split("&")[0];
var customerId="";
var itemId="";
var quantity=0;
var avaiQuant = 0;
function btnAddToCartClick(){

  // customerId= document.getElementById("cId").value;
  customerId = sessionStorage.customerId;
  itemId= document.getElementById("itemId").value;
  quantity = parseInt(document.getElementById("txtQuantity").value);
  avaiQuant = parseInt(document.getElementById("avaiQuant").value);

  if(customerId==""){
    window.location.href = "signup.php?prePage="+currentPage;
  }
  else{
    if(avaiQuant>quantity && quantity>0){
      runFunction(false);
    }
    else{
      alert("Insufficient stock!!!\nWe have only "+avaiQuant+" items available");
    }
  }
  
}
function runFunction(update){
  var xmlhttp = new XMLHttpRequest();   
  xmlhttp.open("POST", "addToCart.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText == "Success"){
        alert("Item Successfully added");
      }
      else if(this.responseText == "Already Exists"){
        if(confirm('Product already exists in the cart.\nPress Ok to add '+quantity+' item to it.')){
          runFunction(true);
        }
      }
      else if(this.responseText == "Error"){
        alert("There was an error when adding the item.");
      }
      else{
        alert(this.responseText);
      }
    }
  };
  if(update) xmlhttp.send("cId="+customerId+"&itemId="+itemId+"&quantity="+quantity+"&update=true");
  else xmlhttp.send("cId="+customerId+"&itemId="+itemId+"&quantity="+quantity);
  
}