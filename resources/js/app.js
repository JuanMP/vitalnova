import './bootstrap';
import 'materialize-css';
import 'materialize-css/dist/css/materialize.min.css';


//CARROUSEL 2
      document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.carousel');
	var options = {};
    var instances = M.Carousel.init(elems, options);
  });
  //Con jQuery
  $(document).ready(function(){
    $('.carousel').carousel();
  });


  

//BOTON PARA SCROLL DE SUBIDA
$(document).ready(function(){

	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});

	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});

});

//CARROUSEL 2 PRINCIPAL
$(document).ready(function(){
    $('.slider').slider();
  });