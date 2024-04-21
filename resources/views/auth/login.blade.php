@extends('layout')

@section('title', 'Login')

@section('content')

<style>
    body {
      background-color: #f2f7ff; /* Color de fondo */
    }
    #login-container {
      max-width: 600px;
      margin: 50px auto; /* Ajusta la margen superior e inferior */
    }
    #login-container img {
      max-width: 100%;
      height: auto;
    }
  </style>

  <div id="login-container" class="row">
    <div class="col s12 m6">
      <img src="/img/others/login2.jpg" alt="Logo Clínica Dental">
    </div>
    <div class="col s12 m6">
        <h4 id="login-title">Iniciar Sesión</h4>
      <form action="{{ route('login') }}" method="post">
        <div class="row">
          <div class="input-field col s12">
            <input id="usuario" type="text" class="validate">
            <label for="usuario">Usuario</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="contrasena" type="password" class="validate">
            <label for="contrasena">Contraseña</label>
          </div>
        </div>
        <div class="row">
          <div class="col s12">
            <label>
              <input type="checkbox" class="filled-in" />
              <span>Recordar usuario</span>
            </label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Iniciar sesión
              <i class="material-icons right">send</i>
            </button>
          </div>
          <div class="col s12">
            <p class="center-align">¿No tienes una cuenta? <a href="#">Registrarse</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>

@endsection

