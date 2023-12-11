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
$leccion_id = '7';

// Definir las opciones de la pregunta
$opciones = array(
    'heptagono' => 'Heptágono',
    'octagono' => 'Octágono',
    'eneagono' => 'Eneágono',
    'decagono' => 'Decágono'

);


// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = $leccion_id - 1;
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 6.php");
    exit;
}

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'octagono'; // Definir la respuesta correcta
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


        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }

        .shape {
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .octagono{
            margin: 0;
            
        }

        .heptagono{
            margin-top:2% ;

        }
        #info-container{
            width: 20%;
            background-color: var(--verde);
        }

        .form{
            margin-top: 5%;
        }

    </style>
</head>

<body>

    <h1>Descubriendo las formas</h1>
    <h2>¡Toca una figura para conocer su nombre!</h2>
    <h2>¿Cuál es el nombre de la forma con 8 lados?</h2>
    <div id="info-container"></div>

    <div class="shape-container">
        <div class="shape heptagono" onclick="showInfo('Heptágono')"> <svg width="200" height="200">
                <polygon points="100,2 181,35 173,94 117,166 43,120 49,60 105,17" style="fill:var(--verdeazulado);stroke:green;stroke-width:2" />
            </svg></div>
        <div class="shape octagono" onclick="showInfo('Octágono')"><svg width="200" height="200">
                <polygon points="100,10 150,10 190,50 190,150 150,190 100,190 60,150 60,50" style="fill:red;stroke:#555;stroke-width:2" />
            </svg></div>
        <div class="shape eneagono" onclick="showInfo('Eneágono')"><svg width="200" height="200">
                <polygon points="100,10 160,30 190,80 190,150 160,190 100,200 40,190 10,150 10,80" style="fill:var(--cafe);stroke:darkred;stroke-width:2" />
            </svg></div>
        <div class="shape decagono" onclick="showInfo('Decágono')"><svg width="200" height="200">
                <polygon points="100,5 155,18 185,65 185,135 155,182 100,195 45,182 15,135 15,65 45,18" style="fill:teal;stroke:brown;stroke-width:2" />
            </svg></div>
    </div>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button id="responder" type="submit">Responder</button>
    </form>

    <div>

        <a href="../nivel1/6.php">
            <button>Anterior</button>
        </a>
        <a href="../nivel1/8.php">
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