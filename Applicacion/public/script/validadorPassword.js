document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("formPassword").addEventListener('submit', validarFormulario); 
});


function update(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
			console.log(response);
			if(xmlHttpRequest.responseText == 1) {
        alert('Los datos han sido actualizados con exito.');
        document.getElementById("passwordAntigua").value ="";
        document.getElementById("passwordNueva").value ="";
        document.getElementById("passwordRepeat").value ="";
			} else {
        alert('El nombre de usuario y la contraseña que ingresaste no coinciden con nuestros registros. Por favor, revisa e inténtalo de nuevo.');
				
			}
		}
	}
var mail = document.getElementById("User-mail").textContent;
var pswOLD = document.getElementById("passwordAntigua").value;
var psw = document.getElementById("passwordNueva").value;
console.log(mail);
console.log(psw);
xmlHttpRequest.open("POST","/cambioPassword",true);
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("userName="+mail+"&passwordAntigua="+pswOLD+"&passwordNueva="+psw);
event.preventDefault();
}


function validarFormulario(evento) {
  evento.preventDefault();
  var passwordAntigua = document.getElementById('passwordAntigua').value;
  if(passwordAntigua.length == 0) {
    alert('Debes escribir tu contraseña actual');
    return;
  }
  var passwordNueva = document.getElementById('passwordNueva').value;
  var passwordRepeat = document.getElementById('passwordRepeat').value;
  if (passwordNueva==passwordRepeat) {
    if (passwordNueva.length< 8) {
      alert('Las contraseñas deben contener al menos 8 caracteres');
      return;
    }else{
      update();
    }
  }else{
    alert('Las contraseñas no coinciden');
    return;
  }
  
}