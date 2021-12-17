/*
function loadmapa(longitud,latitud) {
  mapboxgl.accessToken = 'pk.eyJ1IjoiY29zdGFpdmFuMzQiLCJhIjoiY2treDFvM25yMTd1ZjJ4anVldTA3ZHFpYiJ9.EsQJxJQTd6YbOHyUWcftnw';
  map = new mapboxgl.Map({container: 'mapa',style: 'mapbox://styles/mapbox/streets-v11',center: [longitud,latitud],zoom: 15 });
  map.addControl(new mapboxgl.NavigationControl());
  var marker = new mapboxgl.Marker().setLngLat([longitud, latitud]).addTo(map);
}*/


function getPaginacionID(pagina,sitio,objeto){
  var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
     var respuesta =JSON.parse(  xmlHttpRequest.responseText );
     var elemento  = document.getElementById("paginacion"+ objeto);
     while (elemento.firstChild) {
       elemento.removeChild(elemento.firstChild);
     }
     //console.log("pagina: "+respuesta)
      if (respuesta > 1){

      var ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='load"+objeto+"("+1+","+sitio+")' value='<<'>";
      document.getElementById("paginacion"+ objeto).appendChild(ElementoPagina);
      if (pagina!=1){
      var ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='load"+objeto+"("+(pagina-1)+","+sitio+")' value='<'>";
      document.getElementById("paginacion"+ objeto).appendChild(ElementoPagina);
      }
      for (var i=1;i<=respuesta;i++) {
        if(pagina==i){
          ElementoPagina = document.createElement("li");
          ElementoPagina.innerHTML = "<input type='button' id='page-active'  onclick='load"+objeto+"("+i+","+sitio+")' value='"+i+"'>";
          document.getElementById("paginacion"+ objeto).appendChild(ElementoPagina);
        }else{
          if(i>=(pagina-3)&&(i<=(pagina+3)) ){
            ElementoPagina = document.createElement("li");
            ElementoPagina.innerHTML = "<input type='button' id='inicio'  onclick='load"+objeto+"("+i+","+sitio+")' value='"+i+"'>";
            document.getElementById("paginacion"+ objeto).appendChild(ElementoPagina);
          }
        }
      }
      if (pagina!=respuesta){
      ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='load"+objeto+"("+(pagina+1)+","+sitio+")' value='>'>";
      document.getElementById("paginacion"+ objeto).appendChild(ElementoPagina);
    }
      ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='load"+objeto+"("+respuesta+","+sitio+")' value='>>'>";
      document.getElementById("paginacion"+ objeto).appendChild(ElementoPagina);
      }

  }
	}
	xmlHttpRequest.open("GET","paginacion"+objeto+"?Sitio="+sitio+"&page="+pagina,true);
	xmlHttpRequest.send();
	event.preventDefault();
}



function loadComentarios(pagina,sitio){
  //getPaginacionID(pagina,sitio,"Comentarios");
  getComentarios(pagina,sitio);
}

function loadPlatos(pagina,sitio){
  getPlatos(pagina,sitio);
  //getPaginacionID(pagina,sitio,"Platos");
   
}


function agregarPlato(imagen,nombre,id){
  var DivPlato = document.createElement("div");
  DivPlato.className="plato";
  var BotonPlato = document.createElement("div");
  BotonPlato.id="boton-modal";
  BotonPlato.className="tarjeta";
  var SeccionFoto = document.createElement("section");
  var Foto = document.createElement("img");
  Foto.src=imagen;
  var SeccionTitulo = document.createElement("section");
  SeccionTitulo.className="plato-text";
  var Titulo = document.createElement("h3");
  var textNode = document.createTextNode(nombre);
  Titulo.appendChild(textNode);
  Titulo.className="title";
  SeccionTitulo.appendChild(Titulo);
  SeccionFoto.appendChild(Foto);
  BotonPlato.appendChild(SeccionFoto);
  BotonPlato.appendChild(SeccionTitulo);
  SeccionTitulo.innerHTML =  SeccionTitulo.innerHTML +" <i class='fa fa-search-plus fa-2x'  id='inicio' onclick=' openModal("+id+","+idSitio+")' ></i>";
  DivPlato.appendChild(BotonPlato);
  document.getElementById("columna").appendChild(DivPlato);
 
}

