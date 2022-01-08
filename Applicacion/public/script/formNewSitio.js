function validarDato(nameSitio,descripcion,direccion,localidad,provincia,mail,telefono,X,Y, Dia_Inicio,Dia_Fin , De_Inicio, Hasta_Fin ){

  if (direccion.length<0 ){
    mensaje="La direccion ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  
  if (X<(-90) || X>(90) || Y<(-180) || Y>(180)){
    mensaje="Las coordenadas ingresadas no son validas. Por favor, revisa los datos e inténtalo de nuevo."
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
  if (localidad.length<0){
    mensaje="La localidad ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  } 
  if (provincia.length<0){
    mensaje="La provincia ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  } 
  if (Dia_Inicio=="0" || Dia_Fin=="0" || De_Inicio=="-1" || Hasta_Fin=="-1" || Dia_Inicio>Dia_Fin || De_Inicio>Hasta_Fin){
    mensaje="El horario ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (!emailRegex.test(mail)) {
    mensaje="El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  
  return true;
}


  id="nameSitio"
  id="subject"
  id="DireccionSitio"
  id="LocalidadSitio"
  id="MailSitio"
  id="TelefonoSitio"
  id="Longitud"
  id="Latitud"

  function buscarcoord(){
    
     var xmlHttpRequest=new XMLHttpRequest();
     xmlHttpRequest.onreadystatechange=function() {
       if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
         var respuesta = JSON.parse(  xmlHttpRequest.responseText );
     console.log(respuesta)
     document.getElementById("Longitud").value = 111
     document.getElementById("Latitud").value = 111
     } else{
       console.log("33")
     }
    
   }
   accessToken =
   'pk.eyJ1IjoiY29zdGFpdmFuMzQiLCJhIjoiY2treDI1MDk3MDI2cjJ2bXFydTdnMnBmYSJ9.tYdWtyp9KZzPcZL1VowmZg'
   direccion = document.getElementById("DireccionSitio").value
   localidad = document.getElementById("LocalidadSitio").value
   provincia = document.getElementById("ProvinciaSitio").value
   console.log("33")
   xmlHttpRequest.open("GET","https://api.mapbox.com/geocoding/v5/mapbox.places/"+ encodeURIComponent(direccion)+"%20"+ encodeURIComponent(localidad) +"%20"+encodeURIComponent(provincia)+".json?limit=1&access_token="+accessToken+"",true);
   xmlHttpRequest.send();
   event.preventDefault(); 

   }

function validarDatos(e){
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
  telefonoRegex = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
  passwordRegex =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

    console.log("El elemento selecionado ha sido " +  e);
    if (e="Longitud"){
      X = document.getElementById("Latitud").value
      if ( X <(-180) || X >(180)){
        mensaje="Las coordenadas ingresadas no son validas."
      }
    }
    if (e="Latitud"){
      X = document.getElementById("Latitud").value
      if ( X <(-90) || X >(90)){
        mensaje="Las coordenadas ingresadas no son validas."
      }
    }
    if (e="nameSitio"){
      X = document.getElementById("MailSitio").value
      if (X<(-90) || X>(90)){
        mensaje="Las coordenadas ingresadas no son validas."
       alert(mensaje)
      }
    }
    if (e="subject"){
      X = document.getElementById("MailSitio").value
      if (X<(-90) || X>(90)){
        mensaje="Las coordenadas ingresadas no son validas."
       alert(mensaje)
      }
    } if (e="DireccionSitio"){
      X = document.getElementById("MailSitio").value
      if (X<(-90) || X>(90)){
        mensaje="Las coordenadas ingresadas no son validas."
       alert(mensaje)
      }
    } if (e="LocalidadSitio"){
      X = document.getElementById("MailSitio").value
      if (X<(-90) || X>(90)){
        mensaje="Las coordenadas ingresadas no son validas."
       alert(mensaje)
      }
    }

  if (e="TelefonoSitio"){
    Telefono = document.getElementById("MailSitio").value
    if (!telefonoRegex.test(Telefono)){
      mensaje="Las coordenadas ingresadas no son validas."
     alert(mensaje)
    }
  }
   if (e="MailSitio"){
    Mail = document.getElementById("MailSitio").value 
    if (!emailRegex.test(Mail)){
      mensaje="Las coordenadas ingresadas no son validas."
     alert(mensaje)
    }
  }
    alert(mensaje)
}




function validarRegistro(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
     console.log("RESPEUSTA DEL SERVER:"+response)
			if(response == 1) {
        document.getElementById( 'regForm' ).scrollIntoView();
				const m = document.getElementById("messageBox");
				m.innerHTML = `<div class="alert alert-success" role="alert">
				Sitio registrado con exito.</div>`; 
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
        setTimeout(function(){ window.location.replace("/dashboard/sitios"); }, 2500);
			} else {
        document.getElementById( 'regForm' ).scrollIntoView();
        const m = document.getElementById("messageBox");
        m.innerHTML = `<div class="alert alert-danger" role="alert"> Ocurrio un error en el servidor.
         Por favor, inténtalo de nuevo más tarde.</div>`; 
        document.getElementById( 'regForm' ).scrollIntoView();
        setTimeout(function(){ m.innerHTML = "" }, 2500);
			}
		}
	}

  nameSitio = document.getElementById('nameSitio').value;
  descripcion = document.getElementById('subject').value;

  direccion= document.getElementById('DireccionSitio').value;
  localidad= document.getElementById('LocalidadSitio').value;
  provincia= document.getElementById('ProvinciaSitio').value;
  mail= document.getElementById('MailSitio').value;
  telefono= document.getElementById('TelefonoSitio').value;

  X = document.getElementById('Longitud').value;
  Y = document.getElementById('Latitud').value;

  Dia_Inicio = document.getElementById('Dia-Inicio').value;
  Dia_Fin = document.getElementById('Dia-Fin').value;
  De_Inicio = document.getElementById('De-Inicio').value;
  Hasta_Fin = document.getElementById('Hasta-Fin').value;
  Usuario =  document.getElementById('nombreUsuario').textContent;
  if (validarDatos(nameSitio,descripcion,direccion,localidad,provincia,mail,telefono,X,Y, Dia_Inicio,Dia_Fin , De_Inicio, Hasta_Fin )){
    oData = new FormData(document.forms.namedItem("regForm"));
    oData.append('username', Usuario);
  /* for(let [name, value] of oData) {
      console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
    }*/
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


