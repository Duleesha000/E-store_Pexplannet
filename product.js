function searchProduct(brandId, categoryId, searchText){
  var xmlhttp = new XMLHttpRequest();   
  xmlhttp.open("GET", "searchProducts.php?brandId="+brandId+"&categoryId="+categoryId+"&searchText="+searchText, true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText.includes("Success")){
          var content = this.responseText.split("/|")[1];
          document.getElementById('itemList').innerHTML = content;
        }
        else{
          alert(this.responseText);
        }
      }
    };
    xmlhttp.send();
}

function searchClick(){
  searchProduct(document.getElementById('brandSelect').value, document.getElementById('categorySelect').value, document.getElementById('searchTxt').value);
}