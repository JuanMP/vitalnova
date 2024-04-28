@extends('layout')

@section('title', 'Página Principal')

@section('content')

<section class="section">
    <div class="container">
        <h1 class="center-align">Bienvenido a la Clínica Dental</h1>
        <p class="flow-text">Somos una clínica dental comprometida con la salud bucal y la sonrisa de nuestros pacientes. Nuestro equipo de profesionales altamente calificados está aquí para ofrecerte un servicio de calidad y cuidado personalizado.</p>
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
@endsection
