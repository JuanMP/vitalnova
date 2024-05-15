@extends('layout')

@section('title', 'Página Principal')

@section('content')

<section class="section">
    <div class="container">
        <h1 class="center-align">Bienvenido a la Clínica Dental</h1>
        <p class="flow-text">Somos una clínica dental comprometida con la salud bucal y la sonrisa de nuestros pacientes. Nuestro equipo de profesionales altamente calificados está aquí para ofrecerte un servicio de calidad y cuidado personalizado.</p>
    </div>
</section>

<section class="section">

<div class="slider">
    <ul class="slides">
      <li>
        <img src="img/slider/sonrisa.jpg">
        <div class="caption center-align">
          <h4>Vitalnova crea sonrisas</h4>
          <h5 class="light grey-text text-lighten-3">Desde 2024 siendo los mejores</h5>
        </div>
      </li>
      <li>
        <img src="img/slider/implante.jpg">
        <div class="caption left-align">
          <h4>Déjanos ser parte de tu bienestar</h4>
          <h5 class="light grey-text text-lighten-3">La felicidad puede ser para todos</h5>
        </div>
      </li>
      <li>
        <img src="img/slider/limpieza.jpg">
        <div class="caption right-align">
          <h3>Las sonrisas perfectas comienzan en Vitalnova</h3>
          <h4 class="light grey-text text-lighten-3">Sonríe con confianza, elige Vitalnova</h4>
        </div>
      </li>
      <li>
        <img src="img/slider/contenta.jpg">
        <div class="caption center-align">
          <h3>Sonrisas que transforman vidas</h3>
          <h4 class="light grey-text text-lighten-3">Primera visita gratuita</h4>
        </div>
      </li>
    </ul>
  </div>

</section>


<section class="section grey lighten-4">
    <div class="container">
        <h2 class="center-align">Nuestros Servicios</h2>
        <div class="row">
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Odontología General</span>
                        <p>Ofrecemos una amplia gama de servicios de odontología general, incluyendo limpiezas, exámenes de rutina, empastes, y más.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Ortodoncia</span>
                        <p>Nuestros especialistas en ortodoncia están aquí para ayudarte a lograr una sonrisa hermosa y alineada.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Implantología</span>
                        <p>Restauramos la función y estética dental mediante la colocación de implantes dentales de alta calidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
<div class="carousel">
    <a class="carousel-item" href="#one!"><img src="img\demo\f1.jpg"></a>
    <a class="carousel-item" href="#two!"><img src="img\demo\f2.jpg"></a>
    <a class="carousel-item" href="#three!"><img src="img\demo\f3.jpg"></a>
    <a class="carousel-item" href="#four!"><img src="img\demo\f4.jpg"></a>
    <a class="carousel-item" href="#five!"><img src="img\demo\f5.jpg"></a>
  </div>
</section>
@endsection
