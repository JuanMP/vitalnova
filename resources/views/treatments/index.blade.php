@extends('layout')

@section('title', 'Tratamientos')

@section('content')

<!-- Sección de Parallax -->
{{-- <div class="parallax-container">
    <div class="parallax"><img src="img/slider/sonrisa.jpg"></div></div> --}}

<section class="section white">
    <div class="container">
        <h2 class="center-align">Nuestros Tratamientos</h2>
        <div class="row">
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="img/treatments/ortodoncia.png" alt="Ortodoncia">
                        <span class="card-title">Ortodoncia</span>
                    </div>
                    <div class="card-content">
                        <p>La ortodoncia es la rama de la odontología que se encarga de corregir la posición de los dientes y la mandíbula. En nuestra clínica, ofrecemos tratamientos de ortodoncia para niños, adolescentes y adultos.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="img/treatments/implantes.png" alt="Implantes Dentales" class="small-image">
                        <span class="card-title">Implantes Dentales</span>
                    </div>
                    <div class="card-content">
                        <p>Los implantes dentales son una solución permanente para reemplazar dientes perdidos. Consisten en un tornillo de titanio que se inserta en el hueso maxilar, sobre el cual se coloca una corona dental.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="img/treatments/prevencion.png" alt="Blanqueamiento Dental">
                        <span class="card-title">Blanqueamiento Dental</span>
                    </div>
                    <div class="card-content">
                        <p>El blanqueamiento dental es un procedimiento estético que permite aclarar el color de los dientes para obtener una sonrisa más blanca y brillante. Utilizamos técnicas avanzadas para garantizar resultados seguros y efectivos.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="img/treatments/endodoncia.png" alt="Endodoncia">
                        <span class="card-title">Endodoncia</span>
                    </div>
                    <div class="card-content">
                        <p>La endodoncia, también conocida como tratamiento de conductos, es un procedimiento para eliminar infecciones del interior del diente y protegerlo de futuras infecciones. Es esencial para salvar dientes severamente dañados o infectados.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="img/treatments/estetica.png" alt="Limpieza Dental">
                        <span class="card-title">Limpieza Dental</span>
                    </div>
                    <div class="card-content">
                        <p>La limpieza dental profesional es fundamental para mantener una buena salud bucal. Nuestros higienistas dentales utilizan herramientas especializadas para eliminar la placa y el sarro, prevenir enfermedades periodontales y mantener tus dientes y encías saludables.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Más información</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="img/treatments/periodoncia.png" alt="Carillas Dentales">
                        <span class="card-title">Periodoncia</span>
                    </div>
                    <div class="card-content">
                        <p>La periodoncia dentales son laminados delgados que se colocan sobre la parte frontal de los dientes para mejorar su apariencia. Son ideales para corregir dientes descoloridos, desgastados, astillados o desalineados.</p>
                    </div>
                    <div class="card-action">
                        <a href="#">Más información</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="parallax-container">
    <div class="parallax"><img src="img/slider/implante.jpg" alt="Equipo Dental"></div>
</div>

<div class="carousel">
    <a class="carousel-item" href="#one!"><img src="img\demo\f1.jpg"></a>
    <a class="carousel-item" href="#two!"><img src="img\demo\f2.jpg"></a>
    <a class="carousel-item" href="#three!"><img src="img\demo\f3.jpg"></a>
    <a class="carousel-item" href="#four!"><img src="img\demo\f4.jpg"></a>
    <a class="carousel-item" href="#five!"><img src="img\demo\f5.jpg"></a>
  </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.parallax');
        var instances = M.Parallax.init(elems);
    });

    $(document).ready(function(){
    $('.parallax').parallax();
  });


</script>
@endsection


