<?php
session_start();
if(!isset($_SESSION['usuario'])){

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
$leccion_id = '14';

// Definir las opciones de la pregunta
$opciones = array(
    'trapecio' => 'Trapecio',
    'hexagono' => 'Héxagono regular',
    'semicirculo' => 'Semicírculo',
    'hexag' => 'Héxagono irregular',
);


// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = $leccion_id - 1;
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 3.php");
    exit;
}


// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'hexagono'; // Definir la respuesta correcta
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

<!---->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/styles/root.css">
    <style>
        body {
            text-align: center;
            margin: 40px;
            background-color: #fff;
            background-image: url('../assets/img/Fondo_lecciones.jpg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }

        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: 10%;
        }

        .shape {
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .trapecio {
            width: 200px;
            height: 0px;
            border-right: 60px solid transparent;
            border-left: 60px solid transparent;
            border-bottom: 100px solid var(--amarillo);
        }

        .semicirculo {
            width: 100px;
            height: 100px;
            background: var(--verde);
            -moz-border-radius: 0 100px 100px 0;
            -webkit-border-radius: 0 100px 100px 0;
            border-radius: 0 100px 100px 0;
            margin-left: -4%;
        }
        .hexagono{
            margin-top: -2%; 
        }
        .hexag{
            margin-top: -2%;
            margin-right: 2%;
        }

        #info-container{
            width: 20%;
            background-color: var(--verde);
        }

        .form{
            margin-top: 3%;
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br>
    <h2>¡Adivina quién soy, tengo 6 lados iguales!</h2>
    <div id="info-container"></div>

    <div class="shape-container">
        <div class="shape trapecio" onclick="showInfo('Trapecio')"></div>
        <div class="shape hexagono" onclick="showInfo('Hexagono Regular')"><svg width="200" height="200">
                <polygon points="60,5 115,34 115,103 60,132 5,103 5,34" style="fill:red" />
            </svg></div>
        <div class="shape semicirculo" onclick="showInfo('Semicírculo')"></div>
        <div class="shape hexag" onclick="showInfo('Héxagono irregular')"><svg width="200" height="200">
                <polygon points="80,5 160,43 145,103 60,132 5,103 15,49" style="fill:var(--verdeazulado)" />
            </svg></div>
    </div>
    
    <!--Respuesta corecta-->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button id="responder" type="submit">Responder</button>
    </form>


    

    <div>  
    <a href="../nivel1/3.php">
            <button>Anterior</button>
        </a>
        <a href="../nivel1/5.php">
            <button>Siguiente</button>
        </a>

        <a href="../nivel1.php">
            <button>Salir</button>
        </a>
    </div>

    <script>
        function showInfo(shape) {
            const infoContainer = document.getElementById('info-container');
            infoContainer.innerHTML = `<p class="respuesta">Es un: <strong>${shape}</strong></p>`;
        }
    </script>



</body>

</html>