function getPlatos(pagina,sitio){
  var xmlHttpRequest=new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange=function() {         
    if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      var respuesta =JSON.parse( xmlHttpRequest.responseText );
      var elemento  = document.getElementById("columna");
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
      }
      //console.log(respuesta);
      if (respuesta.length===0){
        var pR=document.createElement("p");
        pR.className="error";
        var textNode2 = document.createTextNode("----------------No hay platos para mostrar---------------- ");
        pR.appendChild(textNode2);
        elemento.appendChild(pR);
      }else{
      for (cat of respuesta) {
        agregarPlato(cat.path,cat.nombre,cat.idPlato);
      }
      getPaginacionID(pagina,sitio,"Platos");
    }
    }
  }
   xmlHttpRequest.open("GET","platos?Sitio="+sitio+"&page="+pagina,true);
   xmlHttpRequest.send();    
  event.preventDefault(); 
}



function agregarComentario(imagen,nombre,fecha,comentario,vp,va,vs){
  var liComentario = document.createElement("li");
  liComentario.className="comentario";
  var imgComentario = document.createElement("img");
 // imgComentario.className="coment-img";
  //imgComentario.src=imagen;
  var nombreComentario = document.createElement("h4");
  nombreComentario.className="coment-nombre";
  var textNode = document.createTextNode(nombre);
  nombreComentario.appendChild(textNode);

  var ulValor = document.createElement("ul");
  ulValor.className="valoracion";

  var liPrecio = document.createElement("li");
  var h2Precio = document.createElement("h2");
  var textNode = document.createTextNode("Precio");
  h2Precio.appendChild(textNode);
  liPrecio.appendChild(h2Precio);
  for(v1=1;v1<=vp;v1++){
        if(vp>=v1){
          liPrecio.innerHTML =  liPrecio.innerHTML+ "<span class='fa fa-star checked'></span>"; 
        }else{
          liPrecio.innerHTML =  liPrecio.innerHTML+ "<span class='fa fa-star'></span>";
        }
  }
  var liSabor = document.createElement("li");
  var h2Sabor = document.createElement("h2");
  var textNode = document.createTextNode("Sabor");
  h2Sabor.appendChild(textNode);
  liSabor.appendChild(h2Sabor);
  for(v2=1;v2<=vs;v2++){
        if(vs>=v2){
          liSabor.innerHTML =  liSabor.innerHTML+ "<span class='fa fa-star checked'></span>"; 
        }else{
          liSabor.innerHTML =  liSabor.innerHTML+ "<span class='fa fa-star'></span>";
        }
  }
  var liAmbiente = document.createElement("li");
  var h2Ambiente = document.createElement("h2");
  var textNode = document.createTextNode("Ambiente");
  h2Ambiente.appendChild(textNode);
  liAmbiente.appendChild(h2Ambiente);
  for(v3=1;v3<=va;v3++){
        if(va>=v3){
          liAmbiente.innerHTML =  liAmbiente.innerHTML+ "<span class='fa fa-star checked'></span>"; 
        }else{
          liAmbiente.innerHTML =  liAmbiente.innerHTML+ "<span class='fa fa-star'></span>";
        }
  }
  ulValor.appendChild(liPrecio);
  ulValor.appendChild(liSabor);
  ulValor.appendChild(liAmbiente);
  
//  liComentario.appendChild(imgComentario);
var h2Fecha = document.createElement("h3");
var textNode = document.createTextNode(fecha);
h2Fecha.className="title";
h2Fecha.appendChild(textNode);
liComentario.appendChild(h2Fecha);
  liComentario.appendChild(nombreComentario);
 
  liComentario.appendChild(ulValor);

  var pComentario = document.createElement("p");
  pComentario.textContent=comentario;
  pComentario.className="coment-text";
  liComentario.appendChild(pComentario);
  document.getElementById("lista-coment").appendChild(liComentario);
}

