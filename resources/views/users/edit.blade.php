@extends('layout')

@section('title', 'Editar Perfil')

@section('content')

<div class="container">
    <div class="row">
        <div class="col s12">
            <h5 class="center-align">Editar Perfil</h5>
            <div class="card">
                <div class="card-content">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                <label for="name" class="active">Nombre completo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                                <label for="email" class="active">Correo electrónico</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="dni" id="dni" value="{{ old('dni', $user->dni) }}" required>
                                <label for="dni" class="active">DNI</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $user->telephone) }}" required>
                                <label for="telephone" class="active">Teléfono</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="date" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday) }}" required>
                                <label for="birthday" class="active">Fecha de nacimiento</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span>Subir Imagen</span>
                                    <input type="file" name="image" id="image">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn waves-effect waves-light">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
