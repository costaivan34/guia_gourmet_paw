
window.addEventListener('DOMContentLoaded', function () {
// Obtengo los inputs que quiero lanzar su validación al perder el foco
var inputs = document.querySelectorAll('input','input[type="submit"]');
var textarea = document.querySelectorAll('textarea');
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
           
            document.getElementById(input.name).classList.add("input-error");
            //  document.getElementById(input.name).reportValidity();
            document.getElementById(`help-${input.name}`).textContent = input.validationMessage
            // console.log(input.validationMessage);
            // agregar clases css para que se resalte el error
          } else {
          
            document.getElementById(input.name).classList.remove("input-error");
            document.getElementById(`help-${input.name}`).textContent = ""
            // agregar clases css para que se muestre valido 
            //  o al menos borrar las clases que marcan errores
          }
    });
});
 })
  

function validarDatos(nombre, mail, texto) {
  emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i
  if (nombre.length <= 0) {
    mensaje =
      'El nombre  ingresados no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  if (texto.length <= 0) {
    mensaje =
      'El mensaje ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  if (!emailRegex.test(mail)) {
    mensaje =
      'El correo electronico ingresado no es valido. Por favor, revisa los datos e inténtalo de nuevo.'
    return false
  }
  return true
}

function getPaginacionID(pagina, sitio, objeto) {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
      var elemento = document.getElementById('paginacion' + objeto)
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild)
      }
      //console.log("pagina: "+respuesta)
      if (respuesta > 1) {
        var ElementoPagina = document.createElement('li')
        ElementoPagina.innerHTML =
          "<input type='button' id='inicio' onclick='load" +
          objeto +
          '(' +
          1 +
          ',' +
          sitio +
          ")' value='<<'>"
        document
          .getElementById('paginacion' + objeto)
          .appendChild(ElementoPagina)
        if (pagina != 1) {
          var ElementoPagina = document.createElement('li')
          ElementoPagina.innerHTML =
            "<input type='button' id='inicio' onclick='load" +
            objeto +
            '(' +
            (pagina - 1) +
            ',' +
            sitio +
            ")' value='<'>"
          document
            .getElementById('paginacion' + objeto)
            .appendChild(ElementoPagina)
        }
        for (var i = 1; i <= respuesta; i++) {
          if (pagina == i) {
            ElementoPagina = document.createElement('li')
            ElementoPagina.innerHTML =
              "<input type='button' id='page-active'  onclick='load" +
              objeto +
              '(' +
              i +
              ',' +
              sitio +
              ")' value='" +
              i +
              "'>"
            document
              .getElementById('paginacion' + objeto)
              .appendChild(ElementoPagina)
          } else {
            if (i >= pagina - 3 && i <= pagina + 3) {
              ElementoPagina = document.createElement('li')
              ElementoPagina.innerHTML =
                "<input type='button' id='inicio'  onclick='load" +
                objeto +
                '(' +
                i +
                ',' +
                sitio +
                ")' value='" +
                i +
                "'>"
              document
                .getElementById('paginacion' + objeto)
                .appendChild(ElementoPagina)
            }
          }
        }
        if (pagina != respuesta) {
          ElementoPagina = document.createElement('li')
          ElementoPagina.innerHTML =
            "<input type='button' id='inicio' onclick='load" +
            objeto +
            '(' +
            (pagina + 1) +
            ',' +
            sitio +
            ")' value='>'>"
          document
            .getElementById('paginacion' + objeto)
            .appendChild(ElementoPagina)
        }
        ElementoPagina = document.createElement('li')
        ElementoPagina.innerHTML =
          "<input type='button' id='inicio' onclick='load" +
          objeto +
          '(' +
          respuesta +
          ',' +
          sitio +
          ")' value='>>'>"
        document
          .getElementById('paginacion' + objeto)
          .appendChild(ElementoPagina)
      }
    }
  }
  xmlHttpRequest.open(
    'GET',
    'paginacion' + objeto + '?Sitio=' + sitio + '&page=' + pagina,
    true,
  )
  xmlHttpRequest.send()
  event.preventDefault()
}

function loadComentarios(pagina, sitio) {
  //getPaginacionID(pagina,sitio,"Comentarios");
  getComentarios(pagina, sitio)
}

function loadPlatos(pagina, sitio) {
  getPlatos(pagina, sitio)
  //getPaginacionID(pagina,sitio,"Platos");
}

