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

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$leccion_id = '28';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visto"])) {
    $id_usuario = $_SESSION['id_usuario'];
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
    <title>Propiedades de las formas</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/aritmetica_op.css">

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
            width: 100px;
            height: 100px;
        }
        .drag-container, .drop-container {
            display: flex;
            justify-content: space-around;
        }
    </style>

</head>

<body>
<h2>Descubriendo las formas</h2>

<p></p>

<h1>¡Une la definición con su concepto!</h1>

<img src="../../../assets/img/gf_28.1.jpg" alt="" draggable="true" ondragstart="drag(event)" id="drag1">
<img src="../../../assets/img/gf_28.2.jpg" alt="" draggable="true" ondragstart="drag(event)" id="drag2">
<img src="../../../assets/img/gf_28.3.jpg" alt="" draggable="true" ondragstart="drag(event)" id="drag3">

<div class="drop-container">
    <div id="div3" class="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>Ángulo</p>
    </div>
    <div id="div1" class="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>Lados</p>
    </div>
    <div id="div2" class="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
        <p>Área</p>
    </div>
</div>

<div id=botones>
    <a href="../gf_nivel1/gf2_9.php">
        <button class="boton">Anterior</button>
    </a>

    <a href="../gf_nivel 2.php">
        <button class="boton">Salir</button>
    </a>

    <a href="../gf_nivel2/gf2_9.php">
                <button class="boton">Siguiente</button>
            </a>

    <button onclick="validate()" class="boton">Validar</button>
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
    if (document.getElementById('div1').contains(document.getElementById('drag1')) &&
        document.getElementById('div2').contains(document.getElementById('drag2')) &&
        document.getElementById('div3').contains(document.getElementById('drag3'))) {
        alert('Las imágenes están en los recuadros correctos!');
        document.getElementById('form-completado').submit();
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visto"])) {
            $id_usuario = $_SESSION['id_usuario'];
            $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
            $result = $conn->query($query_verificar_completada);
            if ($result->num_rows == 0) {
                $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
                $conn->query($query_insert_completada);
            }
        }
        ?>
    } else {
        alert('Las imágenes no están en los recuadros correctos.');
    }
}
</script>

<form id="form-completado" method="post">
    <input type="hidden" name="visto" value="true">
</form>

</body>

</html>