var currentMarkers=[];

window.addEventListener('DOMContentLoaded', function () {

  if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        currentX = position.coords.longitude
        currentY = position.coords.latitude
        loadmapa(currentX, currentY)
        marcarPosition(currentX, currentY)
        cargarMarcadores(currentX, currentY)
      },
      function (error) {
        currentX = -59.2765014
        currentY = -35.0007812
        loadmapa(currentX, currentY)
        marcarPosition(currentX, currentY)
        cargarMarcadores(currentX, currentY)
      },
    )
  }
})


function clickbuscar(latitud, longitud){
 loadmapa(longitud, latitud); 
 map.setZoom(18);
}


function forwardGeocoder(query) {
  const matchingFeatures = [];
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
      var geojson =  {
        'features': [],
        'type': 'FeatureCollection'
        };
   
      for (sitio in respuesta.AllSitios){
      
        geojson.features.push(
          {
          'type': 'Feature',
          'properties': {
          'title': respuesta.AllSitios[sitio].nombre
          },
          'geometry': {
          'coordinates': [respuesta.AllSitios[sitio].Y, respuesta.AllSitios[sitio].X],
          'type': 'place'
          }
          
        },);
      
      }

      for (const feature of geojson.features) {
      // Handle queries with different capitalization
      // than the source data by calling toLowerCase().
        if (feature.properties.title.toLowerCase() .includes(query.toLowerCase())) {
          // Add a tree emoji as a prefix for custom
          // data results using carmen geojson format:
          // https://github.com/mapbox/carmen/blob/master/carmen-geojson.md
          feature['place_name'] = `✔️ ${feature.properties.title}`;
          feature['center'] = feature.geometry.coordinates;
          feature['place_type'] = ['place'];
          matchingFeatures.push(feature);
        }
      }
      console.log(matchingFeatures)
      }
      return matchingFeatures;
  }

 
  xmlHttpRequest.open(
    'GET',
    'buscar?Clave=' +
      query +
      '&Provincia=' +
      "TODAS" +
      '&Categoria=' +
      0 +
      '&Pagina=' +
      1,
    true,
  );
  xmlHttpRequest.send()
  return matchingFeatures;
}



/*
function forwardGeocoder() {
  var element  = document.getElementsByClassName("suggestions")[0];
  while (element.firstChild) {
    element.removeChild(element.firstChild);
  }
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
     
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
     
      while (element.firstChild) {
        element.removeChild(element.firstChild);
      }
     for (sitio in respuesta.AllSitios){
      console.log(respuesta.AllSitios[sitio])
   
      var div = document.createElement('li');
      div.innerHTML = `     
          <a onclick="clickbuscar(` + respuesta.AllSitios[sitio].X + `, ` + respuesta.AllSitios[sitio].Y + `)">
          <div class="mapboxgl-ctrl-geocoder--suggestion"  >
            <div class="mapboxgl-ctrl-geocoder--suggestion-title">★` + respuesta.AllSitios[sitio].nombre + `</div>
            <div class="mapboxgl-ctrl-geocoder--suggestion-address"> Place from Site</div>
          </div>
        </a x>
    `;
    element.appendChild(div);
  }
    }
  }

  clave = document.getElementsByClassName("mapboxgl-ctrl-geocoder--input")[0].value
  xmlHttpRequest.open(
    'GET',
    'buscar?Clave=' +
      clave +
      '&Provincia=' +
      "TODAS" +
      '&Categoria=' +
      0 +
      '&Pagina=' +
      1,
    true,
  );
  xmlHttpRequest.send()
}
*/


function agregarMarcadorCentrar(longitud, latitud, idSitio, nombre, path) {
  loadmapa(longitud, latitud)
  agregarMarcador(idSitio, nombre, path, longitud, latitud)
  if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        marcarPosition(position.coords.longitude, position.coords.latitude)
      },
      function (error) {
        marcarPosition(-59.2765014, -35.0007812)
      },
    )
  }
}

