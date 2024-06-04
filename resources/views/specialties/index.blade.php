@extends('layout')

@section('title', 'Especialidades')

@section('content')
<div class="container">
    <h1>Especialidades</h1>
    @if (session('success'))
        <div class="card-panel green lighten-4 green-text text-darken-4">{{ session('success') }}</div>
    @endif

    @if (auth()->check() && auth()->user()->isAdmin())
        <div class="row">
            <div class="col s12">
                <a href="{{ route('specialties.create') }}" class="btn waves-effect waves-light green">Nueva Especialidad</a>
            </div>
        </div>
    @endif

    <div class="row">
        @foreach ($specialties as $specialty)
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ $specialty->name }}</span>
                    </div>
                    @if (auth()->check() && auth()->user()->isAdmin())
                        <div class="card-action">
                            <a href="{{ route('specialties.edit', $specialty->id) }}" class="btn blue">Editar</a>
                            <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn red" onclick="return confirm('¿Estás seguro de que quieres eliminar esta especialidad?')">Eliminar</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
