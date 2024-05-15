<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <!-- <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <!-- <script src="{{ asset('js/arriba.js') }}"></script> -->
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <!-- <script src="/materialize/materialize.min.js"></script> -->
    <!-- <script src="/materialize/materialize.min.css"></script> -->
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
    <!-- <link rel="stylesheet" href="/materialize/materialize.min.css"> -->

    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    <title>Vitalnova</title>
    @include('partials.nav')

    <title>
        @yield('title')
    </title>
</head>
<body>

    <div class="container mt-5 prueba">
    @yield('content')
    </div>

    @include('partials.scroll')

    @include('partials.footer')
</body>
</html>
