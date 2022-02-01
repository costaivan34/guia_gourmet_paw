
window.addEventListener('DOMContentLoaded', function () {

  // Obtengo los inputs que quiero lanzar su validación al perder el foco
  var inputs = document.querySelectorAll('input');
  var textarea = document.querySelectorAll('textarea');
  console.log(textarea)
  textarea.forEach(function(input) {
    input.addEventListener('blur', event => {
          if (!input.checkValidity()) {
            document.getElementById(input.name).classList.add("input-error");
            document.getElementById(`help-${input.name}`).textContent = input.validationMessage
            
          } else {
            document.getElementById(input.name).classList.remove("input-error");
            document.getElementById(`help-${input.name}`).textContent = ""
    
          }
    });
  });

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
  
 
  })