function agregarPlato(imagen, nombre, id) {
  var li = document.createElement('li')
  li.className = 'fila'
  var DivPlato = document.createElement('section')
  DivPlato.className = 'plato'
  var BotonPlato = document.createElement('section')
  BotonPlato.id = 'boton-modal'
  BotonPlato.className = 'tarjeta'
  var SeccionFoto = document.createElement('section')
  var Foto = document.createElement('img')
  Foto.src = imagen
  var SeccionTitulo = document.createElement('section')
  SeccionTitulo.className = 'plato-text'
  var Titulo = document.createElement('h3')
  var textNode = document.createTextNode(nombre)
  Titulo.appendChild(textNode)
  Titulo.className = 'title'
  SeccionTitulo.appendChild(Titulo)
  SeccionFoto.appendChild(Foto)
  BotonPlato.appendChild(SeccionFoto)
  BotonPlato.appendChild(SeccionTitulo)
  SeccionTitulo.innerHTML =
    SeccionTitulo.innerHTML +
    " <i class='fa fa-search-plus fa-2x'  id='inicio' onclick=' openModal(" +
    id +
    ',' +
    idSitio +
    ")' ></i>"
  DivPlato.appendChild(BotonPlato)
  li.appendChild(DivPlato)
  document.getElementById('columna').appendChild(li)
}

function getPlatos(pagina, sitio) {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
      var elemento = document.getElementById('columna')
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild)
      }
      //console.log(respuesta);
      if (respuesta.length === 0) {
        var pR = document.createElement('p')
        pR.className = 'error'
        var textNode2 = document.createTextNode(
          '----------------No hay platos para mostrar---------------- ',
        )
        pR.appendChild(textNode2)
        elemento.appendChild(pR)
      } else {
        for (cat of respuesta) {
          agregarPlato(cat.path, cat.nombre, cat.idPlato)
        }
        getPaginacionID(pagina, sitio, 'Platos')
      }
    }
  }
  xmlHttpRequest.open('GET', 'platos?Sitio=' + sitio + '&page=' + pagina, true)
  xmlHttpRequest.send()
  event.preventDefault()
}

function agregarComentario(imagen, nombre, fecha, comentario, vp, va, vs) {
  var liComentario = document.createElement('li')
  liComentario.className = 'comentario'
  var imgComentario = document.createElement('img')
  // imgComentario.className="coment-img";
  //imgComentario.src=imagen;
  var nombreComentario = document.createElement('h4')
  nombreComentario.className = 'coment-nombre'
  var textNode = document.createTextNode(nombre)
  nombreComentario.appendChild(textNode)

  var ulValor = document.createElement('ul')
  ulValor.className = 'valoracion'

  var liPrecio = document.createElement('li')
  var h2Precio = document.createElement('h2')
  var textNode = document.createTextNode('Precio')
  h2Precio.appendChild(textNode)
  liPrecio.appendChild(h2Precio)
  for (v1 = 1; v1 <= vp; v1++) {
    if (vp >= v1) {
      liPrecio.innerHTML =
        liPrecio.innerHTML + "<span class='fa fa-star checked'></span>"
    } else {
      liPrecio.innerHTML =
        liPrecio.innerHTML + "<span class='fa fa-star'></span>"
    }
  }
  var liSabor = document.createElement('li')
  var h2Sabor = document.createElement('h2')
  var textNode = document.createTextNode('Sabor')
  h2Sabor.appendChild(textNode)
  liSabor.appendChild(h2Sabor)
  for (v2 = 1; v2 <= vs; v2++) {
    if (vs >= v2) {
      liSabor.innerHTML =
        liSabor.innerHTML + "<span class='fa fa-star checked'></span>"
    } else {
      liSabor.innerHTML = liSabor.innerHTML + "<span class='fa fa-star'></span>"
    }
  }
  var liAmbiente = document.createElement('li')
  var h2Ambiente = document.createElement('h2')
  var textNode = document.createTextNode('Ambiente')
  h2Ambiente.appendChild(textNode)
  liAmbiente.appendChild(h2Ambiente)
  for (v3 = 1; v3 <= va; v3++) {
    if (va >= v3) {
      liAmbiente.innerHTML =
        liAmbiente.innerHTML + "<span class='fa fa-star checked'></span>"
    } else {
      liAmbiente.innerHTML =
        liAmbiente.innerHTML + "<span class='fa fa-star'></span>"
    }
  }
  ulValor.appendChild(liPrecio)
  ulValor.appendChild(liSabor)
  ulValor.appendChild(liAmbiente)

  //  liComentario.appendChild(imgComentario);
  var h2Fecha = document.createElement('h3')
  var textNode = document.createTextNode(fecha)
  h2Fecha.className = 'title'
  h2Fecha.appendChild(textNode)
  liComentario.appendChild(h2Fecha)
  liComentario.appendChild(nombreComentario)

  liComentario.appendChild(ulValor)

  var pComentario = document.createElement('p')
  pComentario.textContent = comentario
  pComentario.className = 'coment-text'
  liComentario.appendChild(pComentario)
  document.getElementById('lista-coment').appendChild(liComentario)
}

