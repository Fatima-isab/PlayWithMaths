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
$leccion_id = '188';


// Definir las opciones de la pregunta
$opciones = array(
    '420' => '420 m',
    '480' => '480 m',
    '600' => '600 m',
    '400' => '400 m',
    '520' => '520 m'
);

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = '480'; // Definir la respuesta correcta
    if (isset($_POST["respuesta"])) {
        if ($_POST["respuesta"] == $respuesta_correcta) {
            // Verificar si el usuario ya ha completado la lección
            $id_usuario = $_SESSION['id_usuario'];
            $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
            $result = $conn->query($query_verificar_completada);
            if ($result->num_rows == 0) {
                // Insertar un registro en la tabla <link>Lecciones_Completadas</link>
                $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
                $conn->query($query_insert_completada);
                echo "<script>alert('¡Respuesta correcta!');</script>"; // Mostrar mensaje emergente de respuesta correcta
            } else {
                echo "<script>alert('Ya has completado esta lección.');</script>"; // Mostrar mensaje emergente de que la lección ya ha sido completada
            }
        } else {
            echo "<script>alert('Respuesta incorrecta. Inténtalo de nuevo.');</script>"; // Mostrar mensaje emergente de respuesta incorrecta
        }
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

</head>

<body>
    <h1>Restando en acción</h1>

    <div class="contenedor">
    <div class="inst visible">Sarah quiere recorrer 1.8 km en su bicicleta,</div>
        <div class="inst">Está dando vueltas de 300 metros,</div>
        <div class="inst">Ya ha dado 4 vueltas completas más 120 metros.</div>
        <div class="inst">¿Cuátos metros le faltan a Sara para completar su meta?</div>

        <div class="control">
            <button id="btnAnt" onclick="anterior()" class="boton">Atrás</button>
            <button id="btnSig" onclick="siguiente()" class="boton">Continuar</button>
        </div>
    </div>



    <div>
        <img class="imgLecc" src="../../../assets/img/bicicleta.jpg" alt="" width="360" height="360">
    </div>

    <div id=form>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">

            <?php
            foreach ($opciones as $value => $label) {
                echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
            }
            ?>
            <button class="boton" type="submit">Responder</button>
        </form>
    </div>



    <div id=botones>
        <a href="../ao_nivel 2/ao2_7.php">
            <button class="boton">Anterior</button>
        </a>

        <a href="../ao_nivel 2/ao2_9.php">
            <button class="boton">Siguiente</button>
        </a>

        <a href="../ao_nivel 2.php">
            <button class="boton">Salir</button>
        </a>
    </div>

    <script src="../../../assets/scripts/aritmetica_op.js"></script>

</body>

</html>