function getComentarios(pagina,sitio){
  var xmlHttpRequest=new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange=function() {         
      if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
        var respuesta =JSON.parse( xmlHttpRequest.responseText );
        //console.log(respuesta);
        var elemento  = document.getElementById("lista-coment");
        while (elemento.firstChild) {
          elemento.removeChild(elemento.firstChild);
        }
        //console.log(respuesta);
        for (cat of respuesta) {
          agregarComentario("public/res/user.png",cat.nombre,cat.fecha,cat.descripcion,cat.valoracionPrecio,cat.valoracionAmbiente,cat.valoracionSabor);
        }
        getPaginacionID(pagina,sitio,"Comentarios");
      }
    }
  xmlHttpRequest.open("GET","comentarios?Sitio="+sitio+"&page="+pagina,true);
  xmlHttpRequest.send();
  event.preventDefault(); 
}

function getInfoPlato(plato,sitio){
  var xmlHttpRequest=new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange=function() {         
    if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      var respuesta =JSON.parse( xmlHttpRequest.responseText );
      console.log(respuesta);
      document.getElementById('plato').style.display='block';
   /* var elemento  = document.getElementById("lista-coment");
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
      }
      console.log(respuesta);
      for (cat of respuesta) {
        var titulo = document.getElementById("titulo");
        var textNode = document.createTextNode(cat.nombre);
        titulo.appendChild(textNode);
   
      }*/
    }
  }
  xmlHttpRequest.open("GET","plato?Sitio="+sitio+"&Plato="+plato,true);
xmlHttpRequest.send();
event.preventDefault();
}
  
function setPlatoModal(respuesta,info,img,lista,caract){
  document.getElementById('plato').style.display='block';
  var titulo = document.getElementById("titulo");
  var descripcion = document.getElementById("descripcion");
  var imagen = document.getElementById("imagen-modal");
  titulo.innerHTML =info[0].nombre;
  descripcion.innerHTML =info[0].descripcion;
  imagen.src=img[0].path;
  var Peso = document.getElementById("Peso");
  var Energia = document.getElementById("Energia");
  var Carbo = document.getElementById("Carbo");
  var Proteina = document.getElementById("Proteina");
  var Grasas = document.getElementById("Grasas");
  var Sodio = document.getElementById("Sodio");
  Peso.innerHTML =lista[3].valor;
  Energia.innerHTML =lista[0].valor;
  Carbo.innerHTML =lista[0].valor;
  Proteina.innerHTML =lista[4].valor;
  Grasas.innerHTML =lista[2].valor;
  Sodio.innerHTML =lista[5].valor;
  for(c in caract ){
    console.log(caract[c].nombre);
    if(caract[c].nombre=="Picante"){
      var Picante = document.getElementById("Picante");
      Picante.src="/public/svg/chile (1).svg";
    }else{
      var Picante = document.getElementById("Picante");
      Picante.src="/public/svg/chile.svg";
    }
    if(caract[c].nombre=="Lacteos"){
      var Lacteos = document.getElementById("Lacteos");
      Lacteos.src="/public/svg/leche.svg";
    }else{
      var Lacteos = document.getElementById("Lacteos");
      Lacteos.src="/public/svg/leche (1).svg";
    }
    if(caract[c].nombre=="Gluten"){
      var Gluten = document.getElementById("Gluten");
      Gluten.src="/public/svg/gluten (1).svg"; 
    }else{
      var Gluten = document.getElementById("Gluten");
      Gluten.src="/public/svg/gluten.svg";
    }
    if(caract[c].nombre=="Vegano"){
      var Vegano = document.getElementById("Vegano");
      Vegano.src="/public/svg/tomate (1).svg" ;
    }else{
      var Vegano = document.getElementById("Vegano");
      Vegano.src="/public/svg/tomate.svg" ;
    }
    if(caract[c].nombre=="Azucar"){
      var Azucar = document.getElementById("Azucar");
      
      Azucar.src="/public/svg/sugar (1).svg";
   }else{
    var Azucar = document.getElementById("Azucar");
    Azucar.src="/public/svg/sugar.svg";
    }
    if(caract[c].nombre=="Sal"){
      var Sal = document.getElementById("Sal");

      Sal.src="/public/svg/dietetico (1).svg" ;
    }else{
      var Sal = document.getElementById("Sal");
      Sal.src="/public/svg/dietetico.svg" ;
    }
  }

}
  
  function openModal(plato,sitio) {
    var xmlHttpRequest=new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange=function() {         
      if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
        console.log(xmlHttpRequest.responseText);
        var respuesta =JSON.parse( xmlHttpRequest.responseText );
        var info =JSON.parse( respuesta.info ); 
        var img =JSON.parse( respuesta.img ); 
        var lista =JSON.parse( respuesta.lista ); 
        var caract =JSON.parse( respuesta.caract ); 
        setPlatoModal(respuesta,info,img,lista,caract); 
      }
    }
  xmlHttpRequest.open("GET","plato?Sitio="+sitio+"&Plato="+plato,true);
  xmlHttpRequest.send();
  event.preventDefault();
  
  }
  
