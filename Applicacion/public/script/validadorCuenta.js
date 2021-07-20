document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("formCuenta").addEventListener('submit', validarFormulario); 
});


function update(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
			console.log(response);
			if(xmlHttpRequest.responseText == 1) {
        alert('Los datos han sido actualizados con exito.');
        window.location.replace("dashboard/account");
			} else {
        alert('Los datos ingresados no son validos. Por favor, revisa los datos e inténtalo de nuevo.');
				window.location.replace("dashboard/account");
			}
		}
	}
var mail = document.getElementById("User-mail").textContent;
var nombre = document.getElementById("nombreUser").value;
var apellido = document.getElementById("apellidoUser").value;
var ubicacion = document.getElementById("paisUser").value;
var telefono = document.getElementById("telefonoUser").value;
console.log(mail);
xmlHttpRequest.open("POST","/actualizarPerfil",true);
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("mailUser="+mail+"&nombreUser="+nombre
+"&apellidoUser="+apellido+"&paisUser="+ubicacion+"&telefonoUser="+telefono);
event.preventDefault();
}


function validarFormulario(evento) {
  evento.preventDefault();
  /*var passwordAntigua = document.getElementById('passwordAntigua').value;
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
  }*/
  update();
}