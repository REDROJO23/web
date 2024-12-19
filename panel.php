<?php
session_start();
if (!isset($_SESSION['empleado_id'])) {
    header('Location: login.php');
    exit();
}

include('conexion.php');

$empleado_id = $_SESSION['empleado_id'];
$stmt = $pdo->prepare("SELECT * FROM horarios WHERE empleado_id = ? ORDER BY fecha DESC");
$stmt->execute([$empleado_id]);
$horarios = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Horarios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1><center>Bienvenido a tus horarios Anastasio<cente></h1>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Hora de Entrada</th>
            <th>Hora de Salida</th>
        </tr>
        <?php foreach ($horarios as $horario): ?>
            <tr>
                <td><?= $horario['fecha'] ?></td>
                <td><?= $horario['hora_entrada'] ?></td>
                <td><?= $horario['hora_salida'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>