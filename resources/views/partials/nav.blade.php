<nav>
    <div class="nav-wrapper">
        <a href="/" class="brand-logo center">
            <img src="/img/others/logo.png" class="brand-img" alt="logo">
        </a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <ul class="left hide-on-med-and-down">
            <li class="{{ request()->routeIs('index') ? 'active' : '' }}"><a href="{{ route('index') }}">Inicio</a></li>
            <li class="{{ request()->routeIs('treatments.index') ? 'active' : '' }}">
                <a href="{{ route('treatments.index') }}">
                    @if (auth()->check() && auth()->user()->isDoctor())
                        Mis Tratamientos
                    @else
                        Tratamientos
                    @endif
                </a>
            </li>
            @if (auth()->check() && auth()->user()->rol === 'receptionist')
                <li class="{{ request()->routeIs('users.list') ? 'active' : '' }}"><a href="{{ route('users.list') }}">Pacientes</a></li>
            @endif
            <li class="{{ request()->routeIs('specialties.index') ? 'active' : '' }}"><a href="{{ route('specialties.index') }}">Especialidades</a></li>
            <li class="{{ request()->routeIs('teams.index') ? 'active' : '' }}"><a href="{{ route('teams.index') }}">Equipo</a></li>
            @if (!auth()->check() || !auth()->user()->isAdmin())
                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Donde Estamos</a></li>
            @endif
        </ul>
        @if (!auth()->check())
            <ul class="right hide-on-med-and-down">
                <li class="{{ request()->routeIs('signupForm') ? 'active' : '' }}"><a href="{{ route('signupForm') }}">Registrarse</a></li>
                <li class="{{ request()->routeIs('loginForm') ? 'active' : '' }}"><a href="{{ route('loginForm') }}">Login</a></li>
            </ul>
        @else
            <ul class="right hide-on-med-and-down">
                <li class="{{ request()->routeIs('appointments.index') ? 'active' : '' }}"><a href="{{ route('appointments.index') }}">Citas</a></li>
                <li class="{{ request()->routeIs('users.profile') ? 'active' : '' }}"><a href="{{ route('users.profile') }}">Perfil</a></li>
                <li><a href="{{ route('logout') }}">Cerrar Sesión</a></li>
            </ul>
        @endif
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li class="{{ request()->routeIs('index') ? 'active' : '' }}"><a href="{{ route('index') }}">Inicio</a></li>
    <li class="{{ request()->routeIs('treatments.index') ? 'active' : '' }}"><a href="{{ route('treatments.index') }}">Tratamientos</a></li>
    <li class="{{ request()->routeIs('specialties.index') ? 'active' : '' }}"><a href="{{ route('specialties.index') }}">Especialidades</a></li>
    <li class="{{ request()->routeIs('teams.index') ? 'active' : '' }}"><a href="{{ route('teams.index') }}">Equipo</a></li>
    <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}">Donde Estamos</a></li>
    <li class="{{ request()->routeIs('loginForm') ? 'active' : '' }}"><a href="{{ route('loginForm') }}">Login</a></li>
</ul>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
    });
</script>
