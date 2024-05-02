@extends('layout')

@section('title', 'Editar')

@section('content')

<form action="{{ route('users.update', $user) }}" method="post">
    @csrf
    @method('put')

    <div class="mb-3">
        <label for="name">Nombre: </label>
        <input type="text" name="name" id="name" value="{{ $user->name }}">
    </div>

    <div class="mb-3">
        <label for="dni">DNI: </label>
        <input type="text" name="dni" id="dni" value="{{ $user->dni }}">
    </div>


    <div class="mb-3">
        <label for="birthday">Fecha de nacimiento: </label>
        <input type="date" name="birthday" id="birthday" value="{{ $user->birthday }}">
    </div>

    <div class="mb-3">
        <label for="telephone">Teléfono: </label>
        <input type="text" name="telephone" id="telephone" value="{{ $user->telephone }}">
    </div>

    <input type="submit" value="Confirmar">
</form>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

@endsection
