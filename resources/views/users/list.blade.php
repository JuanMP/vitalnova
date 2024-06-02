@extends('layout')

@section('title', 'Lista de Usuarios')

@section('content')
<div class="container">
    <h1>Lista de Usuarios</h1>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('users.list') }}" method="GET">
        <div class="input-field">
            <input type="text" name="search" id="search" value="{{ request()->get('search') }}">
            <label for="search">Buscar Pacientes</label>
        </div>
        <button type="submit" class="btn">Buscar</button>
    </form>

    @if($users->isEmpty())
        <p>No hay usuarios disponibles.</p>
    @else
        <table class="highlight">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->dni }}</td>
                        <td>{{ $user->telephone }}</td>
                        <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'No disponible' }}</td>
                        <td>
                            <a href="{{ route('appointments.create', ['user_id' => $user->id]) }}" class="btn">
                                <i class="material-icons">event</i> Añadir Cita
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
