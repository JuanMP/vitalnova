@extends('layout')

@section('title', 'Página de Registro')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
                <h2 class="card-header">Registro</h2>
                <div class="card-body">
                    <form action="{{ route('signup') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="birthday" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="birthday" id="birthday" value="{{ old('birthday') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </form>
                    @if($errors->any())
                        <div class="mt-3">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
        </div>
    </div>
</div>

@endsection
