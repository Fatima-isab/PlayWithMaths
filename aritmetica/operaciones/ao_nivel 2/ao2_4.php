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
$leccion_id = '184';

// ID de la lección anterior
$leccion_anterior_id = $leccion_id - 1;

// Verificar si la lección anterior está completada por el usuario
$id_usuario = $_SESSION['id_usuario'];
$query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior_id";
$result = $conn->query($query_verificar_completada);

if ($result->num_rows == 0) {
    // Si la lección anterior no está completada, redireccionar al usuario o mostrar un mensaje
    header("location: ao2_3.php");
    exit;
}

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["respuesta"])) {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = '145'; // Definir la respuesta correcta

    if ($_POST["respuesta"] == $respuesta_correcta) {
        // Verificar si el usuario ya ha completado la lección
        $id_usuario = $_SESSION['id_usuario'];
        $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
        $result = $conn->query($query_verificar_completada);

        if ($result->num_rows == 0) {
            // Insertar un registro en la tabla Lecciones_Completadas
            $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
            $conn->query($query_insert_completada);
            $mensaje = "¡Respuesta correcta!";
        } else {
            $mensaje = "Ya has completado esta lección.";
        }
    } else {
        $mensaje = "Respuesta incorrecta. Inténtalo de nuevo.";
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
    <title>Restando en acción</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/aritmetica_op.css">
    <style>
        /* Aquí va el CSS proporcionado anteriormente */
        .boton-salir,
        .boton-anterior,
        .boton-siguiente {
            background-color: #aa8976;
        }
    </style>
</head>

<body>
    <h1>Restando en acción</h1>

    <div class="contenedor">
        <div class="inst">
        Un camión transportaba 620 cajas de fruta. <br>
        Se entregaron 475 cajas. <br>
        ¿Cuántas cajas quedan en el camión?
        </div>

        <div class="img-container">
            <img class="imgLecc" src="../../../assets/img/camion fruta.jpg" alt="" width="360" height="360">
        </div>
    </div>

    <div class="botones-container">
        <div id="botones">
            <button class="boton" onclick="verificarRespuesta('145')">145</button>
            <button class="boton" onclick="verificarRespuesta('135')">135</button>
            <button class="boton" onclick="verificarRespuesta('165')">165</button>
        </div>
    </div>

    <div class="botones-container">
    <a href="../ao_nivel 2/ao2_3.php">
            <button class="boton boton-anterior">Anterior</button>
        </a>
        <a href="../ao_nivel 2/ao2_5.php">
            <button class="boton boton-siguiente">Siguiente</button>
        </a>
        <a href="../ao_nivel 2.php">
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
        function verificarRespuesta(respuesta) {
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
            xhr.send("respuesta=" + respuesta);
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