function closeModal() {
  document.getElementById('plato').style.display='none';
}
  
function guardarComentario(){
  var xmlHttpRequest=new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange=function() {         
    if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      var pagina =( xmlHttpRequest.responseText );
      //console.log(pagina);
      const mensaje = document.getElementById("messageBoxResult");
				mensaje.innerHTML = `<div class="alert alert-success" role="alert">
				Comentario Guardado con Exito!</div>`; 
        document.getElementById( 'paginacionComentarios' ).scrollIntoView();
				setTimeout(function(){ mensaje.innerHTML = "" }, 5000);
        //document.getElementById('Precio5').c = 'none';

        for (i = 0; i < document.comentario.Precio.length; i++){ 
          document.comentario.Precio[i].checked=0
        }
        for (i = 0; i < document.comentario.Sabor.length; i++){ 
          document.comentario.Sabor[i].checked=0
        }
        for (i = 0; i < document.comentario.Ambiente.length; i++){ 
          document.comentario.Ambiente[i].checked=0
        }
       document.getElementById("nombreComent").value="";
       document.getElementById("mailComent").value="";
       document.getElementById("textoComent").value="";
       loadComentarios(pagina,sitio);
    }
  }

var nombre = document.getElementById("nombreComent").value;
var mail = document.getElementById("mailComent").value;
var texto = document.getElementById("textoComent").value;
var precio = document.querySelector('input[name=Precio]:checked').value;
var sabor = document.querySelector('input[name=Sabor]:checked').value;
var ambiente =  document.querySelector('input[name=Ambiente]:checked').value;
xmlHttpRequest.open("POST","sendComentario",true);
xmlHttpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlHttpRequest.send("sitio="+sitio+"&nombre="+nombre+"&mail="+mail+"&texto="+texto+"&precio="+precio+"&sabor="+sabor+"&ambiente="+ambiente);
event.preventDefault();
}

function openTab(evt, Name) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(Name).style.display = "block";
  evt.currentTarget.className += " active";
  if(Name=="Ubicacion"){
    agregarMarcadorCentrar(longitud,latitud,idSitio,nombre,path);
  }
  if(Name=="Platos"){
    loadPlatos(1,idSitio);
  }
  if(Name=="Valoracion"){
    loadComentarios(1,idSitio);
  }
  
}
