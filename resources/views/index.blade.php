@extends('layout')

@section('title', 'Página Principal')

@section('content')

<section class="section">
    <div class="container">
        <h1 class="center-align">Bienvenido a la Clínica Dental Vitalnova</h1>
        <p class="flow-text">Somos una clínica dental comprometida con la salud bucal y la sonrisa de nuestros pacientes. Nuestro equipo de profesionales altamente calificados está aquí para ofrecerte un servicio de calidad y cuidado personalizado.</p>
    </div>
</section>

<section class="section">
    <div class="slider">
        <ul class="slides">
            <li>
                <img src="img/slider/sonrisa.jpg">
                <div class="caption caption-align-right">
                    <h4>Vitalnova crea sonrisas</h4>
                    <h5 class="light grey-text text-lighten-3">Desde 2024 siendo los mejores</h5>
                </div>
            </li>
            <li>
                <img src="img/slider/implante.jpg">
                <div class="caption caption-align-right">
                    <h4>Déjanos ser parte de tu bienestar</h4>
                    <h5 class="light grey-text text-lighten-3">La felicidad puede ser para todos</h5>
                </div>
            </li>
            <li>
                <img src="img/slider/limpieza.jpg">
                <div class="caption caption-align-right">
                    <h3>Las sonrisas perfectas comienzan en Vitalnova</h3>
                    <h4 class="light grey-text text-lighten-3">Sonríe con confianza, elige Vitalnova</h4>
                </div>
            </li>
            <li>
                <img src="img/slider/contenta.jpg">
                <div class="caption caption-align-right">
                    <h3>Sonrisas que transforman vidas</h3>
                    <h4 class="light grey-text text-lighten-3">Primera visita gratuita</h4>
                </div>
            </li>
        </ul>
    </div>
</section>




<!-- Sección de tratamientos de la base de datos -->
<section class="section grey lighten-4">
    <div class="container">
        <h2 class="center-align">Nuestros Servicios</h2>
        <div class="row">
            @foreach ($specialties as $specialty)
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ $specialty->image }}" alt="imagen">
                            <span class="card-title">{{ $specialty->name }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section">
    <div class="parallax-container">
        <div class="parallax"><img src="img/others/parallax.jpg"></div>
    </div>
</section>




<section class="section lighten-4">
    <div class="container">
        <h2 class="center-align">Últimas Reseñas</h2>
        <div class="carousel">
            @foreach ($latestReviews as $review)
                <div class="carousel-item">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">{{ $review->appointment->user->name }}</span>
                            <p><strong>Reseña:</strong> {{ $review->review }}</p>
                            <p><strong>Puntuación:</strong> {{ $review->score }}/5</p>
                            <p><strong>Fecha:</strong> {{ $review->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@vite(['resources/css/carrousel.css'])


@endsection
