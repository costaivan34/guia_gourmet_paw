
function validarDatos(nameSitio,descripcion,direccion,ubicacion,mail,telefono, Dia_Inicio,Dia_Fin , De_Inicio, Hasta_Fin ){
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  telefonoRegex = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
  passwordRegex =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
  if (direccion.length<0 ){
    mensaje="La direccion ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  
  if (nameSitio.length<0 ){
    mensaje="El nombre ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (descripcion.length<0 ){
    mensaje="La descripción ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (ubicacion.length<0){
    mensaje="La Ubicación ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  } 
  if (Dia_Inicio=="A" ||Dia_Fin=="A" ||De_Inicio=="A" || Hasta_Fin=="A" ){
    mensaje="El horario ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (!emailRegex.test(mail)) {
    mensaje="El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  
  return true;
}


function validarRegistro(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
      console.log(response)
			/*if(xmlHttpRequest.responseText == 1) {
        document.getElementById( 'regForm' ).scrollIntoView();
				const m = document.getElementById("messageBox");
				m.innerHTML = `<div class="alert alert-success" role="alert">
				Cuenta creada con exito. Bienvenido!</div>`; 
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
      //  setTimeout(function(){ window.location.replace("/"); }, 2500);
			} else {
        document.getElementById( 'regForm' ).scrollIntoView();
        const m = document.getElementById("messageBox");
        m.innerHTML = `<div class="alert alert-danger" role="alert"> Ocurrio un error en el servidor.
         Por favor, inténtalo de nuevo más tarde.</div>`; 
        document.getElementById( 'regForm' ).scrollIntoView();
        setTimeout(function(){ m.innerHTML = "" }, 2500);
			}*/
		}
	}

  nameSitio = document.getElementById('nameSitio').value;
  descripcion = document.getElementById('subject').value;

  direccion= document.getElementById('DireccionSitio').value;
  ubicacion= document.getElementById('UbicacionSitio').value;
  mail= document.getElementById('MailSitio').value;
  telefono= document.getElementById('TelefonoSitio').value;

  X = document.getElementById('Longitud').value;
  Y = document.getElementById('Latitud').value;

  Dia_Inicio = document.getElementById('Dia-Inicio').value;
  Dia_Fin = document.getElementById('Dia-Fin').value;
  De_Inicio = document.getElementById('De-Inicio').value;
  Hasta_Fin = document.getElementById('Hasta-Fin').value;
  Usuario =  document.getElementById('nombreUsuario').value;
  if (validarDatos(nameSitio,descripcion,direccion,ubicacion,mail,telefono,X,Y, Dia_Inicio,Dia_Fin , De_Inicio, Hasta_Fin )){
    oData = new FormData(document.forms.namedItem("regForm"));
    oData.append('username', 'Chris');
   for(let [name, value] of oData) {
      console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
    }
    xmlHttpRequest.open("POST","/resto/CreateResto",true);
    xmlHttpRequest.send(oData);
    event.preventDefault();
  }else{
    console.log("error form")
    const m = document.getElementById("messageBox");
    m.innerHTML = `<div class="alert alert-danger" role="alert">`+mensaje+`</div>`; 
    document.getElementById( 'regForm' ).scrollIntoView();
    setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
    //setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
  }

  
}

