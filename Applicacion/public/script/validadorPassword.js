window.addEventListener('DOMContentLoaded', function () {
  // Obtengo los inputs que quiero lanzar su validación al perder el foco
  var inputs = document.querySelectorAll('input');
  // Por cada input, chequeo su validez y hago acciones en consecuencia
  inputs.forEach(function(input) {
      input.addEventListener('blur', event => {
          //console.log(input.checkValidity());
          // checkValidity() lanza la validación y decide si el valor del input 
          //	es correcto o no.
          console.log(input.name)
            if (!input.checkValidity()) {
              console.log(`Valor invalido en el input ${input.name}`);
              document.getElementById(input.name).classList.add("input-error");
              //  document.getElementById(input.name).reportValidity();
              document.getElementById(`help-${input.name}`).textContent = input.validationMessage
              // console.log(input.validationMessage);
              // agregar clases css para que se resalte el error
            } else {
              console.log(`Valor CORRECTO en el input ${input.name}`);
              console.log(`input ${input.name}`);
              document.getElementById(input.name).classList.remove("input-error");
              document.getElementById(`help-${input.name}`).textContent = ""
              // agregar clases css para que se muestre valido 
              //  o al menos borrar las clases que marcan errores
            }
      });
  });
  document.getElementById('passwordAntigua').addEventListener('blur', event => {validarpassActual()});
  document.getElementById('passwordRepeat').addEventListener('blur', event => {validarpassword()});
 
  })
  

function validarpassActual() {
  passwordAntigua = document.getElementById('passwordAntigua')
  if (passwordAntigua.checkValidity()) {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      if(xmlHttpRequest.responseText == 1) {
      document.getElementById("passwordAntigua").classList.remove("input-error");
      document.getElementById(`help-passwordAntigua`).textContent = ""
    }else{
      console.log(`La contraseña ingresada no es válida`)
      document.getElementById("passwordAntigua").classList.add("input-error");
      document.getElementById(`help-passwordAntigua`).textContent = `La contraseña ingresada no es válida`
    }
  }
  } 
  var mail = document.getElementById("User-mail").value;
  var psw = document.getElementById("passwordAntigua").value;
  xmlHttpRequest.open("POST","/login",true);
  xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttpRequest.send("userName="+mail+"&password="+psw);
  event.preventDefault();
  } else {
    document.getElementById('passwordAntigua').classList.add("input-error");
    document.getElementById(`help-passwordAntigua`).textContent = "La contraseña ingresada no es válida"
  }
  
}

  
  function validarpassword() {
          passwordNueva = document.getElementById('passwordNueva').value
          passwordRepeat = document.getElementById('passwordRepeat').value
      if ( passwordRepeat != passwordNueva ) {
         //  console.log(`Valor invalido en el input passwordRepeat`);
          document.getElementById("passwordRepeat").classList.add("input-error");
          //  document.getElementById(input.name).reportValidity();
          document.getElementById(`help-passwordRepeat`).textContent = `Las contraseñas no coinciden`
      }else{
        console.log(`Valor valido en el input passwordRepeat`);
        document.getElementById("passwordRepeat").classList.remove("input-error");
        document.getElementById(`help-passwordRepeat`).textContent = ""
      }
    
  }
  
  