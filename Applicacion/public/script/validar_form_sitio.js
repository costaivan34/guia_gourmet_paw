var longitud = 0;
var latitud = 0;
a = 0;
var self = this;

window.addEventListener('DOMContentLoaded', function () {
// Obtengo los inputs que quiero lanzar su validación al perder el foco
var inputs = document.querySelectorAll('input','input[type="submit"]');
var textarea = document.querySelectorAll('textarea');
console.log(inputs)
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
      center: [alatitud, alongitud],
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
    .setLngLat([alatitud, alongitud])
    .addTo(map);
  
      function onDragEnd() {
      const coords = marker.getLngLat();
      self.longitud = coords.lng;
      self.latitud = coords.lat;
      document.getElementById("longitud").value = coords.lng;
      document.getElementById("latitud").value = coords.lat;
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
    div.setAttribute('class', 'horario');
    div.innerHTML = `     
      <div class="input-group">
    <label for="Dia-` + a + `">Día :</label>
        <select  id="Dia-` + a + `"name="horarios[]" class=" select-dia" required onBlur="validarhorario('` + a + `');" >
          <option value="-1" >Selecionar día:</option>
          <option value="1">Lunes</option>
          <option value="2">Martes</option>
          <option value="3">Miercoles</option>
          <option value="4">Jueves</option>
          <option value="5">Viernes</option>
          <option value="6">Sabado</option>
          <option value="7">Domingo</option>
        </select>
       
        </div>
      <div class="input-group">
        <label for="De-` + a + `">De :</label>
        <input type="time"  id="De-` + a + `"  name="horarios[]" 
         required class="select-dia caja-texto {{datos['form'][7].estado}} " onBlur="validarhorario('` + a + `');" >
        </div>
        <div class="input-group">
        <label for="Hasta-` + a + `">A :</label>
        <input type="time" id="Hasta-` + a + `" name="horarios[]"  
        required class="select-dia caja-texto {{datos['form'][7].estado}} " onBlur="validarhorario('` + a + `');">
        
        </div>
  <span  id="help-Hasta-` + a + `" class="error-text-horario" ></span>`;
    document.getElementById('horarios').appendChild(div);
    document.getElementById('horarios').appendChild(div);
    
  }
 


function validarhorario(id) {
    seleccion = document.getElementById('Dia-' + id);
    Dia = seleccion.options[seleccion.selectedIndex].value;
    seleccion1 = document.getElementById('De-' + id);
    De = ( seleccion1 .value);
    seleccion2 = document.getElementById('Hasta-' + id);
    Hasta =  ( seleccion2.value);
    console.log("horario");
    console.log(Dia);
    console.log(De);
    console.log(Hasta);
    if (seleccion.checkValidity() && seleccion1.checkValidity() && seleccion2.checkValidity()  ) {
      document.getElementById("De-"+ id).classList.remove("input-error");
      document.getElementById("Dia-" + id).classList.remove("input-error");
      document.getElementById("Hasta-"+ id).classList.remove("input-error");
      document.getElementById("help-Hasta-"+ id).textContent = ""
     
        } else {
          document.getElementById("Dia-" + id).classList.add("input-error");
          document.getElementById("De-" + id).classList.add("input-error");
          document.getElementById("help-Hasta-"+ id).textContent = "El Horario ingresado no es valido."
          document.getElementById("Hasta-" + id).classList.add("input-error");
            
         }
}

