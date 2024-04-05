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
$leccion_id = '11';


// Definir las opciones de la pregunta
$opciones = array(
    'cuadrado' => 'Cuadrado',
    'circulo' => 'Círculo',
    'triangulo' => 'Triángulo',
    'rombo' => 'Rombo',
    'rectangulo' => 'Rectángulo'
);

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'triangulo'; // Definir la respuesta correcta
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
            background-color: fff;

        }

        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: -2%;
        }

        .shape {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .circulo{
            width: 120px;
            height: 120px;
            background-color:darkcyan;
            border-radius: 50%;
            display: inline-block;
            margin-top: 10%;
            margin-left: -13%;
            position: relative;
        }

        .cuadrado{
            width: 120px;
            height: 120px;
            background-color:cyan;
            border-radius: 0;
            display: inline-block;
            margin: 8%;
            margin-top: 4%;
            margin-left: 4%;
            position: relative;
        }
        .triangulo{
            background-color: none;
            margin-top: 7%;
            margin-left: -5%;
        }
        .rombo {
            width: 90px; 
            height: 90px; 
            background:red;
            transform: rotate(45deg);
            margin-top: 10%;
        }

        .rectangulo {
            width: 220px; 
            height: 100px; 
            background: var(--amarillo);
            margin-top: 5.5%;
           
            margin-left: -8%;
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
    <h2>¿Cuál es la figura con tres lados?</h2>

    <div id="info-container"></div>
    <div class="shape-container">
        <div class="shape cuadrado" onclick="showInfo('Cuadrado')"></div>
        <div class="shape circulo" onclick="showInfo('Círculo')"></div>
        <div class="shape triangulo" onclick="showInfo('Triángulo')"><svg width="200" height="200">
        <polygon points="60,20 100,100 20,100" style="fill:var(--verde)" />
        </svg></div>
        <div class="shape rombo" onclick="showInfo('Rombo')"></div>
        <div class="shape rectangulo" onclick="showInfo('Rectángulo')"></div>
    </div>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
        
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button type="submit">Responder</button>
    </form>


    
    
    <div>
    <a href="../nivel1.php">
    <button>Salir</button>
    </a>

    <a href="../nivel1/2.php">
    <button>Siguiente</button>
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
