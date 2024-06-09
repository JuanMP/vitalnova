@extends('layout')

@section('title', 'Tratamientos')

@section('content')
<div class="container">
    <h1 class="center-align">Tratamientos</h1>

    @if(auth()->check() && auth()->user()->isAdmin())
        <div class="right-align mb-3">
            <a href="{{ route('treatments.create') }}" class="btn waves-effect waves-light">Nuevo Tratamiento</a>
        </div>
    @endif

    <div class="row">
        @foreach($treatments as $treatment)
            <div class="col s12 m6">
                <div class="card treatment-card"> <!-- Clase específica para las tarjetas de tratamiento -->
                    <div class="card-image">
                        <img src="{{ $treatment->image }}" alt="{{ $treatment->title }}">
                        <span class="card-title">{{ $treatment->title }}</span>
                    </div>
                    <div class="card-content">
                        <p><strong>Precio:</strong> {{ $treatment->cost }}€</p>
                        <p>{{ $treatment->description }}</p>
                    </div>
                    @if(auth()->check() && auth()->user()->isAdmin())
                    <div class="card-action">
                        <a href="{{ route('treatments.edit', $treatment) }}" class="btn btn-secondary">Editar</a>
                        <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@vite('resources/css/treatments.css')

@endsection
