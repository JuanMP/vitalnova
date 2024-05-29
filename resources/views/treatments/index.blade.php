@extends('layout')

@section('title', 'Tratamientos')

@section('content')
<div class="container">
    <h1>Tratamientos</h1>

    @if(auth()->check() && auth()->user()->isAdmin())
        <a href="{{ route('treatments.create') }}" class="btn btn-primary">Nuevo Tratamiento</a>
    @endif

    <div class="row">
        @foreach($treatments as $treatment)
            <div class="col s12 m6">
                <div class="card hoverable">
                    <div class="card-image">
                        <img src="{{ $treatment->image }}" alt="{{ $treatment->title }}">
                        <span class="card-title">{{ $treatment->title }}</span>
                    </div>
                    <div class="card-content">
                        <p>{{ $treatment->description }}</p>
                        <p>{{ $treatment->cost }} €</p>
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
@endsection
