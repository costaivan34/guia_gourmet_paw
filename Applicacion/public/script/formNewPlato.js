function mostrar_mensaje(mensaje, contenedor) {
  document.getElementById(contenedor).textContent = mensaje
}

function validarDatos(e, id) {
  switch (e) {
    case "namePlato":
    X = document.getElementById("namePlato").value;
    if (X.length < 4) {
      document.getElementById("namePlato").classList.add("input-error");
      mostrar_mensaje("Debes escribir algo en el nombre.","help-namePlato");
      return false;
    } else {
      document.getElementById("namePlato").classList.remove("input-error");
      document.getElementById("help-namePlato").textContent = ""
      mostrar_mensaje("","help-namePlato");
    }
break;
  case "subject":
    X = document.getElementById("subject").value;
    if (X.length < 40) {
      document.getElementById("subject").classList.add("input-error");
      mostrar_mensaje("Debes escribir algo en la descripcion.","help-subject");
      return false;
    } else {
      document.getElementById("subject").classList.remove("input-error");
      mostrar_mensaje("","help-subject");
    }
break;
  case "InformaciónPeso":

    X = document.getElementById("InformaciónPeso").value;
    if (X.length < 10) {
      document.getElementById("InformaciónPeso").classList.add("input-error");
      mostrar_mensaje("El Peso debe ser mayor a cero.","help-InformaciónPeso");
      return false;
    } else {
      document.getElementById("InformaciónPeso").classList.remove("input-error");
      mostrar_mensaje("","help-InformaciónPeso");
    }
  break;
  case "InformaciónEnergia":

      X = document.getElementById("InformaciónEnergia").value;
      if (X.length < 10) {
        document.getElementById("InformaciónEnergia").classList.add("input-error");
        mostrar_mensaje("La Cantidad de Energia debe ser mayor a cero.","help-InformaciónEnergia");
        return false;
      } else {
        document.getElementById("InformaciónEnergia").classList.remove("input-error");
        mostrar_mensaje("","help-InformaciónEnergia");
      }
    break;
    case "InformaciónCarbohidratos":

    X = document.getElementById("InformaciónCarbohidratos").value;
    if (X.length < 10) {
      document.getElementById("InformaciónCarbohidratos").classList.add("input-error");
      mostrar_mensaje("La Cantidad de Carbohidratos debe ser mayor a cero.","help-InformaciónCarbohidratos");
      return false;
    } else {
      document.getElementById("InformaciónCarbohidratos").classList.remove("input-error");
      mostrar_mensaje("","help-InformaciónCarbohidratos");
    }
  break;
  case "InformaciónProteina":

  X = document.getElementById("InformaciónProteina").value;
  if (X.length < 10) {
    document.getElementById("InformaciónProteina").classList.add("input-error");
    mostrar_mensaje("La Cantidad de Proteina debe ser mayor a cero.","help-InformaciónProteina");
    return false;
  } else {
    document.getElementById("InformaciónProteina").classList.remove("input-error");
    mostrar_mensaje("","help-InformaciónProteina");
  }
break;
case "InformaciónGrasas":

  X = document.getElementById("InformaciónGrasas").value;
  if (X.length < 10) {
    document.getElementById("InformaciónGrasas").classList.add("input-error");
    mostrar_mensaje("La Cantidad de Grasas Totales debe ser mayor a cero.","help-InformaciónGrasas");
    return false;
  } else {
    document.getElementById("InformaciónGrasas").classList.remove("input-error");
    mostrar_mensaje("","help-InformaciónGrasas");
  }
break;
case "InformaciónSodio":

  X = document.getElementById("InformaciónSodio").value;
  if (X.length < 10) {
    document.getElementById("InformaciónSodio").classList.add("input-error");
    mostrar_mensaje("La cantidad de Sodio debe ser mayor a cero.","help-InformaciónSodio");
    return false;
  } else {
    document.getElementById("InformaciónSodio").classList.remove("input-error");
    mostrar_mensaje("","help-InformaciónSodio");
  }
break;

  case "archivosubido":
    X = document.getElementById("archivosubido");
    console.log("dia"+X.files.length);
  
    if (X.files.length == 0) {
      document.getElementById("archivosubido").classList.add("input-error");
      mostrar_mensaje("Debes subir al menos una imagen.","help-archivosubido");
      return false;
    } else {
      document.getElementById("archivosubido").classList.remove("input-error");
      mostrar_mensaje("","help-archivosubido");
    }
  break;
}
}

function validarRegistro(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
    console.log("RESPEUSTA DEL SERVER:"+response);
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
    m.innerHTML = `<div class="alert alert-danger" role="alert">` + 
    "El formulario presenta errores. Por favor, inténtalo de nuevo." + `</div>`;
    document.getElementById('regForm').scrollIntoView();
    setTimeout(function () { m.innerHTML = "" }, 2500);
  }

  
}
