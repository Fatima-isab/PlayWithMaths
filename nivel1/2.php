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
$leccion_id = '2';

// Definir las opciones de la pregunta
$opciones = array(
    'rectangulo' => 'Rectángulo',
    'isosceles' => 'Isósceles',
    'equilatero' => 'Equilátero',
    'escaleno' => 'Escaleno'
);


// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = $leccion_id - 1;
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 1.php");
    exit;
}



// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si la respuesta es correcta
    $respuesta_correcta = 'equilatero'; // Definir la respuesta correcta
    if (isset($_POST["respuesta"])) {
        if ($_POST["respuesta"] == $respuesta_correcta) {
            // Verificar si el usuario ya ha completado la lección
            $id_usuario = $_SESSION['id_usuario'];
            $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
            $result = $conn->query($query_verificar_completada);
            if ($result->num_rows == 0) {
                // Insertar un registro en la tabla Lecciones_Completadas
                $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
                $conn->query($query_insert_completada);
                echo "<script>alert('¡Respuesta correcta!');</script>"; // Mostrar mensaje emergente de respuesta correcta
    } else {
        echo "<script>alert('Ya has completado esta lección.');</script>";
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
            color: var(--verde);
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
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .svg{
            width: 100%;
            height: 100%;
        }
        .trianguloo{
            background-color: none;
            margin-top: 0;
            margin-left: 0;
        }
   
        .trianguloq{
            background-color: none;
            margin-top: 0;
            margin-left: 0;
        }
        .triangulor{
            background-color: none;
            margin-top: 0;
            margin-left: 0;
        }
        .triangulox{
            width: 0;
            height: 0;
            border-right: 100px solid transparent;
            border-top: 100px solid transparent;
            border-left: 100px solid transparent;
            border-bottom: 100px solid var(--beige);
            margin-top: 0;
        }
       
        .trianguloz{
            width: 0; 
            height: 0; 
            border-left: 100px solid #f0ad4e;
            border-top: 50px solid transparent;
            border-bottom: 50px solid transparent; 
            margin-right: 0;
            margin-top: 0;
        }
        .respuesta{
            width: 50%;
            margin-left: 25%;
            margin-top: 1%;
            font-size: medium;  
        }

      
    </style>
</head>
<body>

    <h1>Descubriendo las formas</h1>

    <h2>Tipos de triangulos</h2>

    <div id="progress-bar" style="display:none; background-color: var(--amarillo); width: 10%; height: 30px;"></div>

    <div class="shape-container">
        <div class="shape trianguloo" onclick="showInfo('Triángulo Escaleno')">
        <svg>
        <polygon points="120,40 200,120 40,200" style="fill:var(--amarillo)" />
        </svg></div>
        <div class="shape trianguloq" onclick="showInfo('Triángulo Rectangulo')">
        <svg>
        <polygon points="200,40 200,200 40,200" style="fill:var(--verde)" />
        </svg></div>
        <div class="shape trangulor" onclick="showInfo('Triángulo Isósceles')">
        <svg>
        <polygon points="120,40 200,200 40,200" style="fill:var(--verdeazulado)" />
        </svg></div>
        <div class="shape triangulox" onclick="showInfo('Triángulo Equilatero')"></div>
        <div class="shape trianguloz" onclick="showInfo('Triángulo Equilatero')"></div>  
    </div>
    

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>¿Qué triángulo tiene sus 3 lados iguales?</h2>
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button type="submit">Responder</button>
    </form>

    <br>
    <br>
    <div>
    <a href="../nivel1/1.php">
    <button>Anterior</button>
    </a>

    <a href="../nivel1/3.php">
    <button>Siguiente</button>

    <a href="../nivel1.php">
    <button>Salir</button>
    </a>
    </a>
    </div>
    <div id="info-container"></div>
    

    <script>
        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    </script>

    <script>
        function showInfo(shape) {
            const infoContainer = document.getElementById('info-container');
            infoContainer.innerHTML = `<p class="respuesta">Es un: <strong>${shape}</strong></p>`;
        }
    </script>

</body>
</html>