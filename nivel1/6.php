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
$leccion_id = '6';

// Definir las opciones de la pregunta
$opciones = array(
    'uno' => '1',
    'dos' => '2',
    'tres' => '3',
    'cuatro' => '4'

);

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
            margin-left: 40%;
            margin-bottom: 15%;
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
            margin-top: -30%;
        }

        .cuadrado {
            width: 150px;
            height: 150px;
            border: 2px solid #554;
            background: var(--cafe);
            margin-top: -18%;
            margin-left: 15%;
        }

        .pentagono {
            margin-top: -10%;
            margin-left: 70%;
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br><br><br>
    <h2>¿Cuál no es un cuadrilatero?</h2>
    <br><br><br>

    <div class="shape rectangulo"></div>
    <div class="shape cuadrado"></div>
    <div class="shape rombo"></div>
    <div class="shape pentagono"> <svg width="300" height="300">
            <polygon points="150,10 240,75 210,225 90,225 60,75" style="fill:var(--amarillo);stroke:#554;stroke-width:2" />
        </svg></div>
<br>
<br>
<br>
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
</body>

</html>