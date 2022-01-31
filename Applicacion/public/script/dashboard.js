let idSitio = 0;
let idPlato = 0;


function openModal(Sitio) {
  	idSitio=Sitio;
	document.getElementById('id02').style.display='block';
	}

function openModalPlato(Plato, Sitio ) {
	idSitio = Sitio;
	idPlato = Plato;
	document.getElementById('id02').style.display='block';
}

function closeModal() {
  event.preventDefault();
  document.getElementById('id02').style.display='none';
}



function eliminarSitio(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
			console.log(response);
			if(xmlHttpRequest.responseText == 1) {
				const mensaje = document.getElementById("messageBox");
				mensaje.innerHTML = `<div class="alert alert-success" role="alert">
				Sitio Eliminado</div>`; 
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
       			window.location.replace("/dashboard/sitios");
			} else {
				event.preventDefault();
				const mensaje = document.getElementById("messageBox");
				mensaje.innerHTML = `<div class="alert alert-danger" role="alert">
				El Sitio seleccionado tiene Platos registrados, Eliminelos antes de borrar el sitio.
					</div>`;
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
			}
		}
	}
xmlHttpRequest.open("POST","/resto/DeleteResto",true); 
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("idSitio="+idSitio);
event.preventDefault();
}


function eliminarPlatos(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var response = xmlHttpRequest.responseText;
			console.log(response);
			if(xmlHttpRequest.responseText == 1) {
				const mensaje = document.getElementById("messageBox");
				mensaje.innerHTML = `<div class="alert alert-success" role="alert">
				Plato Eliminado</div>`; 
				console.log(idSitio); 
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
        		window.location.replace("/dashboard/plato?Sitio="+idSitio);
			} else {
				const mensaje = document.getElementById("messageBox");
      			mensaje.innerHTML = `<div class="alert alert-danger" role="alert">
      			Ocurrio un error, intenta de nuevo mas tarde.
    			</div>`;
				setTimeout(function(){ mensaje.innerHTML = "" }, 2500);
			}
		}
	}
xmlHttpRequest.open("POST","/plato/DeletePlato",true);
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("idPlato="+idPlato);
event.preventDefault();
}