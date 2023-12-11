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
$leccion_id = '8';

// Definir las opciones de la pregunta
$opciones = array(
    'uno' => '1',
    'dos' => '2',
    'tres' => '3',
    'cuatro' => '4'

);


// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = $leccion_id - 1;
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 7.php");
    exit;
}

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'tres'; // Definir la respuesta correcta
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
            margin-top: 40px;
        }

        .shape {
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .triangulo{
            width: 0;
            height: 0;
            border-right: 100px solid transparent;
            border-top: 100px solid transparent;
            border-left: 100px solid transparent;
            border-bottom: 100px solid var(--beige);
        }
        .heptagono{
            margin-top: 5%;
            margin-left: 5%;
        }
        .pentagono{
            margin-top: 5%;
            margin-left: 5%;
        }

        .hexagono{
            margin-top: 5%;
            margin-left: 5%;
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br>
    <h2>¿Cuál es la figura con más lados?</h2>
    <div id="info-container"></div>
        <div class="shape-container">
    <div class="shape triangulo" onclick="showInfo('Triángulo')"></div>
    <div class="shape hexagono" onclick="showInfo('Héxagono')"><svg width="200" height="200">
                <polygon points="75,5 144,45 144,105 75,145 6,105 6,45" style="fill:red;stroke:red;stroke-width:2" />
            </svg></div>
    <div class="shape heptagono" onclick="showInfo('Héptagono')"><svg width="200" height="200">
                <polygon points="100,2 181,35 173,94 117,166 43,120 49,60 105,17" style="fill:blue;stroke:green;stroke-width:2" />
            </svg></div>
    <div class="shape pentagono" onclick="showInfo('Pentágono')"> <svg width="190" height="200">
            <polygon points="100,10 190,78 160,198 40,198  10,78" style="fill:var(--amarillo);stroke:#554;stroke-width:2" />
        </svg></div>
        </div>


        <br>
    <br>
    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button id="responder" type="submit">Responder</button>
    </form>

    <br>
    <br>
    <br>

    <div>
    <a href="../nivel1/7.php">
        <button>Anterior</button>
    </a>
    
    <a href="../nivel1/9.php">
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