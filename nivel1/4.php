<?php
session_start();

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
$leccion_id = '4';

// Definir las opciones de la pregunta
$opciones = array(
    'trapecio' => '1',
    'semicirculo' => '2',
    'hexagono' => '3',
    'hexag' => '4',
);

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'hexag'; // Definir la respuesta correcta
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
            margin-top: 5%;
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
        .respuesta {
            width: 100%;
            margin-left: 5%;
            margin-top: 0;
            font-size: medium;
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br><br><br>
    <h2>¡Adivina quién soy!</h2>
    

    <h3>Tengo 6 lados diferentes</h3>

    <div class="shape-container">

        <div class="shape trapecio" onclick="showInfo('Trapecio')"></div>
        <div class="shape hexagono" onclick="showInfo('Hexagono Regular')"><svg width="200" height="200">
                <polygon points="60,5 115,34 115,103 60,132 5,103 5,34" style="fill:red" />
            </svg></div>
        <div class="shape semicirculo" onclick="showInfo('Semicirculo')"></div>
        <div class="shape hexag" onclick="showInfo('Hexagono')"><svg width="200" height="200">
                <polygon points="80,5 160,43 145,103 60,132 5,103 15,49" style="fill:blue" />
            </svg></div>
    </div>
    
    <!--Respuesta corecta-->
    <div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button id="responder" type="submit">Responder</button>
    </form>
    </div>
    <p class="respuesta"><?php echo $respuesta_correcta_msg; ?></p>
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