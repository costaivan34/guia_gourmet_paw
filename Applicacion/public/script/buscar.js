window.addEventListener("DOMContentLoaded", function () {
    event.preventDefault();
    getProvincias();
    getCategorias();
  });


  function getDatos(){
    clave = document.getElementById("palabraClave").value;
    categoria = document.getElementById("categorias").value;
    provincia = document.getElementById("provincias").value;
    pagina =1;
   window.location.replace("/buscar?Clave="+ clave +"&Provincia="+ provincia +"&Categoria="+categoria+"&Pagina="+pagina);   
  }

  function getCategorias(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
     var respuesta =JSON.parse( xmlHttpRequest.responseText );
    
      var opcion = document.createElement("option");
      var elemento  = document.getElementById("categorias");
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
      }
      opcion = document.createElement("option");
      opcion.value=0;       
      opcion.text="Selecionar Categoria:";     
      document.getElementById("categorias").appendChild(opcion); 
      
      for (cat of respuesta) {
        opcion = document.createElement("option");
        opcion.value=cat.idCategoria;       
        opcion.text=cat.nombre;                                   
        document.getElementById("categorias").appendChild(opcion);
      }
		}
	}
	xmlHttpRequest.open("GET","categorias",true);
	xmlHttpRequest.send();
	event.preventDefault();
}


function getProvincias(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
			var respuesta = JSON.parse(  xmlHttpRequest.responseText );
      var opcion = document.createElement("option");
      var elemento  = document.getElementById("provincias");
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
      }
      opcion = document.createElement("option");
      opcion.value='TODAS';       
      opcion.text="Selecionar Ubicación:";                                   
      document.getElementById("provincias").appendChild(opcion);
      opcion1 = document.createElement("option");          
      for (provincia of respuesta.provincias) {
        opcion = document.createElement("option");
        opcion.value=provincia.nombre;       
        opcion.text=provincia.nombre;                                   
        document.getElementById("provincias").appendChild(opcion);
      }
		}
	}
	xmlHttpRequest.open("GET","https://apis.datos.gob.ar/georef/api/provincias?orden=nombre",true);
	xmlHttpRequest.send();
	event.preventDefault(); 
}