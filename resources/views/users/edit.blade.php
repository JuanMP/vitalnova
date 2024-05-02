@extends('layout')

@section('title', 'Editar')

@section('content')


<form action="{{ route('users.update', $user) }}" method="post">

        @csrf
        @method('put')

        <label for="name">Nombre: </label>
        <input type="text" name="name" id="name" value="{{ $user->name }}">

        <label for="birthday">Fecha de nacimiento: </label>
        <input type="date" name="birthday" id="birthday" value="{{ $user->birthday }}">

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
