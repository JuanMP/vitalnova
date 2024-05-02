@extends('layout')

@section('title', 'Página de Login')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col s12">
      <div class="row no-margin">
        <div class="col m6 s12" style="height: 500px; padding: 20px;">
          <img src="img/others/login.png" alt="Logo" class="responsive-img" style="max-height: 100%;">
        </div>
        <div class="col m6 s12" style="height: 500px; padding: 20px;">
          <h2 class="card-title center-align">Iniciar Sesión</h2>
          <form action="{{ route('login') }}" method="post" class="validate">
            @csrf
            <div class="row">
              <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" id="username" name="email" class="validate" value="{{ old('email') }}" required>
                <label for="email">Correo Electrónico</label>
                <span class="helper-text" data-error="Campo obligatorio"></span>
              </div>
              <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input type="password" id="password" name="password" class="validate" required>
                <label for="password">Contraseña</label>
                <span class="helper-text" data-error="Campo obligatorio"></span>
              </div>
            </div>
            <div class="row">
              <div class="col s6">
                <p>
                  <label>
                    <input type="checkbox" id="remember" name="remember">
                    <span>Recordar contraseña</span>
                  </label>
                </p>
              </div>
              <div class="col s6 right-align">
                <button type="submit" class="btn waves-effect waves-light light-blue darken-2">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
