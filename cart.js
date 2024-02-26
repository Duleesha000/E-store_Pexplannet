function onQuantityChange(itemId, quantity){
  var customerId = "C1"; //sessionStorage.customerId;
  if(customerId != "undefined" && customerId != ""){
  var xmlhttp = new XMLHttpRequest();   
  xmlhttp.open("POST", "changeCart.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "Success"){
          location.reload();
        }
      }
    };
    xmlhttp.send("itemId="+itemId+"&cId="+customerId+"&quantity="+quantity);
  }
}

function onItemRemove(itemId, itemName){
  if(confirm("Are you sure you want to remove  from Cart?\nClick Ok if Yes")){

  }
  var customerId = "C1"; //sessionStorage.customerId;
  if(customerId != "undefined" && customerId != ""){
  var xmlhttp = new XMLHttpRequest();   
  xmlhttp.open("POST", "changeCart.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "Success"){
          location.reload();
        }
      }
    };
    xmlhttp.send("itemId="+itemId+"&cId="+customerId);
  }
}