function getComentarios(pagina, sitio) {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
      //console.log(respuesta);
      var elemento = document.getElementById('lista-coment')
      while (elemento.firstChild) {
        elemento.removeChild(elemento.firstChild)
      }
      //console.log(respuesta);
      for (cat of respuesta) {
        agregarComentario(
          'public/res/user.png',
          cat.nombre,
          cat.fecha,
          cat.descripcion,
          cat.valoracionPrecio,
          cat.valoracionAmbiente,
          cat.valoracionSabor,
        )
      }
      getPaginacionID(pagina, sitio, 'Comentarios')
    }
  }
  xmlHttpRequest.open(
    'GET',
    'comentarios?Sitio=' + sitio + '&page=' + pagina,
    true,
  )
  xmlHttpRequest.send()
  event.preventDefault()
}



function setPlatoModal(respuesta, info, img, lista, caract) {
  document.getElementById('plato').style.display = 'block'
  var titulo = document.getElementById('titulo')
  var descripcion = document.getElementById('descripcion')
  var imagen = document.getElementById('imagen-modal')
  titulo.innerHTML = info[0].nombre
  descripcion.innerHTML = info[0].descripcion
  imagen.src = img[0].path
  var Peso = document.getElementById('Peso')
  var Energia = document.getElementById('Energia')
  var Carbo = document.getElementById('Carbo')
  var Proteina = document.getElementById('Proteina')
  var Grasas = document.getElementById('Grasas')
  var Sodio = document.getElementById('Sodio')
  Peso.innerHTML = lista[3].valor
  Energia.innerHTML = lista[0].valor
  Carbo.innerHTML = lista[0].valor
  Proteina.innerHTML = lista[4].valor
  Grasas.innerHTML = lista[2].valor
  Sodio.innerHTML = lista[5].valor
  console.log(caract)
 for (c in caract) {
    console.log(caract[c].nombre)
    if (caract[c].nombre == 'Picante') {
      var Picante = document.getElementById('Picante')
      Picante.src = '/public/svg/chile (1).svg'
      title="Agregar nuevo Sitio"
    } else {
      var Picante = document.getElementById('Picante')
      Picante.src = '/public/svg/chile.svg'
    }
    if (caract[c].nombre == 'Lacteos') {
      var Lacteos = document.getElementById('Lacteos')
      Lacteos.src = '/public/svg/leche.svg'
    } else {
      var Lacteos = document.getElementById('Lacteos')
      Lacteos.src = '/public/svg/leche (1).svg'
    }
    if (caract[c].nombre == 'Gluten') {
      var Gluten = document.getElementById('Gluten')
      Gluten.src = '/public/svg/gluten (1).svg'
    } else {
      var Gluten = document.getElementById('Gluten')
      Gluten.src = '/public/svg/gluten.svg'
    }
    if (caract[c].nombre == 'Vegano') {
      var Vegano = document.getElementById('Vegano')
      Vegano.src = '/public/svg/tomate (1).svg'
    } else {
      var Vegano = document.getElementById('Vegano')
      Vegano.src = '/public/svg/tomate.svg'
    }
    if (caract[c].nombre == 'Azucar') {
      var Azucar = document.getElementById('Azucar')
      Azucar.src = '/public/svg/sugar (1).svg'
    } else {
      var Azucar = document.getElementById('Azucar')
      Azucar.src = '/public/svg/sugar.svg'
    }
    if (caract[c].nombre == 'Sal') {
      var Sal = document.getElementById('Sal')
      Sal.src = '/public/svg/dietetico (1).svg'
    } else {
      var Sal = document.getElementById('Sal')
      Sal.src = '/public/svg/dietetico.svg'
    }
  }
}

