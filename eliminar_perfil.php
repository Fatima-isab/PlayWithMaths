<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: registro.php");
    session_destroy();
    die();
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

$id = $_SESSION['usuario'];

// Eliminar el perfil y redirigir al usuario a la página de registro
$query = "DELETE FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();

$stmt->close();
$conn->close();

// Redirigir a la página de registro después de eliminar el perfil
header("location: php/registro_usuario.php");
exit();
?>
