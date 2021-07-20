
function loadmapa(longitud,latitud) {
  mapboxgl.accessToken = 'pk.eyJ1IjoiY29zdGFpdmFuMzQiLCJhIjoiY2treDFvM25yMTd1ZjJ4anVldTA3ZHFpYiJ9.EsQJxJQTd6YbOHyUWcftnw';
  map = new mapboxgl.Map({container: 'mapa',style: 'mapbox://styles/mapbox/streets-v11',center: [longitud,latitud],zoom: 15 });
  map.addControl(new mapboxgl.NavigationControl());
  var marker = new mapboxgl.Marker().setLngLat([longitud, latitud]).addTo(map);
}
function loadComentarios(pagina,sitio){
  getPaginacionComentarios(pagina,sitio);
  getComentarios(pagina,sitio);
}

function loadPlatos(pagina,sitio){
    getPaginacionPlatos(pagina,sitio);
    getPlatos(pagina,sitio);
}

function agregarPlato(imagen,nombre,id){
  var DivPlato = document.createElement("div");
  DivPlato.className="plato";
  var BotonPlato = document.createElement("div");
  BotonPlato.id="boton-modal";
  BotonPlato.className="carta-plato";
  var SeccionFoto = document.createElement("section");
  var Foto = document.createElement("img");
  Foto.src=imagen;
  var SeccionTitulo = document.createElement("section");
  SeccionTitulo.className="plato-text";
  var Titulo = document.createElement("h3");
  var textNode = document.createTextNode(nombre);
  Titulo.appendChild(textNode);
  SeccionTitulo.appendChild(Titulo);
  SeccionFoto.appendChild(Foto);
  BotonPlato.appendChild(SeccionFoto);
  BotonPlato.appendChild(SeccionTitulo);
  SeccionTitulo.innerHTML =  SeccionTitulo.innerHTML +" <i class='fa fa-search-plus fa-2x'  id='inicio' onclick=' openModal("+id+","+sitio+")' ></i>";
  DivPlato.appendChild(BotonPlato);
  document.getElementById("fila").appendChild(DivPlato);

}

function getPlatos(pagina,sitio){
  var xmlHttpRequest=new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange=function() {         
    if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
      var respuesta =JSON.parse( xmlHttpRequest.responseText );
      var elemento  = document.getElementById("fila");
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild);
      }
     // console.log(respuesta);
      for (cat of respuesta) {
        agregarPlato(cat.path,cat.nombre,cat.idPlato);
      }
    }
  }
   xmlHttpRequest.open("GET","platos?Sitio="+sitio+"&page="+pagina,true);
   xmlHttpRequest.send();    
  event.preventDefault(); 
}

function getPaginacionPlatos(pagina,sitio){
  var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
     var respuesta =JSON.parse(  xmlHttpRequest.responseText );
     var elemento  = document.getElementById("paginacionPlatos");
     while (elemento.firstChild) {
       elemento.removeChild(elemento.firstChild);
     }

      var ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='loadPlatos("+1+","+sitio+")' value='<<'>";
      document.getElementById("paginacionPlatos").appendChild(ElementoPagina);
      for (var i=1;i<=respuesta;i++) {
        if(pagina==i){
          ElementoPagina = document.createElement("li");
          ElementoPagina.innerHTML = "<input type='button' id='page-active' onclick='loadPlatos("+i+","+sitio+")' value='"+i+"'>";
          document.getElementById("paginacionPlatos").appendChild(ElementoPagina);
        }else{
          ElementoPagina = document.createElement("li");
          ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='loadPlatos("+i+","+sitio+")' value='"+i+"'>";
          document.getElementById("paginacionPlatos").appendChild(ElementoPagina);
        }
        
      }
      ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='loadPlatos("+respuesta+","+sitio+")' value='>>'>";
      document.getElementById("paginacionPlatos").appendChild(ElementoPagina);

     
		}
	}
	xmlHttpRequest.open("GET","platosPaginacion?Sitio="+sitio+"&page="+pagina,true);
	xmlHttpRequest.send();
	event.preventDefault();
}

