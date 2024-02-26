var LoginForm = document.getElementById("LoginForm");
var RegForm = document.getElementById("RegForm");
var Indicator = document.getElementById("Indicator");
function register() {
    RegForm.style.transform = "translatex(-300px)";
    LoginForm.style.transform = "translatex(-300px)";
    Indicator.style.transform = "translateX(100px)";

}
function login() {
    RegForm.style.transform = "translatex(0px)";
    LoginForm.style.transform = "translatex(0px)";
    Indicator.style.transform = "translate(0px)";

}

function onLoad(){
  if(localStorage.rememberEmail !== "undefined" && localStorage.rememberEmail !== ""){
    document.getElementById("emailLogin").value = localStorage.rememberEmail;
    document.getElementById('checkRemEmail').checked = true;
  }
}

function btnLoginClick(prePage){  
  var email= document.getElementById("emailLogin").value;
  var password= document.getElementById("passwordLogin").value;

  if (email == "") {
    alert("Please enter your email");
  }

  else if (!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
      alert("Please enter a valid email address");
  }

  else if (password == "") {
      alert("Please enter your password");
  }
  else{
    var xmlhttp = new XMLHttpRequest();   
    xmlhttp.open("POST", "login.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = this.responseText;
          if(response.includes("Success")){
            var cId = response.substring(8);
            if(Storage !== "undefined"){
              sessionStorage.customerId = cId;
            }
            if(document.getElementById('checkRemEmail').checked){
              localStorage.rememberEmail = email;
            }
            else localStorage.rememberEmail = "";
            window.location.replace(prePage);
          }
          else if(response == "IncorrectCredentials"){
            alert("Incorrect Email or Password.");
          }
          else{
            alert(response);
          }
        }
      };
      xmlhttp.send("email="+email+"&password="+password);
    }
    return false;
}

function btnRegisterClick(){
  var fName= document.getElementById("fName").value;
  var lName= document.getElementById("lName").value;
  var email= document.getElementById("email").value;
  var password= document.getElementById("password").value;
  var conPassword= document.getElementById("conPassword").value;
  
  if (fName === "") {
    alert("Please enter your first name");
    return false;
}

if (lName === "") {
    alert("Please enter your last name");
    return false;
}

else if (email === "") {
    alert("Please enter your email");
    return false;
}

else if (!email.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
    alert("Please enter a valid email address");
    return false;
}

else if (password === "") {
    alert("Please enter your password");
    return false;
}
else if (conPassword === "") {
    alert("Please confirm your password");
    } 
else if (password !== conPassword) {
    alert("Passwords do not match");
    }
else{
    var xmlhttp = new XMLHttpRequest();   
    xmlhttp.open("POST", "register.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          if(this.responseText == "Success"){
            alert("Successfully Registered");
          }
          else if(this.responseText == "UsedEmail"){
            alert("Email already exists. Use a different email.");
          }
          else{
            alert(this.responseText);
          }
        }
      };
      xmlhttp.send("fName="+fName+"&lName="+lName+"&email="+email+"&password="+password);
  }
    return false;
}