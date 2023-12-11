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
$leccion_id = '3';


// Definir las opciones de la pregunta
$opciones = array(
    'trapecio' => 'Trapecio',
    'hexagono' => 'Héxagono',
    'ovalo' => 'Ovalo',
    'pentagono' => 'Péntagono'
);


// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = $leccion_id - 1;
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 2.php");
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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubriendo las formas</title>
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

        h1 {
            color: var(--rojo);
        }

        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: 4%;
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

        #info-container{
            width: 20%;
            background-color: var(--verde);
        }
       
        .trapecio {
            width: 150px;
            height: 0px;
            border-right: 60px solid transparent;
            border-left: 60px solid transparent;
            border-bottom: 100px solid var(--verde);
            margin-top: 10%;
            margin-left: -2%;
        }

        .ovalo {
            width: 250px;
            height: 100px;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            background: red;
            border: 2px solid #555;
            margin-top: 1.5%;
            margin-left: -9%;
        }

        .hexagono {
            margin-left: -70%;
            margin-top: 0;
        }

        .pentagono {
            margin-left: -10%;
            margin-top: 6%;
        }
        #info-container{
            width: 20%;
            background-color: var(--verde);
        }
    </style>
</head>

<body>

    <h1>Descubriendo las formas</h1>
    <h2>¡Toca una figura para conocer su nombre!</h2>
    <h2>¿Cuál es la figura con seis lados?</h2>
    <div id="info-container"></div>

    <div class="shape-container">
        <div class="shape trapecio" onclick="showInfo('Trapecio')"></div>
        <div class="shape ovalo" onclick="showInfo('Ovalo')"></div>
        <div class="shape hexagono" onclick="showInfo('Héxagono')"><svg width="200" height="200">
                <polygon points="75,5 144,45 144,105 75,145 6,105 6,45" style="fill:purple;stroke:#555;stroke-width:2" />
            </svg></div>
        <div class="shape pentagono" onclick="showInfo('Péntagono')"><svg width="250" height="150">
                <polygon points="125,5 200,75 165,145 85,145 50,75" style="fill:var(--amarillo);stroke:yellow;stroke-width:2" />
            </svg></div>
    </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button type="submit">Responder</button>
    </form>

        <div class="botones">
            <a href="../nivel1/2.php">
                <button>Anterior</button>
            </a>
            <a href="../nivel1/4.php">
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