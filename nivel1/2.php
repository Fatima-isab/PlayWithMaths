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
    'rectangulo' => 'Rectangulo',
    'isosceles' => 'Isosceles',
    'equilatero' => 'Equilatero',
    'escaleno' => 'Escaleno'
);

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

                // Calcular el porcentaje de progreso (ejemplo: 50%)
                $porcentaje_progreso = 25;

                echo "<script>
                var modal = document.getElementById('myModal');
                var progressBar = document.getElementById('progress-bar');
                progressBar.style.width = '$porcentaje_progreso%';
                modal.style.display = 'block';
              </script>";
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
            color: var(--rojo);
        }

        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: 70px;
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

        .trianguloo{
            background-color: none;
            margin-top: 110px;
            margin-left: 25%;
        }
   
        .trianguloq{
            background-color: none;
            margin-top: 200px;
            margin-left: 5px;
        }
        .triangulor{
            background-color: none;
            margin-top: 100px;
            margin-left: 5px;
        }
        .triangulox{
            width: 0;
            height: 0;
            border-right: 100px solid transparent;
            border-top: 100px solid transparent;
            border-left: 100px solid transparent;
            border-bottom: 100px solid var(--beige);
            margin-top: 170px;
        }
        .trianguloy{
            width: 0; 
            height: 0; 
            border-left: 100px solid var(--rojo);
            border-top: 50px solid transparent;
            border-bottom: 50px solid transparent; 
            margin-right: 150px;
        }
        .trianguloz{
            width: 0; 
            height: 0; 
            border-left: 100px solid #f0ad4e;
            border-top: 50px solid transparent;
            border-bottom: 50px solid transparent; 
            margin-right: 35px;
            margin-top: 120px;
        }
        .respuesta{
            width: 50%;
            margin-left: 25%;
            margin-top: 1%;
            font-size: medium;  
        }

        #anterior{
            margin-top: 17%;
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
        <polygon points="60,20 100,80 20,100" style="fill:var(--amarillo)" />
        </svg></div>
        <div class="shape trianguloq" onclick="showInfo('Triángulo Rectangulo')">
        <svg>
        <polygon points="100,20 100,100 20,100" style="fill:var(--verde)" />
        </svg></div>
        <div class="shape trangulor" onclick="showInfo('Triángulo Isósceles')">
        <svg>
        <polygon points="60,20 100,100 20,100" style="fill:var(--verdeazulado)" />
        </svg></div>
        <div class="shape triangulox" onclick="showInfo('Triángulo Equilatero')"></div>
        <div class="shape trianguloz" onclick="showInfo('Triángulo Equilatero')"></div>  
    </div>
    <br>
    <br>
    <br>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>¿Qué traingulo tiene sus 3 lados iguales?</h2>
        <?php
        foreach ($opciones as $value => $label) {
            echo "<label><input type='radio' name='respuesta' value='$value' required>$label</label>";
        }
        ?>
        <button type="submit">Responder</button>
    </form>

    <br>
    <br>

    <div id="info-container"></div>
    <a href="../nivel1.php">
    <button>Salir</button>
    </a>
    <a href="../nivel1/3.php">
    <button>Siguiente</button>
    </a>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Progreso:</p>
            <div id="progress-bar"></div>
        </div>
    </div>

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