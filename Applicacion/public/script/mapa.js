
window.addEventListener("DOMContentLoaded", function () {

  currentPosition();
 // cargarMarcadores("navarro","buenos aires");
  
});

function agregarMarcador(datosMarcador){
  // add markers to map
   // create a HTML element for each feature
   var el = document.createElement('div');
   el.className = 'marker';
   // make a marker for each feature and add to the map
   new mapboxgl.Marker(el,{'color': '#00000F'})
   .setLngLat([datosMarcador.Y, datosMarcador.X])
   .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
     .setHTML('<h3>' + datosMarcador.nombre + '</h3><a href="/resto?Sitio='  + datosMarcador.idSitio + '></a>'))
   .addTo(map);
 }

function cargarMarcadores(ciudad,provincia){
  var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
 //    console.log( xmlHttpRequest.responseText );
      var respuesta =JSON.parse(  xmlHttpRequest.responseText );
      console.log( respuesta );
     //currentPosition(longitud,latitud);
      for (cat of respuesta) {
        agregarMarcador(cat);
       console.log(cat);
      }
		}else{
    //  alert("ME CAGO EN LA PUTA");
    }  
	}
 // console.log( provincia +"-------"+ciudad );

  xmlHttpRequest.open("GET","marcadores?Provincia="+provincia+"&Ciudad="+ciudad,true);
	xmlHttpRequest.send();
	event.preventDefault();
}

function loadmapa(longitud,latitud) {
  mapboxgl.accessToken = 'pk.eyJ1IjoiY29zdGFpdmFuMzQiLCJhIjoiY2treDFvM25yMTd1ZjJ4anVldTA3ZHFpYiJ9.EsQJxJQTd6YbOHyUWcftnw';
  map = new mapboxgl.Map({container: 'mapa',style: 'mapbox://styles/mapbox/light-v10',center: [longitud,latitud],zoom: 13 });
  map.addControl(new mapboxgl.NavigationControl());
  map.addControl(new mapboxgl.FullscreenControl());
  var el = document.createElement('div');
      el.className = 'actualPosition';
      new mapboxgl.Marker(el,{'color': '#00000F'}).setLngLat([longitud,latitud]).addTo(map);
}

function currentPosition(){
/*  console.log(datos);
  datos= datos.replaceAll('&quot;', '');
  datos= datos.replaceAll('{', '{"');
  datos= datos.replaceAll(',', '","');
  datos= datos.replaceAll(':', '":"');
  datos= datos.replaceAll('}', '"}');
 var respuesta =JSON.parse( datos );*/
 //var elemento  = document.getElementById("nombreUsuario");
  // elemento.text=respuesta.user;
 //console.log(respuesta);
 loadmapa(longitud,latitud);
 cargarMarcadores(ciudad,region);
 cargarMarcadores("navarro","buenos aires");
  
}

 