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

function haversine_distance(currentX, currentY, X, Y) {
  function toRad(x) {
    return (x * Math.PI) / 180
  }

  var lon1 = currentX
  var lat1 = currentY
  var lon2 = X
  var lat2 = Y

  var R = 6371 // km
  var x1 = lat1 - lat2
  var dLat = toRad(x1)
  var x2 = lon1 - lon2
  var dLon = toRad(x2)
  var a =
    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(toRad(lat1)) *
      Math.cos(toRad(lat2)) *
      Math.sin(dLon / 2) *
      Math.sin(dLon / 2)
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a))
  var d = R * c
  return d
}

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
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
    /*  console.log(respuesta)
      console.log(
        haversine_distance(currentX, currentY, -59.2805014, -35.0047812),
      )*/
      for (cat of respuesta) {map.getBounds();
      //  const ll = new mapboxgl.LngLat(currentX, currentY);
      
      const bounds = map.getBounds();
      console.log(bounds._ne.lng);
      console.log(bounds._sw);
        const ll = new mapboxgl.LngLat(cat.Y, cat.X);
        const lx= new mapboxgl.LngLat(currentX,currentY);
        const ll1 = new mapboxgl.LngLat(bounds._ne.lng, bounds._ne.lat);
        const ll2 = new mapboxgl.LngLat(bounds._sw.lng, bounds._sw.lat);
        console.log("distancia del centro al borde:"+lx.distanceTo(ll1))
        console.log("distancia del centro a sitio:"+lx.distanceTo(ll))
      /*  if ( //si esta cerca mostrar
          haversine_distance(currentX, currentY, cat.Y, cat.X) <
          0.5748535276915911
        ) {
          agregarMarcador(cat.idSitio, cat.nombre, cat.path, cat.Y, cat.X)
        }*/
        if ( //si esta cerca mostrar
          ( lx.distanceTo(ll1) > lx.distanceTo(ll)) 
        ) {
          agregarMarcador(cat.idSitio, cat.nombre, cat.path, cat.Y, cat.X)
        }
      }
    }
  }
  xmlHttpRequest.open('GET', 'marcadores', true)
  xmlHttpRequest.send()
}

function loadmapa(longitud, latitud) {
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
    mapboxgl: mapboxgl
    })
    );
  map.addControl(new mapboxgl.NavigationControl())
  map.addControl(new mapboxgl.FullscreenControl())
  map.addControl(new mapboxgl.GeolocateControl())
 

  
  map.on('dragend', () => {

    const { lng, lat } = map.getCenter()
    borrarMarcadores();
    marcarPosition(currentX, currentY)
    cargarMarcadores(lng, lat)
  })
}
