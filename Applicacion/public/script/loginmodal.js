
function openLoginModal() {
  document.getElementById('id01').style.display='block';
}

function closeLoginModal() {
  document.getElementById('id01').style.display='none';
}

function callLogin(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
			console.log(response);
			if(xmlHttpRequest.responseText == 1) {
				const mensaje = document.getElementById("LoginMessageBox");
				mensaje.innerHTML = `<div class="alert alert-success" role="alert">
				Bienvenido!</div>`; 
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);

				window.location.replace("/dashboard/account");
			} else {
				const mensaje = document.getElementById("LoginMessageBox");
      	mensaje.innerHTML = `<div class="alert alert-danger" role="alert">
      	El nombre de usuario y la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.
    		</div>`;
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
			}
		}
	}
var mail = document.getElementById("userName").value;
var psw = document.getElementById("password").value;

xmlHttpRequest.open("POST","/login",true);
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("userName="+mail+"&password="+psw);
event.preventDefault();
}


function closeSession(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
		
				window.location.replace("/inicio");
		
		}
	}

xmlHttpRequest.open("GET","logout",true);
	xmlHttpRequest.send();
	event.preventDefault();
	}

/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
	var x = document.getElementById("myTopnav");
	if (x.className === "topnav") {
	  x.className += " responsive";
	} else {
	  x.className = "topnav";
	}
  }