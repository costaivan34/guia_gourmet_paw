document.addEventListener('DOMContentLoaded', function () {
  document
    .getElementById('formCuenta')
    .addEventListener('submit', validarFormulario)
})

function update() {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var response = xmlHttpRequest.responseText
      console.log(response)
      if (xmlHttpRequest.responseText == 1) {
        alert('Los datos han sido actualizados con exito.')
        window.location.replace('/dashboard/account')
      } else {
        alert(
          'Los datos ingresados no son validos. Por favor, revisa los datos e inténtalo de nuevo.',
        )
        window.location.replace('/dashboard/account')
      }
    }
  }
  xmlHttpRequest.open('POST', '/actualizarPerfil', true)
  xmlHttpRequest.setRequestHeader(
    'Content-type',
    'application/x-www-form-urlencoded',
  )
  xmlHttpRequest.send(
    'mailUser=' +
    document.getElementById('User-mail').textContent +
      '&nombreUser=' +
      document.getElementById('nombreUser').value +
      '&apellidoUser=' +
      document.getElementById('apellidoUser').value +
      '&paisUser=' +
      document.getElementById('ubicacionUser').value +
      '&telefonoUser=' +
      document.getElementById('telefonoUser').value,
  )
  event.preventDefault()
}

function validarDatos(
  nombreUser,
  apellidoUser,
  mailUser,
  paisUser,
  telefonoUser,
) {
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i

  if (nombreUser.length < 0 || apellidoUser.length < 0) {
    mensaje =
      'El nombre y apellido ingresados no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  if (!emailRegex.test(mailUser)) {
    mensaje =
      'El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  return true
}

function validarFormulario(evento) {
  evento.preventDefault()
  var mail = document.getElementById('User-mail').textContent
  var nombre = document.getElementById('nombreUser').value
  var apellido = document.getElementById('apellidoUser').value
  var ubicacion =  document.getElementById('ubicacionUser').value
  var telefono = document.getElementById('telefonoUser').value

  if (validarDatos(nombre, apellido, mail, ubicacion, telefono)) {
    update()
  } else {
    alert(mensaje)
    return
  }
}
