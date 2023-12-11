<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: php/registro.php");
    exit();
}

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

$id = $_SESSION['id_usuario'];

// Eliminar el perfil
$query = "DELETE FROM usuarios WHERE id_usuario = '$id'";
$result = $conn->query($query);

if ($result) {
    // Limpiar y destruir la sesión
    session_unset();
    session_destroy();

    // Redirigir a la página de registro después de eliminar el perfil
    header("location: php/registro.php");
    exit();
} else {
    echo "Error al eliminar el perfil: " . $conn->error;
}

$conn->close();
?>


