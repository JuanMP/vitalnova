<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo center">
            <img src="/img/others/logo.png" class="brand-img" alt="logo">
        </a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
            <li class="active"><a href="{{ route('index') }}">Inicio</a></li>
            <li><a href="{{ route('treatments') }}">Tratamientos</a></li>
            <li><a href="{{ route('teams') }}">Equipo</a></li>
            <li><a href="badges.html">Servicios</a></li>
            <li><a href="collapsible.html">Donde Estamos</a></li>
        </ul>
        @if (!auth()->check())
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ route('signup')}} ">Registarse</a></li>
            <li><a href="{{ route('login')}}">Login</a></li>
        </ul>
        @else
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ route('appointments.index') }}">Citas</a></li>
            <li><a href="{{ route('users.profile') }}">Perfil</a></li>
            <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
        </ul>
    @endif
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="{{ route('index') }}">Inicio</a></li>
    <li><a href="{{ route('treatments') }}">Tratamientos</a></li>
    <li><a href="{{ route('teams') }}">Equipo</a></li>
    <li><a href="badges.html">Servicios</a></li>
    <li class="active"><a href="collapsible.html">Donde Estamos</a></li>
    <li><a href="{{ route('login')}}">Login</a></li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
</script>
