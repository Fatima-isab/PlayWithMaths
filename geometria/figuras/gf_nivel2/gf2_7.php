<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("location: ../php/registro.php");
    session_destroy();
    die();
}

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$leccion_id = '27';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visto"])) {
    $id_usuario = $_SESSION['id_usuario'];
    $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
    $result = $conn->query($query_verificar_completada);
    if ($result->num_rows == 0) {
        $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
        $conn->query($query_insert_completada);
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubriendo las formas</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/aritmetica_op.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #container {
            text-align: center;
        }

        #myBorder {
            width: 303px;
            height: 153px;
            padding: 5px;
            background-color: #ffffff;
            border-radius: 50%; /* Establece el radio de borde para hacer un círculo */
        }

        #myCircle {
            width: 300px;
            height: 150px;
            background-color: #ffffff;
            border-radius: 50%; /* Establece el radio de borde para hacer un círculo */
        }

        .boton {
            margin: 5px;
        }

        .contenedor {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div id="container">
        <h2>Propiedades de las formas las formas</h2>

        <p></p>

        <h1>¡Cambia de color!</h1>

        <div class="contenedor">
            <div class="inst">Al tocar el óvalo este cambiará de color.</div>
            <div class="inst">Haz que el área del óvalo sea de color morado/rosita.</div>
            <div class="inst">Y el borde del óvalo sea de color verde.</div>
            <div class="inst">Cuando los colores estén correctos, da clic en validar.</div>

            <div class="control">
                <button id="btnAnt" onclick="anterior()" class="boton">Atrás</button>
                <button id="btnSig" onclick="siguiente()" class="boton">Continuar</button>
            </div>

            <p></p>
            <p></p>
            <div id="myBorder">
                <div id="myCircle"></div>
            </div>

            <p id="status"></p>
        </div>

        <div id="botones">
            <a href="../gf_nivel2/gf2_7.php">
                <button class="boton">Anterior</button>
            </a>

            <a href="../gf_nivel 2.php">
                <button class="boton">Salir</button>
            </a>

            <a href="../gf_nivel2/gf2_8.php">
                <button class="boton">Siguiente</button>
            </a>

            <button id="validateButton" onclick="validate()" class="boton">Validar</button>
        </div>
    </div>

    <form id="form-completado" method="post">
        <input type="hidden" name="visto" value="true">
    </form>

    <script src="../../../assets/scripts/geometria_fig.js"></script>
    <script>
        var circle = document.getElementById('myCircle');
        var border = document.getElementById('myBorder');
        var status = document.getElementById('status');
        var validateButton = document.getElementById('validateButton');

        var borderColors = ['black', 'purple', 'green'];
        var backgroundColors = ['red', 'violet', 'brown'];
        var currentBorderColorIndex = 0;
        var currentBackgroundColorIndex = 0;

        circle.addEventListener('click', function (event) {
            circle.style.backgroundColor = backgroundColors[currentBackgroundColorIndex];
            currentBackgroundColorIndex = (currentBackgroundColorIndex + 1) % backgroundColors.length;
            event.stopPropagation();
        });

        border.addEventListener('click', function () {
            border.style.backgroundColor = borderColors[currentBorderColorIndex];
            currentBorderColorIndex = (currentBorderColorIndex + 1) % borderColors.length;
        });

        validateButton.addEventListener('click', function () {
            if (border.style.backgroundColor === 'green' && circle.style.backgroundColor === 'violet') {
                alert('Los colores son correctos!');
                document.getElementById('form-completado').submit();
            } else {
                alert('Vuelve a revisar los colores!');
            }
        });
    </script>
</body>

</html>
