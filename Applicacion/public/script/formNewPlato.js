
function validarDatos(e) {
  if (e="namePlato"){
    X = document.getElementById("namePlato").value
    if ( X.length<1){
      mensaje="Debes escribir algo en el nombre."
      document.getElementById("namePlato").classList.add("input-error")
      return false;
    }else{
      document.getElementById("namePlato").classList.remove("input-error")
    }
  }
  if (e="subject"){
    X = document.getElementById("subject").value
    if ( X.length<1){
      document.getElementById("subject").classList.add("input-error")
      mensaje="Debes escribir algo en la descripcion."
      return false;
    }else{
      document.getElementById("subject").classList.remove("input-error")
    }
  }

  if (e="InformaciónPeso"){
    X = document.getElementById("InformaciónPeso").value
    if ( X<1){
      mensaje="El Peso debe ser mayor a cero."
      document.getElementById("InformaciónPeso").classList.add("input-error")
      return false;
    }else{
      document.getElementById("InformaciónPeso").classList.remove("input-error")
    }
  }
  if (e="InformaciónEnergia"){
    X = document.getElementById("InformaciónEnergia").value
    if ( X<1){
      mensaje="La Cantidad de Energia debe ser mayor a cero."
      document.getElementById("InformaciónEnergia").classList.add("input-error")
      return false;
    }else{
      document.getElementById("InformaciónEnergia").classList.remove("input-error")
    }
  }
  if (e="InformaciónCarbohidratos"){
    X = document.getElementById("InformaciónCarbohidratos").value
    if ( X<1){
      mensaje="La Cantidad de Carbohidratos debe ser mayor a cero."
      document.getElementById("InformaciónCarbohidratos").classList.add("input-error")
      return false;
    }else{
      document.getElementById("InformaciónCarbohidratos").classList.remove("input-error")
    }
  }
  if (e="InformaciónProteina"){
    X = document.getElementById("InformaciónProteina").value
    if ( X<1){
      mensaje="La Cantidad de Proteina debe ser mayor a cero."
      document.getElementById("InformaciónProteina").classList.add("input-error")
      return false;
    }else{
      document.getElementById("InformaciónProteina").classList.remove("input-error")
    }
  }
  if (e="InformaciónGrasas"){
    X = document.getElementById("InformaciónGrasas").value
    if ( X<1){
      mensaje="La Cantidad de Grasas Totales debe ser mayor a cero."
      document.getElementById("InformaciónGrasas").classList.add("input-error")
      return false;
    }else{
      document.getElementById("InformaciónGrasas").classList.remove("input-error")
    }
  }
  if (e="InformaciónSodio"){
    X = document.getElementById("InformaciónSodio").value
    if ( X<1){
      mensaje="La cantidad de Sodio debe ser mayor a cero."
      document.getElementById("InformaciónSodio").classList.add("input-error")
      return false;
    }else{
      document.getElementById("InformaciónSodio").classList.remove("input-error")
    }
  }
  if (e="archivosubido"){
    X = document.getElementById("archivosubido")
    if (X.files.length < 1) {
      mensaje="Debes subir al menos una imagen."
      document.getElementById("archivosubido").classList.add("input-error")
      return false;
    }else{
      document.getElementById("archivosubido").classList.remove("input-error")
    }
  }
}

function validarRegistro(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
    console.log("RESPEUSTA DEL SERVER:"+response)
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
     console.log("RESPEWUSTA DEL SERVER:"+response)
			if(xmlHttpRequest.responseText == 1) {
        document.getElementById( 'regForm' ).scrollIntoView();
				const m = document.getElementById("messageBox");
				m.innerHTML = `<div class="alert alert-success" role="alert">
				Plato registrado con exito.</div>`; 
				setTimeout(function(){ m.innerHTML = "" }, 2500);
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

  if( validarDatos('namePlato') && validarDatos('subject') && validarDatos('InformaciónPeso') 
  &&  validarDatos('InformaciónEnergia') && validarDatos('InformaciónCarbohidratos') && validarDatos('InformaciónProteina')
   &&  validarDatos('InformaciónGrasas') &&  validarDatos('InformaciónSodio')){
    oData = new FormData(document.forms.namedItem("regForm"));
    oData.append('username', Usuario);
    oData.append('idSitio', idSitio);
    xmlHttpRequest.open("POST","/plato/CreatePlato",true);
    xmlHttpRequest.send(oData);
    event.preventDefault();
  }else{
    console.log("error form")
    const m = document.getElementById("messageBox");
    m.innerHTML = `<div class="alert alert-danger" role="alert">`+mensaje+`</div>`; 
    document.getElementById( 'regForm' ).scrollIntoView();
    setTimeout(function(){ m.innerHTML = "" }, 2500);
    //setTimeout(function(){ m.innerHTML = "" }, 2500);
  }

  
}
