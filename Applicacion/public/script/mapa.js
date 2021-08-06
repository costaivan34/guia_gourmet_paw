window.addEventListener("DOMContentLoaded", function () {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
      currentPosition(position.coords.latitude, position.coords.longitude);
    }, function(error){
      const mensaje = document.getElementById("messageBox");
      mensaje.innerHTML = `<div class="alert alert-danger" role="alert">
      Es necesario habilitar la ubicacion para utilizar esta función</div>`;
  
    })
  }
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
     .setHTML('<a href="/resto?Sitio='+ datosMarcador.idSitio + '"><h3>' + datosMarcador.nombre +
      '</h3></a> <img class="imagen_pop" src="'+ datosMarcador.path+
      '" ><p>' + datosMarcador.cat + '</p>  '))
     .addTo(map);
 }

function cargarMarcadores(){
  var xmlHttpRequest=new XMLHttpRequest();
	xmlHttpRequest.onreadystatechange=function() {
		if (xmlHttpRequest.readyState==4 && xmlHttpRequest.status==200) { 
      var respuesta =JSON.parse(  xmlHttpRequest.responseText );
      console.log(respuesta)
      for (cat of respuesta) {
        agregarMarcador(cat);
      }
		}
	}
  xmlHttpRequest.open("GET","marcadores",true);
	xmlHttpRequest.send();

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

function currentPosition(latitude,longitude){
/*  console.log(datos);
  datos= datos.replaceAll('&quot;', '');
  datos= datos.replaceAll('{', '{"');
  datos= datos.replaceAll(',', '","');
  datos= datos.replaceAll(':', '":"');
  datos= datos.replaceAll('}', '"}');
 var respuesta =JSON.parse( datos );*/
 //console.log(respuesta);
 loadmapa(longitude,latitude);
 //cargarMarcadores(ciudad,region);
 cargarMarcadores();
  
}

 