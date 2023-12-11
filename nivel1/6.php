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
$leccion_id = '6';

// Definir las opciones de la pregunta
$opciones = array(
    'uno' => 'Rombo',
    'dos' => 'Cuadrado',
    'tres' => 'Réctangulo',
    'cuatro' => 'Pentágono'

);


// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = $leccion_id - 1;
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 5.php");
    exit;
}

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'cuatro'; // Definir la respuesta correcta
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

        .rectangulo {
            width: 250px;
            height: 150px;
            border: 2px solid #554;
            background: var(--verde);
            margin-left: 45%;
            margin-bottom: 10%;
        }

        .rombo {
            width: 150px;
            height: 150px;
            border: 2px solid #554;
            background: var(--verdeazulado);
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            margin-top: -20%;
            margin-left: 5%;
        }

        .cuadrado {
            width: 150px;
            height: 150px;
            border: 2px solid #554;
            background: var(--cafe);
            margin-top: -22%;
            margin-left: 25%;
        }

        .pentagono {
            margin-top: -8%;
            margin-left: 75%;
        }

        #info-container{
            width: 20%;
            margin-left: 70%;
            background-color: var(--verde);
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br>
    <h2>¿Cuál no es un cuadrilatero?</h2>
    <div id="info-container"></div>

    <br><br>
        
    <div class="shape rectangulo" onclick="showInfo('Rectángulo')"></div>
    <div class="shape cuadrado" onclick="showInfo('Cuadrado')"></div>
    <div class="shape rombo" onclick="showInfo('Rombo')"></div>
    <div class="shape pentagono" onclick="showInfo('Pentágono')"> <svg width="200" height="210">
            <polygon points="100,10 190,78 160,198 40,198  10,78" style="fill:var(--amarillo);stroke:#554;stroke-width:2" />
        </svg></div>


<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button id="responder" type="submit">Responder</button>
    </form>


    <div>
    <a href="../nivel1/5.php">
        <button>Anterior</button>
    </a>
    
    <a href="../nivel1/7.php">
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