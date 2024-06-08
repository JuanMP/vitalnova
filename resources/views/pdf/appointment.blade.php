<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justificante de Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin-bottom: 10px;
        }
        .details strong {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $logoSrc }}" alt="Logo Vitalnova">
            <h1>Justificante de Cita</h1>
        </div>

        <div class="details">
            <p><strong>Fecha:</strong> {{ $appointment->date }}</p>
            <p><strong>Hora de Inicio:</strong> {{ $appointment->appointment_start }}</p>
            <p><strong>Hora de Finalización:</strong> {{ $appointment->appointment_end }}</p>
            <p><strong>Doctor:</strong> {{ $appointment->doctor->name }}</p>
            <p><strong>Tratamiento:</strong> {{ $appointment->treatment->title }}</p>
            <p><strong>Coste:</strong> {{ $appointment->treatment->cost }} €</p>
            <p><strong>Nombre:</strong> {{ $appointment->user->name }}</p>
            <p><strong>Email:</strong> {{ $appointment->user->email }}</p>
            <p><strong>Observaciones:</strong> {{ $appointment->observations }}</p>
        </div>
    </div>
</body>
</html>
