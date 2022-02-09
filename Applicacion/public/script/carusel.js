var posicionActual = 0;
var l = document.getElementsByClassName("mySlides").length;
const TIEMPO_INTERVALO_MILESIMAS_SEG =2000;

window.addEventListener('DOMContentLoaded', (event) => {
  showSlides(posicionActual);
  
  var l = document.getElementsByClassName("mySlides").length;
  //intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
  
// Next/previous controls
function pasarFoto() {
  if(posicionActual >= l - 1) {
    posicionActual = 0;
  } else {
    posicionActual++;
  }
  showSlides(posicionActual)
}

function retrocederFoto() {

  if(posicionActual <= 0) {
      posicionActual = l - 1;
  } else {
      posicionActual--;
  }
  showSlides(posicionActual)
}

// Thumbnail image controls
function currentSlide(n) {
  posicionActual =  n;
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" activo", "");
  }
  slides[n].style.display = "block";
  dots[n].className += " activo";
}

document.getElementById("next").addEventListener('click', pasarFoto);
document.getElementById("prev").addEventListener('click', retrocederFoto);
intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);

});

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");

  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" activo", "");
  }
  slides[n].style.display = "block";
  dots[n].className += " activo";
}

