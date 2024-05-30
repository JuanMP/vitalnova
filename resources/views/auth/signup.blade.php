@extends('layout')

@section('title', 'Página de Registro')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="card-header">Registro</h2>
            <div class="card-body">
                <form action="{{ route('signup') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="dni" id="dni" value="{{ old('dni') }}">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone') }}">
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

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-control" name="rol" id="rol">
                                <option value="receptionist">Recepcionista</option>
                                <option value="doctor">Doctor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-3" id="specialty_field" style="display: none;">
                            <label for="specialty" class="form-label">Especialidad</label>
                            <select class="form-control" name="specialty" id="specialty">
                                <option value="hygienist">Higienista</option>
                                <option value="dentist">Dentista</option>
                                <option value="orthodontist">Ortodoncista</option>
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="rol" value="user">
                    @endif

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var rolSelect = document.getElementById('rol');
    var specialtyField = document.getElementById('specialty_field');

    if (rolSelect) {
        rolSelect.addEventListener('change', function() {
            if (this.value === 'doctor') {
                specialtyField.style.display = 'block';
            } else {
                specialtyField.style.display = 'none';
            }
        });

        if (rolSelect.value === 'doctor') {
            specialtyField.style.display = 'block';
        }
    }
});
</script>

@endsection
