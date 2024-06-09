@extends('layout')

@section('title', 'Equipo')

@section('content')

<section class="section">
    <div class="container">
        <h2 class="center-align">Nuestro Equipo</h2>

        @if(auth()->check() && auth()->user()->isAdmin())
            <div class="right-align mb-3">
                <a href="{{ route('signupForm') }}" class="btn waves-effect waves-light">Registrar Nuevo Usuario</a>
            </div>
        @endif

        <div class="row">
            <div class="col s12">
                <p class="flow-text center-align">
                    Somos un equipo altamente cualificado, dispuestos a ofrecer los tratamientos más modernos, permitiendo a todos nuestros pacientes una atención global. Abarcamos todos los campos de la Odontología, como por ejemplo Prótesis, Endodoncia, Periodoncia, Ortodoncia e Implantes dentales.
                </p>
            </div>
        </div>


        <!-- Doctores -->
        <div class="row team-row">
            <h2>Doctores</h2>
            @foreach($doctors as $doctor)
                <div class="col s12 m6 l6">
                    <div class="card team-card">
                        <div class="card-image">
                            <img class="activator" src="{{ $doctor->image }}" alt="Doctor">
                            <span class="card-title">{{ $doctor->name }}</span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">{{ $doctor->name }}<i class="material-icons right">close</i></span>
                            <ul>
                                @foreach($doctor->specialties as $specialty)
                                    <li>{{ $specialty->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Recepcionistas -->
        <div class="row team-row">
            <h2>Recepcionistas</h2>
            @foreach($receptionists as $receptionist)
                <div class="col s12 m6 l6">
                    <div class="card team-card">
                        <div class="card-image">
                            <img src="{{ $receptionist->image }}" alt="Receptionist">
                            <span class="card-title">{{ $receptionist->name }}</span>
                        </div>
                        <div class="card-content">
                            <p>{{ $receptionist->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@vite('resources/css/teams.css')

@endsection
