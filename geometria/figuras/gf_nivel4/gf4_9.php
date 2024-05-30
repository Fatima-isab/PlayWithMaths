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
$leccion_id = '49';

// ID de la lección anterior
$leccion_anterior_id = $leccion_id - 1;

// Verificar si la lección anterior está completada por el usuario
$id_usuario = $_SESSION['id_usuario'];
$query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior_id";
$result = $conn->query($query_verificar_completada);

if ($result->num_rows == 0) {
    // Si la lección anterior no está completada, redireccionar al usuario o mostrar un mensaje
    header("location: gf4_8.php"); // Cambia "gf1_5.php" por la página a la que quieras redireccionar
    exit;
}

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visto"])) {
    $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
    $result = $conn->query($query_verificar_completada);
    if ($result->num_rows == 0) {
        $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
        $conn->query($query_insert_completada);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formas en el mundo real</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/figuras.css">
    <style>
        .dropzone {
            width: 100px;
            height: 120px;
            padding: 10px;
            border: 1px solid #aaaaaa;
            margin: 10px;
            display: inline-block;
        }
        img {
            width: 120px;
            height: 120px;
        }
        .drag-container, .drop-container {
            display: flex;
            justify-content: space-around;
        }
        .boton-salir,
        .boton-anterior,
        .boton-siguiente {
            background-color: #aa8976;
        }
    </style>
</head>

<body>
<h2>Jugando con las áreas</h2>

<p></p>

<h1>¡Une la forma con el área que le corresponde!</h1>

<img src="../../../assets/img/gf_49.1.jpg" alt="" draggable="true" ondragstart="drag(event)" id="drag1">
<img src="../../../assets/img/gf_49.2.jpg" alt="" draggable="true" ondragstart="drag(event)" id="drag2">
<img src="../../../assets/img/gf_49.3.jpg" alt="" draggable="true" ondragstart="drag(event)" id="drag3">

<div class="drop-container">
    <div id="div3" class="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>25</p>
    </div>
    <div id="div2" class="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>35</p>
    </div>
    <div id="div1" class="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>14</p>
    </div>
</div>

<div class="botones-conteiner">
<button onclick="validate()" class="boton">Validar</button>
</div>
<br>
<div class="botones-conteiner">
    <a href="../gf_nivel3/gf3_8.php">
        <button class="boton boton-anterior">Anterior</button>
    </a>
    <a href="../gf_nivel 3.php">
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
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}

function validate() {
    var mensaje;
    if (document.getElementById('div1').contains(document.getElementById('drag1')) &&
        document.getElementById('div2').contains(document.getElementById('drag2')) &&
        document.getElementById('div3').contains(document.getElementById('drag3'))) {
        mensaje = '¡Las figuras están en el recuadro correcto!';
        mostrarModal(mensaje);
        setTimeout(function() {
            var mensaje2 = '¡Acabas de obtener una recompensa! 🍌';
            mostrarModal(mensaje2);
            setTimeout(function() {
                document.getElementById('form-completado').submit();
            }, 4000); // Espera 6 segundos antes de enviar el formulario
        }, 2000); // Espera 3 segundo antes de mostrar el segundo mensaje
    } else {
        mensaje = 'Las imágenes no están en los recuadros correctos.';
        mostrarModal(mensaje);
    }
}



function mostrarModal(mensaje) {
    document.getElementById("modalMensaje").textContent = mensaje;
    document.getElementById("myModal").style.display = "block";
}

function cerrarModal() {
    document.getElementById("myModal").style.display = "none";
}

window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<form id="form-completado" method="post">
    <input type="hidden" name="visto" value="true">
</form>

</body>

</html>