function guardarConsulta(){
  var xmlHttpRequest=new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange=function() {         
    if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      var pagina =( xmlHttpRequest.responseText );
      //console.log(pagina);
      const mensaje = document.getElementById("mensaje");
      mensaje.innerHTML = `<div class="alert alert-success" role="alert">
      Mensaje enviado con exito, pronto nos contactaremos con usted.Muchas gracias.
    </div>`; 
    //alert("Mensaje enviado con exito, pronto nos contactaremos con usted.Muchas gracias por tus comentarios!");
       document.getElementById("fname").value="";
       document.getElementById("aname").value="";
       document.getElementById("mail").value="";
       document.getElementById("subject").value="";
       setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
    }
    if (xmlHttpRequest.status==500){
      const mensaje = document.getElementById("mensaje");
      mensaje.innerHTML = `<div class="alert alert-danger" role="alert">
      Error!El mensaje no pudo ser procesado, por favor intentelo nuevamente
    </div>`;
      //alert("El mensaje no pudo ser procesado, por favor intentelo nuevamente dentro de unos minutos");
    }
  }
var nombre = document.getElementById("fname").value;
var apellido = document.getElementById("aname").value;
var mail = document.getElementById("mail").value;
var texto = document.getElementById("subject").value;
xmlHttpRequest.open("POST","sendConsulta",true);
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("nombre="+nombre+"&apellido="+apellido+"&mail="+mail+"&texto="+texto);
event.preventDefault();
}
