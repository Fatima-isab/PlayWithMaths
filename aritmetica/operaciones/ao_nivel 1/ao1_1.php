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
$leccion_id = '41';


// Definir las opciones de la pregunta
$opciones = array(
    '40' => '40',
    '38' => '38',
    '42' => '42',
    '37' => '37',
    '35' => '35'
);

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = '40'; // Definir la respuesta correcta
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

    <style>
        body {
            text-align: center;
            margin: 40px;
            background-color: #fff;
            background-image: url('../../../assets/img/Fondo_lecciones.jpg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            background-color: fff;


            #arbol {
                margin-top: -14%;
                margin-left: 50%;
            }

            #titulos {
                margin: 2%;
                margin-top: 12%;
                margin-left: -40%;
            }

            #form {
                margin-left: -36%;
                margin-top: -15%;
            }

            #botones {
                margin-left: -38%;
                margin-top: 3%;
            }

        }
    </style>
</head>

<body>
    <h1>Sumemos diversión</h1>
    <div id=titulos>
        <h2>Si el árbol tiene 32 plátanos, 5 manzanas y 3 mangos</h2>
        <h2>¿Cuántas frutas hay en total?</h2>
    </div>
    <div>
        <img id=arbol src="../../../assets/img/arbol.jpg" alt="" width="400" height="400">
    </div>

    <div id=form>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">

            <?php
            foreach ($opciones as $value => $label) {
                echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
            }
            ?>
            <button type="submit">Responder</button>
        </form>
    </div>



    <div id=botones>
        <a href="../ao_nivel 1.php">
            <button>Salir</button>
        </a>

        <a href="../ao_nivel 1/ao1_2.php">
            <button>Siguiente</button>
        </a>
    </div>
</body>

</html>