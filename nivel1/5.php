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
$leccion_id = '5';

// Definir las opciones de la pregunta
$opciones = array(
    'rojo' => '1',
    'verde' => '2'
);

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'verde'; // Definir la respuesta correcta
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
            width: 120px;
            height: 120px;
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
     height: 100px; 
     border: 3px solid #555;
     background: var(--verde);
     margin-left: 40%;
     margin-bottom: 15%;
}

    .oval {
     width: 250px;
     height: 100px;
     -moz-border-radius: 0 50% / 0 100%;
     -webkit-border-radius: 0 50% / 0 100%;
     border-radius: 0 50% / 0 100%;
     background: #5cb85c;
     border: 3px solid #555;
    }
    .oval1 {
     width: 250px;
     height: 100px;
     -moz-border-radius: 0 50% / 0 100%;
     -webkit-border-radius: 0 50% / 0 100%;
     border-radius: 0 50% / 0 100%;
     background: red;
     border: 3px solid #555;
     margin-left: 15%;
     margin-top: -10%;
    }
    .oval2{
     width: 250px;
     height: 100px;
     -moz-border-radius: 0 50% / 0 100%;
     -webkit-border-radius: 0 50% / 0 100%;
     border-radius: 0 50% / 0 100%;
     background: #5cb85c;
     border: 3px solid #555;
     margin-top:-9%;
     margin-left: 65%;
    }

    #oval1{
    text-align:left;
    }

        
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br><br><br>
    <h2>¿Quién me describió corrrectamente?</h2>
    <br><br><br>

    <div class="shape rectangulo"></div>
    <div class="shape oval oval1"><p id="oval1">Tengo lados iguales y 4 ángulos rectos</p></div>
    <div class="shape oval oval2"><p id="oval2">Tengo 4 lados, pero no son iguales, solo mis lados opuestos tienen la misma longitud</p></div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button id="responder" type="submit">Responder</button>
    </form>

    <div>
    <a href="../nivel1/4.php">
        <button>Anterior</button>
    </a>
    
    <a href="../nivel1/6.php">
    <button>Siguiente</button>
    </a>

    <a href="../nivel1.php">
    <button>Salir</button>
    </a>
    </div>
   
</body>

</html>