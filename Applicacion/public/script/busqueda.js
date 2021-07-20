
window.addEventListener("DOMContentLoaded", function () {
  getProvincias();
  getCategorias();
  /*console.log(clave);
  console.log(categoria);
  console.log(provincia);
  datos= datos.replaceAll('&quot;', '');
  datos= datos.replaceAll('{', '{"');
  datos= datos.replaceAll(',', '","');
  datos= datos.replaceAll(':', '":"');
  datos= datos.replaceAll('}', '"}');*/
 //var respuesta =JSON.parse( datos );
 //console.log(respuesta);
 //var elemento  = document.getElementById("nombreUsuario");
 //elemento.text=respuesta.user;
  //buscadorBuscame(respuesta.clave,respuesta.categoria,respuesta.provincia,1);
  buscadorBuscame(clave,categoria,provincia,1);
});

function getDatos(){
  clave = document.getElementById("palabraClave").value;
  categoria = document.getElementById("categorias").value;
  provincia = document.getElementById("provincias").value;
  pagina =1;
 // console.log(provincia);
  buscadorBuscame(clave,categoria,provincia,pagina);
}

function buscador(){
  var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
     var respuesta =JSON.parse(  xmlHttpRequest.responseText );
    //  console.log(respuesta);
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
  
	xmlHttpRequest.open("GET","buscar?",true);
 
	xmlHttpRequest.send();

	event.preventDefault();
}

function getCategorias(){
	var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
     var respuesta =JSON.parse(  xmlHttpRequest.responseText );
    //  console.log(respuesta);
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

function agregarSitioPaginacion(respuesta,clave,categoria,provincia,pagina){
  
  clave2='" '+clave+'"';
   var ElementoPagina = document.createElement("li");
   ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='buscadorBuscame("+clave2+","+categoria+","+provincia+","+1+")' value='<<'>";
   document.getElementById("paginacionPlatos").appendChild(ElementoPagina);
   for (var i=1;i<=respuesta.Paginacion;i++) {
     if(pagina==i){
       ElementoPagina = document.createElement("li");
       ElementoPagina.innerHTML = "<input type='button' id='page-active' onclick='buscadorBuscame("+clave2+","+categoria+","+provincia+","+ i+")' value='"+i+"'>";
       document.getElementById("paginacionPlatos").appendChild(ElementoPagina);
     }else{
       ElementoPagina = document.createElement("li");
       ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='buscadorBuscame("+clave2+","+categoria+","+provincia+","+i+")' value='"+i+"'>";
       document.getElementById("paginacionPlatos").appendChild(ElementoPagina);
     } 
   }
   ElementoPagina = document.createElement("li");
   ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='buscadorBuscame("+clave2+","+categoria+","+provincia+","+respuesta.Paginacion+")' value='>>'>";
   document.getElementById("paginacionPlatos").appendChild(ElementoPagina);

  
 }



function agregarSitio(respuesta){
  var pMarker=document.createElement("p");
  var i=document.createElement("i");
  i.className="fa fa-map-marker";
  pMarker.appendChild(i);
  var textNode1 = document.createTextNode(respuesta.ciudad+", "+respuesta.provincia);
  pMarker.appendChild(textNode1);
  var pComent=document.createElement("p");
  var i1=document.createElement("i");
  i1.className="fa fa-commenting";
  pComent.appendChild(i1);
  var textNode2 = document.createTextNode(respuesta.Ncomentarios);
  pComent.appendChild(textNode2);
  var img= document.createElement("img");
  img.src=respuesta.path;
  var divIMG = document.createElement("div");
  divIMG.appendChild(img);
  var aNombre =document.createElement("a");
  aNombre.href="/resto?Sitio="+respuesta.idSitio;
  var h3nombre = document.createElement("h3");
  var textNode = document.createTextNode(respuesta.nombre);
  h3nombre.appendChild(textNode);
  aNombre.appendChild(h3nombre);
  var divPlates = document.createElement("div");
  divPlates.className="plates-text";
  divPlates.appendChild(aNombre);
  divPlates.appendChild(pMarker);
  divPlates.appendChild(pComent);
  var divTarjeta = document.createElement("div");
  divTarjeta.className="tarjeta";
  divTarjeta.appendChild(divIMG);
  divTarjeta.appendChild(divPlates);
  var divColumna = document.createElement("div");
  divColumna.className="columna";
  divColumna.appendChild(divTarjeta);
  document.getElementById("fila").appendChild(divColumna);

}

function buscadorBuscame(clave,categoria,provincia,pagina){
  var xmlHttpRequest=new XMLHttpRequest();
  var elemento  = document.getElementById("fila");
  var elemento2  = document.getElementById("paginacionPlatos");
  var pR=document.createElement("p");
  pR.className="error";
  var textNode2 = document.createTextNode("----------------No hay resultados---------------- ");
  pR.appendChild(textNode2);
  while (elemento.firstChild) {
    elemento.removeChild(elemento.firstChild);
  }
  
  while (elemento2.firstChild) {
    elemento2.removeChild(elemento2.firstChild);
  }
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      
        //console.log( xmlHttpRequest.responseText); 
        var respuesta =JSON.parse( xmlHttpRequest.responseText );
     //   console.log( respuesta.AllSitios);
      if(respuesta.Paginacion=="0"){
        elemento.appendChild(pR);
      }else{
        agregarSitioPaginacion(respuesta,clave,categoria,provincia,pagina);
        for( r in respuesta.AllSitios){
          agregarSitio(respuesta.AllSitios[r]);
        }
       
      }
      
		}else if ( (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==400 ) || (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==500 )){
      elemento.appendChild(pR);
    }
	}
  xmlHttpRequest.open("GET","buscar?Clave="+clave+"&Provincia="+provincia+"&Categoria="+categoria+"&Pagina="+pagina,true);
  //console.log("buscar?Clave="+clave+"&Provincia='"+provincia+"'&Categoria="+categoria+"&Pagina="+pagina);
	xmlHttpRequest.send();
	event.preventDefault();
}

