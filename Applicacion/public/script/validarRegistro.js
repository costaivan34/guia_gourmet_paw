
function validarDatos(nameUser,nombreUser,apellidoUser,mailUser,paisUser,telefonoUser,passwordNueva,passwordRepeat, archivosubido){
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  telefonoRegex = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
  passwordRegex =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

  if (nameUser.length<0 || nombreUser.length<0 || apellidoUser.length<0){
    mensaje="El nombre de usuario o nombre y apellido ingresados no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (!emailRegex.test(mailUser)) {
    mensaje="El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }

  if (!passwordRepeat===passwordNueva) {
    mensaje="Las contraseñas ingresadas no coinciden. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (!passwordRegex.test(passwordRepeat)) {
    mensaje="La contraseña ingresada no cumple con los requisitos. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }   
  return true;
}


function validarRegistro(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
			if(xmlHttpRequest.responseText == 1) {
        document.getElementById( 'info' ).scrollIntoView();
				const m = document.getElementById("messageBox");
				m.innerHTML = `<div class="alert alert-success" role="alert">
				Cuenta creada con exito. Bienvenido!</div>`; 
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
        setTimeout(function(){ window.location.replace("/"); }, 2500);
			} else {
        document.getElementById( 'info' ).scrollIntoView();
        const m = document.getElementById("messageBox");
        m.innerHTML = `<div class="alert alert-danger" role="alert"> Ocurrio un error en el servidor.
         Por favor, inténtalo de nuevo más tarde.</div>`; 
        document.getElementById( 'info' ).scrollIntoView();
        setTimeout(function(){ m.innerHTML = "" }, 2500);
			}
		}
	}

  nameUser = document.getElementById('nameUser').value;
  nombreUser = document.getElementById('nombreUser').value;
  apellidoUser = document.getElementById('apellidoUser').value;
  mailUser = document.getElementById('mailUser').value;
  paisUser = document.getElementById('paisUser').value;
  telefonoUser = document.getElementById('telefonoUser').value;
  console.log(telefonoUser)
  archivosubido = document.getElementById('archivosubido').value;
  passwordNueva = document.getElementById('passwordNueva').value;
  passwordRepeat =document.getElementById('passwordRepeat').value;
  if (validarDatos(nameUser,nombreUser,apellidoUser,mailUser,paisUser,telefonoUser,passwordNueva,passwordRepeat, archivosubido)){
    oData = new FormData(document.forms.namedItem("formCuenta"));
   for(let [name, value] of oData) {
      console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
    }
    xmlHttpRequest.open("POST","/user/CreateUser",true);
    xmlHttpRequest.send(oData);
    event.preventDefault();
  }else{
    console.log("error form")
    const m = document.getElementById("messageBox");
    m.innerHTML = `<div class="alert alert-danger" role="alert">`+mensaje+`</div>`; 
    document.getElementById( 'info' ).scrollIntoView();
    setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
    //setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
  }

  
}


