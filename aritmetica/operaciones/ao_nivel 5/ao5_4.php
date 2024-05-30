<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: ../php/registro.php");
    session_destroy();
    die();
}

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// ID de la lección actual
$leccion_id = '214';

// ID de la lección anterior
$leccion_anterior_id = $leccion_id - 1;

// Verificar si la lección anterior está completada por el usuario
$id_usuario = $_SESSION['id_usuario'];
$query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior_id";
$result = $conn->query($query_verificar_completada);

if ($result->num_rows == 0) {
    // Si la lección anterior no está completada, redireccionar al usuario o mostrar un mensaje
    header("location: ao5_3.php");
    exit;
}


// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comprendido"])) {
    // Verificar si el usuario ya ha completado la lección
    $id_usuario = $_SESSION['id_usuario'];
    $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
    $result = $conn->query($query_verificar_completada);

    if ($result->num_rows == 0) {
        // Insertar un registro en la tabla Lecciones_Completadas
        $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
        $conn->query($query_insert_completada);
        $mensaje = "¡Lección marcada como completada!";
    } else {
        $mensaje = "Ya has completado esta lección.";
    }

    // Devolver la respuesta en formato JSON
    echo json_encode(array("mensaje" => $mensaje));
    exit;
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Misterios matemáticos</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/aritmetica_op.css">
    <style>
        .boton-salir,
        .boton-siguiente {
            background-color: #aa8976;
        }
    </style>
</head>

<body>
    <h1>Misterios matemáticos</h1>

    <div class="contenedor">
        <div class="inst">
        En la suma y la multiplicación, puedes cambiar el orden de los números y el resultado será el mismo.<br>
        Por ejemplo, 2x3 = 3x2 o 7+6 = 6+7
        </div>

        <div class="img-container">
            <img class="imgLecc" src="../../../assets/img/aritmetica.png" alt="" width="360" height="360">
        </div>
    </div>

    <div class="botones-container">
        <button class="boton" onclick="marcarCompletado()">He comprendido</button>
    </div>

    <div class="botones-container">
    <a href="../ao_nivel 5/ao5_3.php">
            <button class="boton boton-anterior">Anterior</button>
        </a>
        <a href="../ao_nivel 5/ao5_5.php">
            <button class="boton boton-siguiente">Siguiente</button>
        </a>
        <a href="../ao_nivel 5.php">
            <button class="boton boton-salir">Salir</button>
        </a>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <p id="modalMensaje"></p>
        </div>
    </div>

    <script>
        function marcarCompletado() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var respuestaJSON = JSON.parse(xhr.responseText);
                    document.getElementById("modalMensaje").textContent = respuestaJSON.mensaje;
                    document.getElementById("myModal").style.display = "block";
                }
            };
            xhr.send("comprendido=true");
        }

        function cerrarModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Cerrar el modal si el usuario hace clic fuera del contenido del modal
        window.onclick = function (event) {
            var modal = document.getElementById("myModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>

</html>