function openModal(plato, sitio) {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
      console.log(xmlHttpRequest.responseText)
      var respuesta = JSON.parse(xmlHttpRequest.responseText)
      var info = JSON.parse(respuesta.info)
      var img = JSON.parse(respuesta.img)
      var lista = JSON.parse(respuesta.lista)
      var caract = JSON.parse(respuesta.caract)
      setPlatoModal(respuesta, info, img, lista, caract)
    }
  }
  xmlHttpRequest.open('GET', 'plato?Sitio=' + sitio + '&Plato=' + plato, true)
  xmlHttpRequest.send()
  event.preventDefault()
}

function closeModal() {
  document.getElementById('plato').style.display = 'none'
}

function guardarComentario() {
  var xmlHttpRequest = new XMLHttpRequest()
  xmlHttpRequest.onreadystatechange = function () {
    if (xmlHttpRequest.readyState == 4 && xmlHttpRequest.status == 200) {
     
     var pagina = (JSON.parse(xmlHttpRequest.responseText))
     console.log("pagina"+pagina);
      if ((typeof pagina === 'number') && (pagina > 0) ) {
          const m = document.getElementById('messageBoxResult')
          m.innerHTML = `<div class="alert alert-success" role="alert">
          Comentario Guardado con Exito!</div>`
          document.getElementById('messageBoxResult').scrollIntoView()
          setTimeout(function () {
            m.innerHTML = ''
          }, 5000)
          for (i = 0; i < document.comentario.Precio.length; i++) {
            document.comentario.Precio[i].checked = 1
            document.comentario.Sabor[i].checked = 1
            document.comentario.Ambiente[i].checked = 1
          }
          document.getElementById('nombreComent').value = ''
          document.getElementById('mailComent').value = ''
          document.getElementById('textoComent').value = ''
          document.getElementById('paginacionComentarios').scrollIntoView()
          loadComentarios(pagina, sitio)
      } else {
      
        document.getElementById('nombreComent').value = pagina[0].input;
        document.getElementById('mailComent').value =  pagina[2].input;
        document.getElementById('textoComent').value =  pagina[1].input;
        document.getElementById('help-nombreComent').textContent = pagina[0].mensaje;
        document.getElementById('help-mailComent').textContent =  pagina[2].mensaje;
        document.getElementById('help-textoComent').textContent =  pagina[1].mensaje;
        document.getElementById('nombreComent').classList.add(pagina[0].estado);
        document.getElementById('mailComent').classList.add(pagina[2].estado);
        document.getElementById('textoComent').classList.add(pagina[1].estado);
     
      
      }
    }
  }

  var nombre = document.getElementById('nombreComent').value
  var mail = document.getElementById('mailComent').value
  var texto = document.getElementById('textoComent').value
  var precio = document.querySelector('input[name=Precio]:checked').value
  var sabor = document.querySelector('input[name=Sabor]:checked').value
  var ambiente = document.querySelector('input[name=Ambiente]:checked').value
    xmlHttpRequest.open('POST', 'sendComentario', true)
    xmlHttpRequest.setRequestHeader(
      'Content-type',
      'application/x-www-form-urlencoded',
    )
    xmlHttpRequest.send(
      'sitio=' +
        idSitio +
        '&nombre=' +
        nombre +
        '&mail=' +
        mail +
        '&texto=' +
        texto +
        '&precio=' +
        precio +
        '&sabor=' +
        sabor +
        '&ambiente=' +
        ambiente,
    )
    event.preventDefault()
}


function openTab(evt, Name) {
  // Declare all variables
  var i, tabcontent, tablinks

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName('tabcontent')
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = 'none'
  }
  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName('tablinks')
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(' active', '')
  }
  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(Name).style.display = 'block'
  evt.currentTarget.className += ' active'
  if (Name == 'Ubicacion') {
    agregarMarcadorCentrar(longitud, latitud, idSitio, nombre, path)
  }
  if (Name == 'Platos') {
    loadPlatos(1, idSitio)
  }
  if (Name == 'Valoracion') {
    loadComentarios(1, idSitio)
  }
}
