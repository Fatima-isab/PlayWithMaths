<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener todos los avatares disponibles
$query = "SELECT * FROM avatares";
$resultado = $conn->query($query);

$avatares = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $avatares[] = $fila;
    }
}

// Cerrar la conexión
$conn->close();
?>