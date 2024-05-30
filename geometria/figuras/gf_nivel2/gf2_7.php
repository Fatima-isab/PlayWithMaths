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
$leccion_anterior_id = $leccion_id - 1;
$id_usuario = $_SESSION['id_usuario'];
$query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior_id";
$result = $conn->query($query_verificar_completada);

if ($result->num_rows == 0) {
    header("location: gf2_6.php");
    exit;
}

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
    <link rel="stylesheet" href="../../../assets/styles/figuras.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #container {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .content-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contenedor {
            margin-right: 20px;
        }

        #myBorder {
            width: 210px;
            height: 210px;
            padding: 5px;
            background-color: #ffffff;
            border-radius: 50%;
        }

        #myCircle {
            width: 200px;
            height: 200px;
            background-color: #ffffff;
            border-radius: 50%;
        }

        .boton {
            margin: 5px;
        }

        #botones {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        #botones a,
        #botones button {
            margin: 0 10px;
        }

        .boton-salir,
        .boton-anterior,
        .boton-siguiente {
            background-color: #aa8976;
        }

    </style>
</head>
<body>
    <div id="container">
        <h2>Propiedades de las formas</h2>
        <h1>¡Cambia de color!</h1>
        <div class="content-container">
            <div class="contenedor">
                <div class="inst">
                    Es hora de poner a prueba los nuevos conocimientos. <br>
                    Al tocar el círculo este cambiará de color. <br>
                    Haz que el área del círculo sea de color morado. <br>
                    Y el borde del círculo sea de color azul. <br>
                    Cuando los colores estén correctos, da click en validar.
                </div>
            </div>
            <div id="myBorder">
                <div id="myCircle"></div>
            </div>
        </div>

        <div class="botones-container">
            <div id="botones">
                <button id="validateButton" class="boton">Validar</button>
            </div>
        </div>

        <div class="botones-container">
            <a href="../gf_nivel2/gf2_6.php">
                <button class="boton boton-anterior">Anterior</button>
            </a>
            <a href="../gf_nivel2/gf2_8.php">
                <button class="boton boton-siguiente">Siguiente</button>
            </a>
            <a href="../gf_nivel 2.php">
                <button class="boton boton-salir">Salir</button>
            </a>
        </div>
        
        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarModal()">&times;</span>
                <p id="modalMensaje"></p>
            </div>
        </div>

        <form id="form-completado" method="post">
            <input type="hidden" name="visto" value="true">
        </form>

        <script src="../../../assets/scripts/geometria_fig.js"></script>
        <script>
            var circle = document.getElementById('myCircle');
            var border = document.getElementById('myBorder');
            var validateButton = document.getElementById('validateButton');
            var modal = document.getElementById('myModal');
            var modalMensaje = document.getElementById('modalMensaje');
            var closeModal = document.getElementsByClassName('close')[0];

            var borderColors = ['black', 'blue', 'orange'];
            var backgroundColors = ['purple', 'green', 'yellow'];
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

            validateButton.addEventListener('click', function (event) {
                event.preventDefault();
                console.log("Border Color: " + border.style.backgroundColor);
                console.log("Background Color: " + circle.style.backgroundColor);
                if (border.style.backgroundColor === 'blue' && circle.style.backgroundColor === 'purple') {
                    modalMensaje.textContent = 'Los colores son correctos!';
                    enviarFormularioCompletado();
                } else {
                    modalMensaje.textContent = 'Vuelve a revisar los colores!';
                }
                modal.style.display = 'block';
            });

            function enviarFormularioCompletado() {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log('Formulario enviado correctamente');
                    }
                };
                xhr.send("visto=true");
            }

            closeModal.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            function cerrarModal() {
                modal.style.display = 'none';
            }
        </script>
    </div>
</body>
</html>
