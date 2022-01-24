var longitud = 0;
var latitud = 0;
a = 0;
var self = this;

window.addEventListener('DOMContentLoaded', function () {
// Obtengo los inputs que quiero lanzar su validación al perder el foco
var inputs = document.querySelectorAll('input','input[type="submit"]');
var textarea = document.querySelectorAll('textarea');
console.log(textarea)
textarea.forEach(function(input) {
  input.addEventListener('blur', event => {
        if (!input.checkValidity()) {
          document.getElementById(input.name).classList.add("input-error");
          document.getElementById(`help-${input.name}`).textContent = input.validationMessage
        } else {
          document.getElementById(input.name).classList.remove("input-error");
          document.getElementById(`help-${input.name}`).textContent = ""
  
        }
  });
});
// Por cada input, chequeo su validez y hago acciones en consecuencia
inputs.forEach(function(input) {
    input.addEventListener('blur', event => {
        //console.log(input.checkValidity());
        // checkValidity() lanza la validación y decide si el valor del input 
        //	es correcto o no.
        console.log(input.name)
          if (!input.checkValidity()) {
            console.log(`Valor invalido en el input ${input.name}`);
            document.getElementById(input.name).classList.add("input-error");
            //  document.getElementById(input.name).reportValidity();
            document.getElementById(`help-${input.name}`).textContent = input.validationMessage
            // console.log(input.validationMessage);
            // agregar clases css para que se resalte el error
          } else {
            console.log(`Valor CORRECTO en el input ${input.name}`);
            console.log(`input ${input.name}`);
            document.getElementById(input.name).classList.remove("input-error");
            document.getElementById(`help-${input.name}`).textContent = ""
            // agregar clases css para que se muestre valido 
            //  o al menos borrar las clases que marcan errores
          }
    });
});

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
  
    document.getElementById("archivosubido").onchange = function(e) {
        // Creamos el objeto de la clase FileReader
        files = document.getElementById("archivosubido").files
        for (file=0;file<=files.length;file++){
            let reader = new FileReader();
            // Leemos el archivo subido y se lo pasamos a nuestro fileReader
            console.log(files[file]);
            reader.readAsDataURL(files[file]);
            // Le decimos que cuando este listo ejecute el código interno
            reader.onload = function(){
                let image = document.createElement('img');
                image.src = reader.result;
                let preview = document.getElementById('preview');
                preview.append(image);
            };
       
        }
    }
  })
  
  function quitar_horario() {
  if (a>0){
    input = document.getElementById('horario-' + a)
    padre = input.parentNode;
    padre.removeChild(input);
    a--;
}
  }
  
  function agregar_horario() {
    a++;
    var div = document.createElement('div');
    div.setAttribute('id', 'horario-' + a);
    div.innerHTML = `     
      <div class="input-group">
    <label for="Dia-` + a + `">Día :</label>
        <select  id="Dia-` + a + `" name="Dia-` + a + `"required >
          <option value="-1" >Selecionar día:</option>
          <option value="1">Lunes</option>
          <option value="2">Martes</option>
          <option value="3">Miercoles</option>
          <option value="4">Jueves</option>
          <option value="5">Viernes</option>
          <option value="6">Sabado</option>
          <option value="7">Domingo</option>
        </select>
        <span  id="help-Dia-` + a + `" class="error-text" ></span>
        </div>
      <div class="input-group">
        <label for="De-` + a + `">De :</label>
        <select  id="De-` + a + `" name="De-` + a + `"required onBlur="validarhorario('` + a + `');">
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
        <span id="help-De-` + a + `" class="error-text" ></span>
        </div>
        <div class="input-group">
        <label for="Hasta-` + a + `">A :</label>
        <select  id="Hasta-` + a + `" name="Hasta-` + a + `"required onBlur="validarhorario('` + a + `');">
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
        <span  id="help-Hasta-` + a + `" class="error-text" ></span>

        </div>
  `;
    document.getElementById('horarios').appendChild(div);
    document.getElementById('horarios').appendChild(div);
    
  }
 


function validarhorario(id) {
    seleccion = document.getElementById('Dia-' + id);
    Dia = seleccion.options[seleccion.selectedIndex].value;
    seleccion1 = document.getElementById('De-' + id);
    De =  parseInt( seleccion1.options[seleccion1.selectedIndex].value);
    seleccion2 = document.getElementById('Hasta-' + id);
    Hasta =  parseInt( seleccion2.options[seleccion2.selectedIndex].value);
    if (seleccion.checkValidity() && seleccion1.checkValidity() && seleccion2.checkValidity()  ) {
        if (  (De > Hasta) ) {
        document.getElementById("Dia-" + id).classList.add("input-error");
        document.getElementById("De-" + id).classList.add("input-error");
        document.getElementById("help-Hasta-"+ id).textContent = "El Horario ingresado no es valido."
        document.getElementById("Hasta-" + id).classList.add("input-error");
        }else {
            document.getElementById("De-"+ id).classList.remove("input-error");
            document.getElementById("Dia-" + id).classList.remove("input-error");
            document.getElementById("Hasta-"+ id).classList.remove("input-error");
            document.getElementById("help-Hasta-"+ id).textContent = ""
        
        }
        } else {
                document.getElementById("De-"+ id).classList.remove("input-error");
                document.getElementById("Dia-" + id).classList.remove("input-error");
                document.getElementById("Hasta-"+ id).classList.remove("input-error");
                document.getElementById("help-Hasta-"+ id).textContent = ""
            
            }
}

