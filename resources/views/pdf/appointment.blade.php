<!-- resources/views/pdf/appointment.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        .appointment-details {
            margin-top: 20px;
        }
        .appointment-details p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de la Cita</h1>
        <div class="appointment-details">
            <p><strong>Fecha:</strong> {{ $date }}</p>
            <p><strong>Hora:</strong> {{ $time }}</p>
            <p><strong>Especialista:</strong> {{ $specialist }}</p>
            <p><strong>Comentario:</strong> {{ $comentario }}</p>
            <p><strong>Usuario:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

        </div>
    </div>
</body>
</html>
