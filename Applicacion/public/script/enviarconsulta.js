function mostrar_mensaje(mensaje, contenedor) {
  document.getElementById(contenedor).textContent = mensaje
}

function validarDatos(e, id) {
  switch (e) {

case "fname":
  X = document.getElementById("fname").value;
  if (X.length < 4) {
    document.getElementById("fname").classList.add("input-error");
    mostrar_mensaje("El nombre ingresado no es valido.","help-fname");
    return false;
  } else {
    document.getElementById("fname").classList.remove("input-error");
    document.getElementById("help-fname").textContent = ""
    mostrar_mensaje("","help-fname");
  }
break;
case "aname":
    X = document.getElementById("aname").value;
    if (X.length < 4) {
      document.getElementById("aname").classList.add("input-error");
      mostrar_mensaje("El apellido ingresado no es valido.","help-aname");
      return false;
    } else {
      document.getElementById("aname").classList.remove("input-error");
      document.getElementById("help-aname").textContent = ""
      mostrar_mensaje("","help-aname");
    }
break;
  case "mail":
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    Mail = document.getElementById('mail').value;
    if (!emailRegex.test(Mail)) {
      document.getElementById('mail').classList.add('input-error');
      mostrar_mensaje("El correo electrónico ingresado no es valido.","help-mail");
      return false
    } else {
      document.getElementById('mail').classList.remove('input-error');
      mostrar_mensaje("","help-mail");
    }
  break;
  case "subject":
    X = document.getElementById("subject").value;
    if (X.length < 40) {
      document.getElementById("subject").classList.add("input-error");
      mostrar_mensaje("Debes escribir algo en la descripcion.","help-subject");
      return false;
    } else {
      document.getElementById("subject").classList.remove("input-error");
      mostrar_mensaje("","help-subject");
    }
break;
default:
  return true;
}
}


function guardarConsulta() {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var response = xmlHttpRequest.responseText
      if (xmlHttpRequest.responseText == 1) {
        //console.log(pagina);
        const m = document.getElementById('messageBox')
        m.innerHTML = `<div class="alert alert-success" role="alert">
          Mensaje enviado con exito, pronto nos contactaremos con usted.Muchas gracias.</div>`
        //alert("Mensaje enviado con exito, pronto nos contactaremos con usted.Muchas gracias por tus comentarios!");
        document.getElementById('fname').value = ''
        document.getElementById('aname').value = ''
        document.getElementById('mail').value = ''
        document.getElementById('subject').value = ''
        document.getElementById('messageBox').scrollIntoView()
        setTimeout(function () {
          m.innerHTML = ''
        }, 2500)
      } else {
        const m = document.getElementById('messageBox')
        m.innerHTML = `<div class="alert alert-danger" role="alert">
          El mensaje no pudo ser procesado, por favor intentelo nuevamente </div>`
        document.getElementById('messageBox').scrollIntoView()
        setTimeout(function () {
          m.innerHTML = ''
        }, 2500)
        //alert("El mensaje no pudo ser procesado, por favor intentelo nuevamente dentro de unos minutos");
      }
    }
  }
  if(validarDatos('fname') && validarDatos('aname') &&  validarDatos('mail') && validarDatos('paisUser') ){
  var nombre = document.getElementById('fname').value
  var apellido = document.getElementById('aname').value
  var mail = document.getElementById('mail').value
  var texto = document.getElementById('subject').value
    xmlHttpRequest.send(
      'nombre=' +
        nombre +
        '&apellido=' +
        apellido +
        '&mail=' +
        mail +
        '&texto=' +
        texto,
    )
    event.preventDefault()
  } else {
    console.log("error form")
    const m = document.getElementById("messageBox");
    m.innerHTML = `<div class="alert alert-danger" role="alert">` + 
    "El formulario presenta errores. Por favor, inténtalo de nuevo." + `</div>`;
    document.getElementById('messageBox').scrollIntoView();
    setTimeout(function () { m.innerHTML = "" }, 2500);
  }
}
