<!DOCTYPE html>
<html>
<head>
    <title>Registro Exitoso</title>
</head>
<body>
    <h1>¡Bienvenido, {{ $user->name }}!</h1>
    <p>Gracias por registrarte en nuestra plataforma. A continuación, te mostramos los detalles de tu registro:</p>

    <ul>
        <li><strong>Nombre:</strong> {{ $user->name }} {{ $user->surname }}</li>
        <li><strong>Teléfono:</strong> {{ $user->phone }}</li>
        <li><strong>Dirección:</strong> {{ $user->address }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Contraseña:</strong> {{ $password }}</li> <!-- Agregar la contraseña -->
    </ul>

    <p>¡Gracias por confiar en nosotros!</p>
</body>
</html>
