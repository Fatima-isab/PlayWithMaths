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
$leccion_id = '65';

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
    <h1>Explorando las tablas</h1>

    <div class="contenedor">
        <div class="inst visible">El cuadro de multiplicación es una herramienta para aprender,</div>
        <div class="inst">consiste en multiplicar las filas por las columnas,</div>
        <div class="inst">y el resultado se coloca en la celda correspondiente.</div>
        <div class="inst">Aquí tenemos un cuadro de multiplicación desde 1 a 3.</div>
        <div class="inst">Trata de resolverlo</div>
        

        <div class="control">
            <button id="btnAnt" onclick="anterior()" class="boton">Atrás</button>
            <button id="btnSig" name="continuar" onclick="siguiente()" class="boton">Continuar</button>
        </div>
    </div>

    <div>
    <table id="puzzle">
        <tr>
            <td class="filled correct">X</td>
            <td class="filled correct">1</td>
            <td class="filled correct">2</td>
            <td class="filled correct">3</td>
        </tr>
        <tr>
            <td class="filled correct">1</td>
            <td id="cell-2-2" class="filled" onclick="fillCell(this)"></td>
            <td id="cell-2-3" class="filled" onclick="fillCell(this)"></td>
            <td id="cell-2-4" class="filled" onclick="fillCell(this)"></td>
        </tr>
        <tr>
            <td class="filled correct">2</td>
            <td id="cell-3-2" class="filled" onclick="fillCell(this)"></td>
            <td id="cell-3-3" class="filled" onclick="fillCell(this)"></td>
            <td id="cell-3-4" class="filled" onclick="fillCell(this)"></td>
        </tr>
        <tr>
            <td class="filled correct">3</td>
            <td id="cell-4-2" class="filled" onclick="fillCell(this)"></td>
            <td id="cell-4-3" class="filled" onclick="fillCell(this)"></td>
            <td id="cell-4-4" class="filled" onclick="fillCell(this)"></td>
        </tr>
        <button class="boton" onclick="checkMatrix()">Verificar</button>
    </table>
    
    </div>

    <div id="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button id="btnSig" name="visto" class="boton">He comprendido</button>
        </form>
    </div>


    <div id=botones>
    <a href="../ao_nivel 3/ao3_4.php">
            <button class="boton">Anterior</button>
        </a>

        <a href="../ao_nivel 3/ao3_6.php">
            <button class="boton">Siguiente</button>
        </a>
        
        <a href="../ao_nivel 3.php">
            <button class="boton">Salir</button>
        </a>

        
    </div>

    <script src="../../../assets/scripts/aritmetica_op.js"></script>
    <script src="../../../assets/scripts/puzzle.js"></script>

</body>

</html>