function marcarPosition(longitud, latitud) {
  var el = document.createElement('div')
  el.className = 'actualPosition'
  oneMarker = new mapboxgl.Marker(el, { color: '#00000F' })
    .setLngLat([longitud, latitud])
    currentMarkers.push(oneMarker);
    oneMarker.addTo(map)
}

function agregarMarcador(idSitio, nombre, path, Y, X) {
  // add markers to map
  // create a HTML element for each feature
  var el = document.createElement('div')
  el.className = 'marker'
  // make a marker for each feature and add to the map
  var oneMarker = new mapboxgl.Marker(el, { color: '#00000F' })
    .setLngLat([Y, X])
    .setPopup(
      new mapboxgl.Popup({ offset: 25 }) // add popups
        .setHTML(
          '<a  href="/resto?Sitio=' +
            idSitio +
            '"><h3 class="title">' +
            nombre +
            '</h3> <img class="imagen_pop" src="' +
            path +
            '" ></a>',
        ),
    )
    currentMarkers.push(oneMarker);
    oneMarker.addTo(map)
}

function borrarMarcadores(){
  if (currentMarkers!==null) {
    for (var i = currentMarkers.length - 1; i >= 0; i--) {
      currentMarkers[i].remove();
    }
    currentMarkers=[];
  }
}


function cargarMarcadores(currentX, currentY) {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
        
     /* console.log(
        haversine_distance(currentX, currentY, -59.2805014, -35.0047812),
      )*/
      if (xmlHttpRequest.responseText ===  " []"){
        document.getElementById( 'info' ).style.display = 'block';
        setTimeout(function(){ document.getElementById( 'info' ).style.display = 'none'; }, 2500);
      }else{ 
        var respuesta = JSON.parse(xmlHttpRequest.responseText)
        for (cat of respuesta) {
          agregarMarcador(cat.idSitio, cat.nombre, cat.path, cat.Y, cat.X)
        }
      
    }
  }
}
  const bounds = map.getBounds();
  const lx= new mapboxgl.LngLat(currentX,currentY);
  const ll1 = new mapboxgl.LngLat(bounds._ne.lng, bounds._ne.lat);
  const ll2 = new mapboxgl.LngLat(bounds._sw.lng, bounds._sw.lat);
 
  xmlHttpRequest.open('GET', 'marcadores?clong='+
  currentX+"&clat="+currentY+
  "&Ulong="+bounds._ne.lng +"&Ulat="+bounds._ne.lat
  +
  "&Dlong="+bounds._sw.lng +"&Dlat="+bounds._sw.lat, true)
  xmlHttpRequest.send()
}

function loadmapa(longitud, latitud) {
  document.getElementById( 'info' ).style.display = 'none';
  mapboxgl.accessToken =
    'pk.eyJ1IjoiY29zdGFpdmFuMzQiLCJhIjoiY2treDI1MDk3MDI2cjJ2bXFydTdnMnBmYSJ9.tYdWtyp9KZzPcZL1VowmZg'
  map = new mapboxgl.Map({
    container: 'mapa',
    style: 'mapbox://styles/mapbox/navigation-day-v1?optimize=true',
    center: [longitud, latitud],
    zoom:14.5 ,
  })

  map.addControl(
    new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    localGeocoder: forwardGeocoder,
    marker: false,
    mapboxgl: mapboxgl
    })
    );

  map.addControl(new mapboxgl.NavigationControl())
  map.addControl(new mapboxgl.FullscreenControl())
  map.addControl(new mapboxgl.GeolocateControl())

  


  map.on('zoom', () => {
    const { lng, lat } = map.getCenter()
    borrarMarcadores();
    marcarPosition(currentX, currentY)
    cargarMarcadores(lng, lat)
  })



  
  map.on('drag', () => {
    const { lng, lat } = map.getCenter()
    borrarMarcadores();
    marcarPosition(currentX, currentY)
    cargarMarcadores(lng, lat)
  })
}
