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

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["avatar"])) {
        // Actualiza el avatar en la base de datos
        $id_avatar_nuevo = $_POST["avatar"];
        $query = "UPDATE usuarios SET id_avatar = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $id_avatar_nuevo, $id_usuario);
        $stmt->execute();
        $stmt->close();

        echo '<script type="text/javascript">window.history.back();</script>';
        exit; 

    }
}

// Cerrar la conexión
$conn->close();

?>
