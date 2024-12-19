<?php 
session_start(); 

// Verificar si el usuario está autenticado
if (!isset($_SESSION['empleado_id'])) {     
    header('Location: login.php');     
    exit(); 
}  

include('conexion.php');  

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
    // Obtener los datos del formulario
    $empleado_id = $_SESSION['empleado_id']; 
    $fecha = $_POST['fecha']; 
    $hora_entrada = $_POST['hora_entrada']; 
    $hora_salida = $_POST['hora_salida']; 

    // Preparar la consulta SQL
    try {
        $stmt = $pdo->prepare("INSERT INTO horarios (empleado_id, fecha, hora_entrada, hora_salida) VALUES (?, ?, ?, ?)");
        $stmt->execute([$empleado_id, $fecha, $hora_entrada, $hora_salida]);
        echo "Horario agregado con éxito.";
    } catch (Exception $e) {
        // Mostrar error si algo falla
        echo "Error al agregar el horario: " . $e->getMessage();
    }
}
?>  

<!DOCTYPE html> 
<html lang="es"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Agregar Horario</title>     
    <link rel="stylesheet" href="estilos.css"> 
</head> 
<body>     
    <h1>Agregar Horario</h1>     
    <form method="POST">         
        <label for="fecha">Fecha:</label>         
        <input type="date" name="fecha" required>         
        
        <label for="hora_entrada">Hora de Entrada:</label>         
        <input type="time" name="hora_entrada" required>         
        
        <label for="hora_salida">Hora de Salida:</label>         
        <input type="time" name="hora_salida" required>         
        
        <button type="submit">Agregar Horario</button>     
    </form> 
</body>
</html>
