<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- <script src="{{ asset('js/arriba.js') }}"></script> -->
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- <script src="/materialize/materialize.min.js"></script> -->
    <!-- <script src="/materialize/materialize.min.css"></script> -->
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    <!-- <link rel="stylesheet" href="/materialize/materialize.min.css"> -->

    <!-- PRUEBA DE CALENDARIO PARA CITAS -->
    <!-- Incluir los archivos CSS de FullCalendar -->
    <link href="/ruta/a/fullcalendar/core/main.css" rel="stylesheet" />
    <link href="/ruta/a/fullcalendar/daygrid/main.css" rel="stylesheet" />

    <script src="/ruta/a/fullcalendar/core/main.js"></script>
    <script src="/ruta/a/fullcalendar/daygrid/main.js"></script>

    <!-- PAGINA OFICIAL DE FULL CALENDAR -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

    <!-- CALENDARIO IDIOMA ESPAÑOL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/es.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <title>Vitalnova</title>
    @include('partials.nav')

    <title>
        @yield('title')
    </title>
</head>

<body>

    <div class="container mt-5">
        @yield('content')
    </div>

    @include('partials.scroll')

    @include('partials.footer')
</body>

</html>