@extends('layout')

@section('title', 'Equipo')

@section('content')

<section class="section">
    <div class="container">
        <h2 class="center-align">Nuestro Equipo</h2>
        <div class="row">
            <div class="col s12">
                <p class="flow-text center-align">
                    Somos un equipo altamente cualificado, dispuestos a ofrecer los tratamientos más modernos, permitiendo a todos nuestros pacientes una atención global. Abarcamos todos los campos de la Odontología, como por ejemplo Prótesis, Endodoncia, Periodoncia, Ortodoncia e Implantes dentales.
                </p>
            </div>
        </div>
        <div class="row">
            @foreach($doctors as $doctor)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset('img/others/doctor.jpg') }}" alt="Doctor">
                            <span class="card-title">{{ $doctor->name }}</span>
                        </div>
                        <div class="card-content">
                            <p>{{ $doctor->specialty}}</p>
                            <p>{{ $doctor->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            @foreach($receptionists as $receptionist)
                <div class="col s12 m6">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset('img/others/receptionist.jpg') }}" alt="Receptionist">
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

@endsection