function getPaginacionComentarios(pagina,sitio){
  var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
     var respuesta =JSON.parse(  xmlHttpRequest.responseText );
     var elemento  = document.getElementById("paginacionComentarios");
     while (elemento.firstChild) {
       elemento.removeChild(elemento.firstChild);
     }

      var ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='loadComentarios("+1+","+sitio+")' value='<<'>";
      document.getElementById("paginacionComentarios").appendChild(ElementoPagina);
      for (var i=1;i<=respuesta;i++) {
        
        ElementoPagina = document.createElement("li");
        ElementoPagina.innerHTML = "<input type='button' id='page-active' onclick='loadComentarios("+i+","+sitio+")' value='"+i+"'>";
        document.getElementById("paginacionComentarios").appendChild(ElementoPagina);
      }
      ElementoPagina = document.createElement("li");
      ElementoPagina.innerHTML = "<input type='button' id='inicio' onclick='loadComentarios("+respuesta+","+sitio+")' value='>>'>";
      document.getElementById("paginacionComentarios").appendChild(ElementoPagina);

     
		}
	}
	xmlHttpRequest.open("GET","comentariosPaginacion?Sitio="+sitio+"&page="+pagina,true);
	xmlHttpRequest.send();
	event.preventDefault();
}

function agregarComentario(imagen,nombre,fecha,comentario,vp,va,vs){
  var liComentario = document.createElement("li");
  liComentario.className="comentario";
  var imgComentario = document.createElement("img");
  imgComentario.className="coment-img";
  imgComentario.src=imagen;
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
  var h2Fecha = document.createElement("h3");
  var textNode = document.createTextNode(fecha);
  h2Fecha.appendChild(textNode);
  ulValor.appendChild(h2Fecha);
  liComentario.appendChild(imgComentario);
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
          //agregarComentario("public/res/user.png",cat.nombre,cat.fecha,cat.descripcion,cat.valoracionPrecio,cat.valoracionAmbiente,cat.valoracionSabor);
          //agregarComentario("public/res/user.png",cat.nombre,cat.fecha,cat.descripcion,cat.valoracionPrecio,cat.valoracionAmbiente,cat.valoracionSabor);
        }
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
      Picante.src="/public/svg/chile.svg";
    }else{
      var Picante = document.getElementById("Picante");
      Picante.src="/public/svg/chile (1).svg";
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
      Gluten.src="/public/svg/gluten.svg";
    }else{
      var Gluten = document.getElementById("Gluten");
      Gluten.src="/public/svg/gluten (1).svg";
    }
    if(caract[c].nombre=="Vegano"){
      var Vegano = document.getElementById("Vegano");
      Vegano.src="/public/svg/tomate.svg" ;
    }else{
      var Vegano = document.getElementById("Vegano");
      Vegano.src="/public/svg/tomate (1).svg" ;
    }
    if(caract[c].nombre=="Azucar"){
      var Azucar = document.getElementById("Azucar");
      Azucar.src="/public/svg/sugar.svg";
   }else{
    var Azucar = document.getElementById("Azucar");
    Azucar.src="/public/svg/sugar (1).svg";
    }
    if(caract[c].nombre=="Sal"){
      var Sal = document.getElementById("Sal");
      Sal.src="/public/svg/dietetico.svg" ;
    }else{
      var Sal = document.getElementById("Sal");
      Sal.src="/public/svg/dietetico (1).svg" ;
    }
  }

}
  
  function openModal(plato,sitio) {
    var xmlHttpRequest=new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange=function() {         
      if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) {
        var respuesta =JSON.parse( xmlHttpRequest.responseText );
        var info =JSON.parse( respuesta.info ); 
        var img =JSON.parse( respuesta.img ); 
        var lista =JSON.parse( respuesta.lista ); 
        var caract =JSON.parse( respuesta.caract ); 
        setPlatoModal(respuesta,info,img,lista,caract); 
        console.log(caract);
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
      loadComentarios(pagina,sitio);
      window.scrollTo(500, 0);
       document.getElementById("nombreComent").value="";
       document.getElementById("mailComent").value="";
       document.getElementById("textoComent").value="";
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
    loadmapa(longitud,latitud);
  }
  if(Name=="Platos"){
    //getPaginacionPlatos(1,sitio);
    //getPlatos(1,sitio);
    loadPlatos(1,sitio);
  }

  if(Name=="Valoracion"){
    //getPaginacionComentarios(1,sitio);
    //getComentarios(1,sitio);
    loadComentarios(1,sitio);
  }
  
}
