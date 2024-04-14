@extends('layout')

@section('title', 'Equipo')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipo - Clínica Dental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <header>
        <nav class="blue darken-4">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo">Clínica Dental</a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="tratamientos.html">Tratamientos</a></li>
                        <li><a href="equipo.html">Equipo</a></li>
                        <li><a href="contacto.html">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <ul class="sidenav" id="mobile-nav">
            <li><a href="index.html">Inicio</a></li>
            <li><a href="tratamientos.html">Tratamientos</a></li>
            <li><a href="equipo.html">Equipo</a></li>
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
    </header>

    <main>
        <section class="section">
            <div class="container">
                <h2 class="center-align">Nuestro Equipo</h2>
                <div class="row">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="images/odontologo.jpg" alt="Odontólogo">
                                <span class="card-title">Dr. Juan Pérez</span>
                            </div>
                            <div class="card-content">
                                <p>El Dr. Juan Pérez es nuestro odontólogo principal. Con años de experiencia y una pasión por la odontología, el Dr. Pérez se compromete a proporcionar atención dental de calidad a todos nuestros pacientes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="images/ortodoncista.jpg" alt="Ortodoncista">
                                <span class="card-title">Dra. María García</span>
                            </div>
                            <div class="card-content">
                                <p>La Dra. María García es nuestra especialista en ortodoncia. Su enfoque experto y su dedicación garantizan resultados sobresalientes para pacientes de todas las edades que desean una sonrisa hermosa y alineada.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="images/auxiliar.jpg" alt="Auxiliar">
                                <span class="card-title">María López</span>
                            </div>
                            <div class="card-content">
                                <p>María López es nuestra asistente dental. Con su atención al detalle y su amabilidad, María se asegura de que cada paciente se sienta cómodo y bien atendido durante su visita a nuestra clínica.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="card">
                            <div class="card-image">
                                <img src="images/recepcionista.jpg" alt="Recepcionista">
                                <span class="card-title">Laura Martínez</span>
                            </div>
                            <div class="card-content">
                                <p>Laura Martínez es nuestra recepcionista. Con su cálida bienvenida y su eficiente organización, Laura se encarga de que cada paciente tenga una experiencia agradable desde el momento en que entra por la puerta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="page-footer blue darken-4">
        <div class="container">
            <div class="row">
                <div class="col s12 m6">
                    <h5 class="white-text">Contáctanos</h5>
                    <p class="grey-text text-lighten-4">Estamos aquí para ayudarte. Si tienes alguna pregunta o necesitas más información, no dudes en contactarnos.</p>
                </div>
                <div class="col s12 m6">
                    <h5 class="white-text">Síguenos</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2024 Clínica Dental
                <a class="grey-text text-lighten-4 right" href="#!">Política de Privacidad</a>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
</body>
</html>


@endsection
