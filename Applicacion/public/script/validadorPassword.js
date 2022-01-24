
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
  document.getElementById('passwordRepeat').addEventListener('blur', event => {validarpassword()});
  document.getElementById('paisUser').addEventListener('blur', event => {validarpais()});
  document.getElementById('mailUser').addEventListener('blur', event => {validarmail()});
  
  document.getElementById("archivosubido").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
   
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL( document.getElementById("archivosubido").files[0]);
  
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function(){
      let preview = document.getElementById('preview'),
              image = document.createElement('img');
      image.src = reader.result;
      preview.innerHTML = '';
      preview.append(image);
    };
  }
  })
  
  
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
  
  