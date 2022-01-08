function validarDato(
  nameUser,
  nombreUser,
  apellidoUser,
  mailUser,
  paisUser,
  telefonoUser,
  passwordNueva,
  passwordRepeat,
  archivosubido,
) {
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
  passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/

  if (nameUser.length < 0 || nombreUser.length < 0 || apellidoUser.length < 0) {
    mensaje =
      'El nombre de usuario o nombre y apellido ingresados no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  if (!emailRegex.test(mailUser)) {
    mensaje =
      'El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }

  if (!passwordRepeat === passwordNueva) {
    mensaje =
      'Las contraseñas ingresadas no coinciden. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  if (!passwordRegex.test(passwordRepeat)) {
    mensaje =
      'La contraseña ingresada no cumple con los requisitos. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  return true
}

function validarDatos(e) {
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
  telefonoRegex = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/
  passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/
  X = document.getElementById('subject').value

  if ((e = 'nameUser')) {
    nameUser = document.getElementById('nameUser').value
    if (nameUser.length < 4) {
      mensaje = 'El usuario ingresado no es valido.'
      document.getElementById('nameUser').classList.add('input-error')
      return false
    } else {
      document.getElementById('nameUser').classList.remove('input-error')
    }
  }
  if ((e = 'nombreUser')) {
    if (apellidoUser.length < 4) {
      mensaje = 'El nombre ingresado no es valido.'
    document.getElementById('nombreUser').classList.add('input-error')
    return false
  } else {
    document.getElementById('nombreUser').classList.remove('input-error')
  }
  
  }
  if ((e = 'apellidoUser')) {
    apellidoUser = document.getElementById('apellidoUser').value
    if (apellidoUser.length < 4) {
        mensaje = 'El apellido ingresado no es valido.'
      document.getElementById('apellidoUser').classList.add('input-error')
      return false
    } else {
      document.getElementById('apellidoUser').classList.remove('input-error')
    }
  }
  if ((e = 'mailUser')) {
    Mail = document.getElementById('mailUser').value
    if (!emailRegex.test(Mail)) {
      mensaje = 'El correo electrónico ingresado no es valido.'
      document.getElementById('mailUser').classList.add('input-error')
      return false
    } else {
      document.getElementById('mailUser').classList.remove('input-error')
    }
  }

  if ((e = 'telefonoUser')) {
    telefono = document.getElementById('telefonoUser').value
    if (!telefonoRegex.test(telefono)) {
      mensaje = 'El telefono ingresado no es valido.'
      document.getElementById('telefonoUser').classList.add('input-error')
      return false
    } else {
      document.getElementById('telefonoUser').classList.remove('input-error')
    }
  }

  if ((e = 'passwordNueva')) {
    passwordNueva = document.getElementById('passwordNueva').value
    if (!passwordRegex.test(passwordNueva)) {
      mensaje = 'La contraseña ingresada no es valida.'
      document.getElementById('passwordNueva').classList.add('input-error')
      return false
    } else {
      document.getElementById('passwordNueva').classList.remove('input-error')
    }
  }
  if ((e = 'passwordRepeat')) {
    passwordNueva = document.getElementById('passwordNueva').value
    passwordRepeat = document.getElementById('passwordRepeat').value
    if ( !passwordRegex.test(passwordRepeat) ||!passwordRepeat === passwordNueva ) {
      mensaje = 'Las Contraseñas ingresadas no coinciden.'
      document.getElementById('passwordNueva').classList.add('input-error')
      document.getElementById('passwordRepeat').classList.add('input-error')
      return false
    } else {
      document.getElementById('passwordRepeat').classList.remove('input-error')
      document.getElementById('passwordNueva').classList.remove('input-error')
    }
  }
  if ((e = 'paisUser')) {
    paisUser = document.getElementById('paisUser').value
    console.log(paisUser)
    if (paisUser.length < 4) {
      mensaje = 'El usuario ingresado no es valido.'
      document.getElementById('nameUser').classList.add('input-error')
      return false
    } else {
      document.getElementById('nameUser').classList.remove('input-error')
    }

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
   &&  validarDatos('passwordNueva') &&  validarDatos('passwordRepeat')){
    oData = new FormData(document.forms.namedItem('formCuenta'))
  /*  for (let [name, value] of oData) {
      console.log(`${name} = ${value}`) // key1 = value1, luego key2 = value2
    }*/
    xmlHttpRequest.open('POST', '/user/CreateUser', true)
    xmlHttpRequest.send(oData)
    event.preventDefault()
  }else{
    const m = document.getElementById('messageBox')
    m.innerHTML =
      `<div class="alert alert-danger" role="alert">` + mensaje + `</div>`
    document.getElementById('contact-form').scrollIntoView()
    setTimeout(function () {
      mensaje.innerHTML = ''
    }, 2500)
  }

}
