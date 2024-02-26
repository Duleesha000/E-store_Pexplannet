function checkAddresses(){
  var addressId = "";

  var address = document.getElementById('no').value +","+
  document.getElementById('apartment').value +","+
  document.getElementById('streetName').value+","+
  document.getElementById('townCity').value +","+
  document.getElementById('district').value +","+
  document.getElementById('province').value +","+
  document.getElementById('postalCodeZip').value ;
  var addresses = document.getElementById("addresses").options;
  for (var i=0; i<addresses.length; i++){
    if(addresses[i].text == address){
      addressId = addresses[i].value;
      break;
    }
  }
  return addressId;
}

function addressChanged(){
  getAddress(document.getElementById('addresses').value);
}

function getAddress(addressId){
  var xmlhttp = new XMLHttpRequest();   
  xmlhttp.open("GET", "getAddress.php?addressId="+addressId, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "Error"){
          document.getElementById('no').value = "";
          document.getElementById('apartment').value = "";
          document.getElementById('streetName').value = "";
          document.getElementById('townCity').value = "";
          document.getElementById('district').value = "select";
          document.getElementById('province').value = "select";
          document.getElementById('postalCodeZip').value = "";
        }
        else{
          var address = this.responseText.split('&');
          var i=0;
          document.getElementById('no').value = address[i++];
          document.getElementById('apartment').value = address[i++];
          document.getElementById('streetName').value = address[i++];
          document.getElementById('townCity').value = address[i++];
          document.getElementById('district').value = address[i++];
          document.getElementById('province').value = address[i++];
          document.getElementById('postalCodeZip').value = address[i++];
        }
      }
    };
    xmlhttp.send();
}

function checkout(){
  var xmlhttp = new XMLHttpRequest();   
  xmlhttp.open("POST", "placeOrder.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText == "Success"){
          alert("Order Placed Successfully!");
        }
        else{
          alert(this.responseText);
        }
      }
    }
  addressId = checkAddresses();
  // let customerId = document.getElementById('cId').value;
  let customerId = sessionStorage.customerId;
  let name = document.getElementById('fname').value+" "+document.getElementById('lname').value;
  let companyName = document.getElementById('companyName').value;
  let phone = document.getElementById('phone').value;
  let payType = document.getElementById('payType').value;
  var params = "cId="+customerId+"&name="+name+"&cn="+companyName+"&phn="+phone+"&payType="+payType;
  if(addressId !=""){
    params+="&addId="+addressId;
  }
  else{
    params+="&no="+document.getElementById('no').value;
    params+="&apartment="+document.getElementById('apartment').value;
    params+="&streetName="+document.getElementById('streetName').value;
    params+="&townCity="+document.getElementById('townCity').value;
    params+="&district="+document.getElementById('district').value;
    params+="&province="+document.getElementById('province').value;
    params+="&postalCodeZip="+document.getElementById('postalCodeZip').value;
  }
  xmlhttp.send(params);
  return false;
}