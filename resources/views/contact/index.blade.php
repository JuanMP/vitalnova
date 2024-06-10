@extends('layout')

@section('title', 'Contacto')

@section('content')
<section class="section">
  <div class="container-fluid">
    <h2 class="center-align">Contacto</h2>
    <div class="row">
      <div class="col s12 m8">
        <h5>Ubicación</h5>
        <div class="card">
          <div class="card-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3079.8169497522513!2d-0.3405447882154751!3d39.473463871488306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd604888312537bf%3A0x69f4b68668666586!2sC.%20de%20Jos%C3%A9%20Mar%C3%ADa%20Haro%2C%2063%2C%20Algir%C3%B3s%2C%2046022%20Valencia!5e0!3m2!1ses!2ses!4v1717996525814!5m2!1ses!2ses" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
      <div class="col s12 m4">
        <h5>Información de Contacto</h5>
        <div class="card">
          <div class="card-content">
            <h6>Teléfonos</h6>
            <p>961432236</p>
            <p>722718349</p>
            <h6>Redes Sociales</h6>
            <p>
            <a href="https://www.facebook.com" target="_blank">
                        <i class="fab fa-facebook fa-2x"></i> Facebook</a></li>
            <a href="https://www.x.com" target="_blank">
                        <i class="fab fa-twitter fa-2x"></i> Twitter</a></li>
            <a href="https://www.instagram.com" target="_blank">
                        <i class="fab fa-instagram fa-2x"></i> Instagram</a></li>
            </p>
          </div>
        </div>
        <h5>Horario</h5>
        <div class="card">
          <div class="card-content">
            <table>
              <thead>
                <tr>
                  <th>Día</th>
                  <th>Horario</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Lunes</td>
                  <td>9:00 - 18:00</td>
                </tr>
                <tr>
                  <td>Martes</td>
                  <td>9:00 - 18:00</td>
                </tr>
                <tr>
                  <td>Miércoles</td>
                  <td>9:00 - 18:00</td>
                </tr>
                <tr>
                  <td>Jueves</td>
                  <td>9:00 - 18:00</td>
                </tr>
                <tr>
                  <td>Viernes</td>
                  <td>9:00 - 18:00</td>
                </tr>
                <tr>
                  <td>Sábado</td>
                  <td>9:00 - 18:00</td>
                </tr>
                <tr>
                  <td>Domingo</td>
                  <td>Cerrado</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
