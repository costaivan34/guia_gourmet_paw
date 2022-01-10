function mostrar_mensaje(mensaje, contenedor) {
  document.getElementById(contenedor).textContent = mensaje
}

function validarDatos(e, id) {
  switch (e) {
    case "nameUser":
    X = document.getElementById("nameUser").value;
    if (X.length < 4) {
      document.getElementById("nameUser").classList.add("input-error");
      mostrar_mensaje("El usuario ingresado no es valido.","help-nameUser");
      return false;
    } else {
      document.getElementById("nameUser").classList.remove("input-error");
      document.getElementById("help-nameUser").textContent = ""
      mostrar_mensaje("","help-nameUser");
    }
break;
case "nombreUser":
  X = document.getElementById("nombreUser").value;
  if (X.length < 4) {
    document.getElementById("nombreUser").classList.add("input-error");
    mostrar_mensaje("El nombre ingresado no es valido.","help-nombreUser");
    return false;
  } else {
    document.getElementById("nombreUser").classList.remove("input-error");
    document.getElementById("help-nombreUser").textContent = ""
    mostrar_mensaje("","help-nombreUser");
  }
break;
case "apellidoUser":
    X = document.getElementById("apellidoUser").value;
    if (X.length < 4) {
      document.getElementById("apellidoUser").classList.add("input-error");
      mostrar_mensaje("El apellido ingresado no es valido.","help-apellidoUser");
      return false;
    } else {
      document.getElementById("apellidoUser").classList.remove("input-error");
      document.getElementById("help-apellidoUser").textContent = ""
      mostrar_mensaje("","help-apellidoUser");
    }
break;
  case "paisUser":
    X = document.getElementById("paisUser").value;
    if (X < 5) {
      document.getElementById("paisUser").classList.add("input-error");
      mostrar_mensaje("Debes ingresar el País.","help-paisUser");
      return false;
    } else {
      document.getElementById("paisUser").classList.remove("input-error");
      mostrar_mensaje("","help-paisUser");
    }
  break;
  case "mailUser":
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    Mail = document.getElementById('mailUser').value;
    if (!emailRegex.test(Mail)) {
      document.getElementById('mailUser').classList.add('input-error');
      mostrar_mensaje("El correo electrónico ingresado no es valido.","help-mailUser");
      return false
    } else {
      document.getElementById('mailUser').classList.remove('input-error');
      mostrar_mensaje("","help-mailUser");
    }
  break;
  case "telefonoUser":
    telefonoRegex = /^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$/;
    X = document.getElementById("telefonoUser").value
    if (!telefonoRegex.test(X)) {
      document.getElementById("telefonoUser").classList.add("input-error");
      mostrar_mensaje("El telefono ingresado no es correcto.","help-telefonoUser");
      return false;
    } else {
      document.getElementById("telefonoUser").classList.remove("input-error");
      mostrar_mensaje("","help-telefonoUser");
    }
break;

case "passwordNueva":
  passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/
  X = document.getElementById("passwordNueva").value
  if (!passwordRegex.test(X)) {
    document.getElementById("passwordNueva").classList.add("input-error");
    mostrar_mensaje("La contraseña ingresada no es valida.","help-passwordNueva");
    return false;
  } else {
    document.getElementById("passwordNueva").classList.remove("input-error");
    mostrar_mensaje("","help-passwordNueva");
  }
  case "passwordRepeat":
      passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/
      passwordNueva = document.getElementById('passwordNueva').value
      passwordRepeat = document.getElementById('passwordRepeat').value
      if ( !passwordRegex.test(passwordRepeat) ||!passwordRepeat === passwordNueva ) {
        mostrar_mensaje("Las Contraseñas ingresadas no coinciden.","help-passwordRepeat");
        document.getElementById('passwordNueva').classList.add('input-error')
        document.getElementById('passwordRepeat').classList.add('input-error')
        return false;
      } else {
        document.getElementById('passwordNueva').classList.remove('input-error')
        document.getElementById('passwordRepeat').classList.remove('input-error')
        mostrar_mensaje("","help-passwordRepeat");
      }
  break;


  case "archivosubido":
    X = document.getElementById("archivosubido");
  
    if (X.files.length == 0) {
      document.getElementById("archivosubido").classList.add("input-error");
      mostrar_mensaje("Debes subir al menos una imagen.","help-archivosubido");
      return false;
    } else {
      document.getElementById("archivosubido").classList.remove("input-error");
      mostrar_mensaje("","help-archivosubido");
    }
  break;
}
}

function validarRegistro() {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var response = xmlHttpRequest.responseText
      if (xmlHttpRequest.responseText == 1) {
        document.getElementById('contact-form').scrollIntoView()
        const m = document.getElementById('messageBox')
        m.innerHTML = `<div class="alert alert-success" role="alert">
				Cuenta creada con exito. Bienvenido!</div>`
        setTimeout(function () {
          mensaje.innerHTML = ''
        }, 2500)
        setTimeout(function () {
          window.location.replace('/')
        }, 2500)
      } else {
        document.getElementById('contact-form').scrollIntoView()
        const m = document.getElementById('messageBox')
        m.innerHTML = `<div class="alert alert-danger" role="alert"> Ocurrio un error en el servidor.
         Por favor, inténtalo de nuevo más tarde.</div>`
        document.getElementById('contact-form').scrollIntoView()
        setTimeout(function () {
          m.innerHTML = ''
        }, 2500)
      }
    }
  }

  if( validarDatos('nameUser') && validarDatos('nombreUser') && validarDatos('apellidoUser') 
  &&  validarDatos('mailUser') && validarDatos('paisUser') && validarDatos('telefonoUser')
   &&  validarDatos('passwordNueva') &&  validarDatos('passwordRepeat') &&  validarDatos('archivosubido')){
    oData = new FormData(document.forms.namedItem('formCuenta'))
  /*  for (let [name, value] of oData) {
      console.log(`${name} = ${value}`) // key1 = value1, luego key2 = value2
    }*/
    xmlHttpRequest.open('POST', '/user/CreateUser', true)
    xmlHttpRequest.send(oData)
    event.preventDefault()
  }else{
    console.log("error form")
    const m = document.getElementById("messageBox");
    m.innerHTML = `<div class="alert alert-danger" role="alert">` + 
    "El formulario presenta errores. Por favor, inténtalo de nuevo." + `</div>`;
    document.getElementById('regForm').scrollIntoView();
    setTimeout(function () { m.innerHTML = "" }, 2500);
  }

}
