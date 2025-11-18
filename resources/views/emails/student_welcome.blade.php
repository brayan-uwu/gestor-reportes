<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido a la Escuela!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Hola {{ $student->name }}!</h1>
        <p>¡Bienvenido a nuestra escuela!</p>
    </div>

    <div class="content">
        <p>Tu cuenta ha sido activada exitosamente. Ahora puedes acceder al sistema de reportes escolares.</p>

        <p><strong>Detalles de tu cuenta:</strong></p>
        <ul>
            <li><strong>Nombre:</strong> {{ $student->name }}</li>
            <li><strong>Grupo:</strong> {{ $student->group }}</li>
            <li><strong>Matrícula:</strong> {{ $student->enrollment }}</li>
            <li><strong>Email:</strong> {{ $student->email }}</li>
        </ul>

        <p>Puedes acceder al sistema en: <a href="{{ url('/student') }}">Panel de Estudiante</a></p>

        <p>Si tienes alguna duda, no dudes en contactar a la administración.</p>

        <p>¡Esperamos que tengas una excelente experiencia en nuestra escuela!</p>
    </div>

    <div class="footer">
        <p>Este es un mensaje automático. Por favor, no respondas a este correo.</p>
        <p>&copy; {{ date('Y') }} Escuela. Todos los derechos reservados.</p>
    </div>
</body>
</html>
