@extends('layout')

@section('title', 'Perfil')

@section('content')

<div class="container">
  <div class="row">
    <div class="col s12">
      <h5 class="center-align">Página de Perfil</h5>
      <div class="profile-content">
        <div class="profile-image">
          <img src="{{ asset('img/others/login2.jpg') }}" alt="Profile Picture" class="responsive-img">
        </div>
        <div class="profile-details">
          <span class="profile-name">{{ $user->name }}</span>
          <p class="profile-role">{{ $user->rol }}</p>
          <div class="divider"></div>
          <div class="row">
            <div class="col s12 m6">
              <div class="row">
                <div class="col s6">
                  <i class="material-icons prefix">account_box</i>
                  <span>Nombre de usuario:</span>
                  <p>{{ $user->username }}</p>
                </div>
                <div class="col s6">
                  <i class="material-icons prefix">email</i>
                  <span>Correo electrónico:</span>
                  <p>{{ $user->email }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col s6">
                  <i class="material-icons prefix">cake</i>
                  <span>Fecha de nacimiento:</span>
                  <p>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') : 'No disponible' }}</p>
                </div>
              </div>
            </div>
            <div class="col s12 m6">
              <div class="row">
                <div class="col s6">
                  <i class="material-icons prefix">phone</i>
                  <span>Teléfono:</span>
                  <p>{{ $user->phone }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="profile-action center-align">
          <a href="{{ route('users.edit', $user) }}" class="waves-effect waves-light btn-large">Editar perfil</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
