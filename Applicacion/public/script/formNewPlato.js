function validarDatos(namePlato,descripcion,Peso,Energia,Carbohidratos,Proteina,Grasas,Sodio){
 
  if (namePlato.length<0 ){
    mensaje="El nombre ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (descripcion.length<0 ){
    mensaje="La descripción ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  }
  if (Peso.length<0 || Energia.length<0 || Carbohidratos.length<0 || Proteina.length<0 ||Grasas.length<0 ||Sodio.length<0  ){
    mensaje="La información Nutricional ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  } 
  if (Peso<0 || Energia<0 || Carbohidratos<0 || Proteina<0 ||Grasas<0 ||Sodio<=0  ){
    mensaje="La información Nutricional ingresada no es valida. Por favor, revisa los datos e inténtalo de nuevo."
    return false;
  } 
  return true;
}


function validarRegistro(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
     console.log("RESPEUSTA DEL SERVER:"+response)
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

  namePlato = document.getElementById('namePlato').value;
  descripcion = document.getElementById('subject').value;
  Peso = document.getElementById('InformaciónPeso').value;
  Energia = document.getElementById('InformaciónEnergia').value;
  Carbohidratos = document.getElementById('InformaciónCarbohidratos').value;
  Proteina = document.getElementById('InformaciónProteina').value;
  Grasas = document.getElementById('InformaciónGrasas').value;
  Sodio = document.getElementById('InformaciónSodio').value;
  Sitio = document.getElementById('InformaciónSodio').value;
  Usuario =  document.getElementById('nombreUsuario').textContent;
  idSitio =  document.getElementById('idSitio').textContent;
  if (validarDatos(namePlato,descripcion,Peso,Energia,Carbohidratos,Proteina,Grasas,Sodio)){
    oData = new FormData(document.forms.namedItem("regForm"));
    oData.append('username', Usuario);
    oData.append('idSitio', idSitio);
   for(let [name, value] of oData) {
      console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
    }
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
