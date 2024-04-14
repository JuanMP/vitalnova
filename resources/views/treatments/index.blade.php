@extends('layout')

@section('title', 'Tratamientos')

@section('content')

<section class="section">
    <div class="container">
        <h2 class="center-align">Nuestros Tratamientos</h2>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                        <img src="images/tratamiento1.jpg" alt="Tratamiento 1">
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
                <div class="card">
                    <div class="card-image">
                        <img src="images/tratamiento2.jpg" alt="Tratamiento 2">
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
            <!-- Agrega más tarjetas de tratamiento según sea necesario -->
        </div>
    </div>
</section>


@endsection
