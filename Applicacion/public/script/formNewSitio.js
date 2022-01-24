var longitud = 0;
var latitud = 0;
a = 0;
var self = this;
function mostrar_mensaje(mensaje, contenedor) {
  document.getElementById(contenedor).textContent = mensaje
}

function validarDatos(e, id) {
  switch (e) {
    case "nameSitio":
    X = document.getElementById("nameSitio").value;
    if (X.length < 4) {
      document.getElementById("nameSitio").classList.add("input-error");
      mostrar_mensaje("Debes escribir algo en el nombre.","help-nameSitio");
      return false;
    } else {
      document.getElementById("nameSitio").classList.remove("input-error");
      document.getElementById("help-nameSitio").textContent = ""
      mostrar_mensaje("","help-nameSitio");
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
  case "DireccionSitio":

    X = document.getElementById("DireccionSitio").value;
    if (X.length < 10) {
      document.getElementById("DireccionSitio").classList.add("input-error");
      mostrar_mensaje("Debes ingresar la direccion.Calle y Número","help-DireccionSitio");
      return false;
    } else {
      document.getElementById("DireccionSitio").classList.remove("input-error");
      mostrar_mensaje("","help-DireccionSitio");
    }
  break;
  case "LocalidadSitio":
    X = document.getElementById("LocalidadSitio").value;
    if (X < 10) {
      document.getElementById("LocalidadSitio").classList.add("input-error");
      mostrar_mensaje("Debes ingresar la localidad.","help-LocalidadSitio");
      return false;
    } else {
      document.getElementById("LocalidadSitio").classList.remove("input-error");
      mostrar_mensaje("","help-LocalidadSitio");
    }
break;
  case "ProvinciaSitio":
    X = document.getElementById("ProvinciaSitio").value;
    if (X < 5) {
      document.getElementById("ProvinciaSitio").classList.add("input-error");
      mostrar_mensaje("Debes ingresar la Provincia.","help-ProvinciaSitio");
      return false;
    } else {
      document.getElementById("ProvinciaSitio").classList.remove("input-error");
      mostrar_mensaje("","help-ProvinciaSitio");
    }
  break;
  case "MailSitio":
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    Mail = document.getElementById('MailSitio').value;
    if (!emailRegex.test(Mail)) {
      document.getElementById('MailSitio').classList.add('input-error');
      mostrar_mensaje('El correo electrónico ingresado no es valido.',"help-MailSitio");
      return false
    } else {
      document.getElementById('MailSitio').classList.remove('input-error');
      mostrar_mensaje("","help-MailSitio");
    }
  break;
  case "TelefonoSitio":
    telefonoRegex = /^(\(\+?\d{2,3}\)[\*|\s|\-|\.]?(([\d][\*|\s|\-|\.]?){6})(([\d][\s|\-|\.]?){2})?|(\+?[\d][\s|\-|\.]?){8}(([\d][\s|\-|\.]?){2}(([\d][\s|\-|\.]?){2})?)?)$/;
    X = document.getElementById("TelefonoSitio").value
    if (!telefonoRegex.test(X)) {
      document.getElementById("TelefonoSitio").classList.add("input-error");
      mostrar_mensaje("El telefono ingresado no es correcto.","help-TelefonoSitio");
      return false;
    } else {
      document.getElementById("TelefonoSitio").classList.remove("input-error");
      mostrar_mensaje("","help-TelefonoSitio");
    }
break;
  case "Mapa":
   // console.log("Lont="+longitud+"lat="+latitud)
    if ((this.longitud == 0) && (this.latitud == 0)) {
        mostrar_mensaje("Debes ingresar la ubicacion del Sitio.","help-Mapa");
      return false;
    }else {
      mostrar_mensaje("","help-Mapa");
    }
 break;
  case "Horario":

    seleccion = document.getElementById('Dia-' + id);
    Dia = seleccion.options[seleccion.selectedIndex].value;

    seleccion1 = document.getElementById('De-' + id);
    De = seleccion1.options[seleccion1.selectedIndex].value;

    seleccion2 = document.getElementById('Hasta-' + id);
    Hasta = seleccion2.options[seleccion2.selectedIndex].value;

    if ((Dia == -1) || (De == -1) || (Hasta == -1) || (De > Hasta) || (Hasta < De)) {
      document.getElementById('Dia-' + id).classList.add("input-error");
      document.getElementById('De-' + id).classList.add("input-error");
      document.getElementById('Hasta-' + id).classList.add("input-error");
      mostrar_mensaje("El Horario ingresado no es valido.","help-horario-"+ id);
      return false;
    } else {
      document.getElementById('Dia-' + id).classList.remove("input-error");
      document.getElementById('De-' + id).classList.remove("input-error");
      document.getElementById('Hasta-' + id).classList.remove("input-error");
      mostrar_mensaje("","help-horario-"+ id);
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


function validarRegistro() {
  var xmlHttpRequest = new XMLHttpRequest();
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var response = xmlHttpRequest.responseText;
      console.log("RESPEUSTA DEL SERVER:" + response)
      if (response == 1) {
        document.getElementById('regForm').scrollIntoView();
        const m = document.getElementById("messageBox");
        m.innerHTML = `<div class="alert alert-success" role="alert">
				Sitio registrado con exito.</div>`;
        setTimeout(function () { mensaje.innerHTML = "" }, 2500);
        setTimeout(function () { window.location.replace("/dashboard/sitios"); }, 2500);
      } else {
        document.getElementById('regForm').scrollIntoView();
        const m = document.getElementById("messageBox");
        m.innerHTML = `<div class="alert alert-danger" role="alert"> Ocurrio un error en el servidor.
         Por favor, inténtalo de nuevo más tarde.</div>`;
        document.getElementById('regForm').scrollIntoView();
        setTimeout(function () { m.innerHTML = "" }, 2500);
      }
    }
  }
  if (validarDatos('nameSitio') && validarDatos('subject') && validarDatos('DireccionSitio')
    && validarDatos('LocalidadSitio') && validarDatos('ProvinciaSitio') && validarDatos('MailSitio')
    && validarDatos('TelefonoSitio') && validarDatos('archivosubido')) {
    Usuario = document.getElementById('nombreUsuario').textContent;
    oData = new FormData(document.forms.namedItem("regForm"));
    oData.append('longitud', longitud);
    oData.append('latitud', latitud);
    oData.append('username', Usuario);
    for (let [name, value] of oData) {
      console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
    }
    xmlHttpRequest.open("POST", "/resto/CreateResto", true);
    xmlHttpRequest.send(oData);
    event.preventDefault();
  } else {
    console.log("error form")
    Usuario = document.getElementById('nombreUsuario').textContent;
    oData = new FormData(document.forms.namedItem("regForm"));
    oData.append('longitud', longitud);
    oData.append('latitud', latitud);
    oData.append('username', Usuario);
    for (let [name, value] of oData) {
      console.log(`${name} = ${value}`); // key1 = value1, luego key2 = value2
    }
    const m = document.getElementById("messageBox");
    m.innerHTML = `<div class="alert alert-danger" role="alert">` + 
    "El formulario presenta errores. Por favor, inténtalo de nuevo." + `</div>`;
    document.getElementById('regForm').scrollIntoView();
    setTimeout(function () { m.innerHTML = "" }, 2500);
  }


}

window.addEventListener('DOMContentLoaded', function () {

  mapboxgl.accessToken = 'pk.eyJ1IjoiY29zdGFpdmFuMzQiLCJhIjoiY2treDFvM25yMTd1ZjJ4anVldTA3ZHFpYiJ9.EsQJxJQTd6YbOHyUWcftnw';
  const coordinates = document.getElementById('coordinates');
  const map = new mapboxgl.Map({
    container: 'mapa',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [0, 0],
    zoom: 2
  });
  map.addControl(
    new MapboxGeocoder({
      accessToken: mapboxgl.accessToken,
      mapboxgl: mapboxgl
    })
  );
  map.addControl(new mapboxgl.NavigationControl())
  map.addControl(new mapboxgl.FullscreenControl())
  map.addControl(new mapboxgl.GeolocateControl())

  const canvas = map.getCanvasContainer();

  const geojson = {
    'type': 'FeatureCollection',
    'features': [
      {
        'type': 'Feature',
        'geometry': {
          'type': 'Point',
          'coordinates': [0, 0]
        }
      }
    ]
  };

  var el = document.createElement('div')
  el.className = 'marker'
  marker = new mapboxgl.Marker(el,{draggable: true ,  color: '#00000F' })
  .setLngLat([0, 0])
  .addTo(map);

     
    function onDragEnd() {
    const coords = marker.getLngLat();
    self.longitud = coords.lng;
    self.latitud = coords.lat;
    validarDatos("Mapa");
    }
     
    marker.on('dragend', onDragEnd);


})

function quitar_horario() {

  input = document.getElementById('horario-' + a)
  padre = input.parentNode;
  padre.removeChild(input);
  a--;
}

function agregar_horario() {
  a++;

  var div = document.createElement('div');
  div.setAttribute('id', 'horario-' + a);
  div.innerHTML = `     
  <label for="Dia">Día :</label>
      <select  id="Dia-` + a + `" name="Dia-` + a + `" onBlur="validarDatos('Horario','` + a + `' );">
        <option value="-1" >Selecionar día:</option>
        <option value="1">Lunes</option>
        <option value="2">Martes</option>
        <option value="3">Miercoles</option>
        <option value="4">Jueves</option>
        <option value="5">Viernes</option>
        <option value="6">Sabado</option>
        <option value="7">Domingo</option>
      </select>
      <span  id="help-horario-` + a + `" class="error-text" ></span>
      <br>
      <label for="De">De :</label>
      <select  id="De-` + a + `" name="De-` + a + `" onBlur="validarDatos('Horario','` + a + `');">
        <option value="-1">Selecionar hora:</option>
        <option value="0">00:00</option>
        <option value="1">01:00</option>
        <option value="2">02:00</option>
        <option value="3">03:00</option>
        <option value="4">04:00</option>
        <option value="5">05:00</option>
        <option value="6">06:00</option>
        <option value="7">07:00</option>
        <option value="8">08:00</option>
        <option value="9">09:00</option>
        <option value="10">10:00</option>
        <option value="11">11:00</option>
        <option value="12">12:00</option>
        <option value="13">13:00</option>
        <option value="14">14:00</option>
        <option value="15">15:00</option>
        <option value="16">16:00</option>
        <option value="17">17:00</option>
        <option value="18">18:00</option>
        <option value="19">19:00</option>
        <option value="20">20:00</option>
        <option value="21">21:00</option>
        <option value="22">22:00</option>
        <option value="23">23:00</option>
      </select>
  
      <label for="Hasta">A :</label>
      <select  id="Hasta-` + a + `" name="Hasta-` + a + `" onBlur="validarDatos('Horario','` + a + `');">
        <option value="-1">Selecionar hora:</option>
        <option value="0">00:00</option>
        <option value="1">01:00</option>
        <option value="2">02:00</option>
        <option value="3">03:00</option>
        <option value="4">04:00</option>
        <option value="5">05:00</option>
        <option value="6">06:00</option>
        <option value="7">07:00</option>
        <option value="8">08:00</option>
        <option value="9">09:00</option>
        <option value="10">10:00</option>
        <option value="11">11:00</option>
        <option value="12">12:00</option>
        <option value="13">13:00</option>
        <option value="14">14:00</option>
        <option value="15">15:00</option>
        <option value="16">16:00</option>
        <option value="17">17:00</option>
        <option value="18">18:00</option>
        <option value="19">19:00</option>
        <option value="20">20:00</option>
        <option value="21">21:00</option>
        <option value="22">22:00</option>
        <option value="23">23:00</option>
      </select>
`;
  document.getElementById('horarios').appendChild(div);
  document.getElementById('horarios').appendChild(div);

}
