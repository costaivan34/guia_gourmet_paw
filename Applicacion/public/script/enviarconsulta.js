
function validarDatos(nombre,apellido,mail,texto){
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  if (nombre.length<=0 || apellido.length<=0 ){
    mensaje="El nombre y apellido ingresados no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (texto.length<=0){
    mensaje="El mensaje ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (!emailRegex.test(mail)) {
    mensaje="El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  return true;
}

function guardarConsulta(){
  var xmlHttpRequest=new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange=function() {         
    if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      var response = xmlHttpRequest.responseText;
			if(xmlHttpRequest.responseText == 1) {
          //console.log(pagina);
          const m = document.getElementById("mensaje");
          m.innerHTML = `<div class="alert alert-success" role="alert">
          Mensaje enviado con exito, pronto nos contactaremos con usted.Muchas gracias.</div>`; 
          //alert("Mensaje enviado con exito, pronto nos contactaremos con usted.Muchas gracias por tus comentarios!");
          document.getElementById("fname").value="";
          document.getElementById("aname").value="";
          document.getElementById("mail").value="";
          document.getElementById("subject").value="";
          document.getElementById( 'topof' ).scrollIntoView();
          setTimeout(function(){ m.innerHTML = "" }, 2500);
      }else{
          const m = document.getElementById("mensaje");
          m.innerHTML = `<div class="alert alert-danger" role="alert">
          El mensaje no pudo ser procesado, por favor intentelo nuevamente </div>`;
          document.getElementById( 'topof' ).scrollIntoView();
          setTimeout(function(){ m.innerHTML = "" }, 2500);
          //alert("El mensaje no pudo ser procesado, por favor intentelo nuevamente dentro de unos minutos");
      }
  }
}
var nombre = document.getElementById("fname").value;
var apellido = document.getElementById("aname").value;
var mail = document.getElementById("mail").value;
var texto = document.getElementById("subject").value;

if (validarDatos(nombre,apellido,mail,texto)){
  xmlHttpRequest.open("POST","sendConsulta",true);
  xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttpRequest.send("nombre="+nombre+"&apellido="+apellido+"&mail="+mail+"&texto="+texto);
  event.preventDefault();
}else{
  console.log("error form")
  const m = document.getElementById("mensaje");
  m.innerHTML = `<div class="alert alert-danger" role="alert">`+mensaje+`</div>`; 
  document.getElementById( 'topof' ).scrollIntoView();
  setTimeout(function(){ m.innerHTML = "" }, 2500);

}
}
