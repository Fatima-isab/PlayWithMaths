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

// ID de la lección que ha sido vista
$leccion_id = '201';

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visto"])) {
    // Verificar si el usuario ya ha completado la lección
    $id_usuario = $_SESSION['id_usuario'];
    $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
    $result = $conn->query($query_verificar_completada);
    if ($result->num_rows == 0) {
        // Insertar un registro en la tabla <link>Lecciones_Completadas</link>
        $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
        $conn->query($query_insert_completada);
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubriendo las formas</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/aritmetica_op.css">
    <link rel="stylesheet" href="../../../assets/styles/puzzle.css">

</head>

<body>
    <h1>La magia de multiplicar</h1>

    <div class="contenedor">
        <div class="inst visible">Zumbi es una abeja que quiere regresar a su casa</div>
        <div class="inst">Para ayudarla resuelve la siguiente multiplicación</div>
        <div class="inst">49 x 7</div>
        <div class="inst">Arrastra la respuesta correcta</div>

        <div class="control">
            <button id="btnAnt" onclick="anterior()" class="boton">Atrás</button>
            <button id="btnSig" name="continuar" onclick="siguiente()" class="boton">Continuar</button>
        </div>
    </div>



    <div class="act">
        <div id="dropzone" class="encajar" ondragover="allowDrop(event)" ondrop="drop(event)" ondragenter="dragEnter(event)" ondragleave="dragLeave(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
        </div>

        <div id="shapes">
            <div id="incorrecto" class="shape" draggable="true" ondragstart="drag(event)" ontouchstart="touchStart(event)"></div>
            <div id="incorrecto" class="shape" draggable="true" ondragstart="drag(event)" ontouchstart="touchStart(event)"></div>
            <div id="correcto" class="shape" draggable="true" ondragstart="drag(event)" ontouchstart="touchStart(event)"></div>
        </div>
    </div>

    <div id=botones>
        <a href="../ao_nivel 5.php">
            <button class="boton">Salir</button>
        </a>
        <a href="../ao_nivel 5/ao5_2.php">
            <button class="boton">Siguiente</button>
        </a>


    </div>

    <script src="../../../assets/scripts/aritmetica_op.js"></script>
    <script src="../../../assets/scripts/puzzle.js"></script>

</body>

</html>