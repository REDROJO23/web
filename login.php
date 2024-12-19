<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('conexion.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM empleados WHERE email = ?");
    $stmt->execute([$email]);
    $empleado = $stmt->fetch();

    if ($empleado && password_verify($password, $empleado['password'])) {
        $_SESSION['empleado_id'] = $empleado['id'];
        header('Location: panel.php');
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form method="POST">
        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" required>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
