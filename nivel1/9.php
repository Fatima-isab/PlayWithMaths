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

// Verificar si el usuario ha completado la lección anterior
$id_usuario = $_SESSION['id_usuario'];
$leccion_anterior = '8';
$query_verificar_completada_anterior = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_anterior";
$result_anterior = $conn->query($query_verificar_completada_anterior);

if ($result_anterior->num_rows == 0) {
    // El usuario no ha completado la lección anterior, redirigir a otra página
    header("Location: 8.php");
    exit;
}

// Cerrar la conexión
$conn->close();
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <link rel="icon" href="../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/img/cara.jpg" type="image/x-icon">
</head>
<a href="../assets/img/Examenes/Modulo1.1/P1.png"></a>
<style>
:root{
    --amarillo: #F0E129;
    --cafe: #AA8976;
    --beige: #F0E2D0;
    --verde: #70AF85;
    --verdeazulado: #C6EBC9;
    --fsizeContenido: 22px;
    --fsizesubtitulos:26px;
    
  }
    body {
    font-family: 'Arial', sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
    color: var(--cafe); 
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: var(--beige);
    padding: 20px;
    border-radius: 10px;
}

p {
    font-size: 16px;
    font-weight: bold;
    color: #2c3e50;
}

img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="radio"] {
    margin-right: 5px;
}

input[type="submit"] {
    background-color: var(--cafe);
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: var(--cafe);
}

.imagen-pregunta {
    display: block;
    margin: 0 auto; /* Centra horizontalmente */
    max-width: 100%;
    height: auto;
    width: 200px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-salida {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #FF0000;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
    }

    .btn-salida:hover {
        background-color: #FFA500;
    }


</style>

<body>
    <h1>Descubriendo las formas</h1>
    <a class="btn-salida" href="../nivel1.php">X</a>
    <form action="calificar_examen.php" method="post" onsubmit="return validarFormulario();">
        <?php
        $preguntas = array(
            "1" => array(
                "texto" => "¿Cuál es el nombre de la siguiente figura?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P1.png"
            ),
            "2" => array(
                "texto" => "¿Cuántos lados tienen las siguientes figuras?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P2.webp"
            ),
            "3" => array(
                "texto" => "¿Cuántos lados tiene un decágono?",
                "imagen" => ""
            ),
            "4" => array(
                "texto" => "¿Cuál es el nombre de la figura que no tiene ningún lado?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P4.jpeg"
            ),
            "5" => array(
                "texto" => "¿Cuántos lados tiene un triángulo?",
                "imagen" => "imagen5.jpg"
            ),
            "6" => array(
                "texto" => "¿Qué triángulo tiene todos sus lados iguales?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P6.png"
            ),
            "7" => array(
                "texto" => "¿Cuál figura es un rectángulo?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P7.jpg"
            ),
            "8" => array(
                "texto" => "¿Cuántos lados tiene un octágono?",
                "imagen" => ""
            ),
            "9" => array(
                "texto" => "¿Cuál es el nombre de la siguiente figura?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P9.png"
            ),
            "10" => array(
                "texto" => "¿Comó se llama la figura que tiene 7 lados?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P10.jpg"
            )
        );

        $opciones_respuesta = array(
            "pregunta1" => array(
                "opcion1" => "Cuadrado",
                "opcion2" => "Rectángulo",
                "opcion3" => "Romboide"
            ),
            "pregunta2" => array(
                "opcion1" => "5",
                "opcion2" => "3",
                "opcion3" => "4"
            ),
            "pregunta3" => array(
                "opcion1" => "8",
                "opcion2" => "9",
                "opcion3" => "10"
            ),
            "pregunta4" => array(
                "opcion1" => "Cuadrado",
                "opcion2" => "Triángulo",
                "opcion3" => "Circulo",
                "opcion4" => "Rectángulo"
            ),
            "pregunta5" => array(
                "opcion1" => "3",
                "opcion2" => "4",
                "opcion3" => "5"
            ),
            "pregunta6" => array(
                "opcion1" => "Equilátero",
                "opcion2" => "Isósceles",
                "opcion3" => "Escaleno"
            ),
            "pregunta7" => array(
                "opcion1" => "1",
                "opcion2" => "2"
            ),
            "pregunta8" => array(
                "opcion1" => "7",
                "opcion2" => "8",
                "opcion3" => "9"
            ),
            "pregunta9" => array(
                "opcion1" => "Pentágono",
                "opcion2" => "Eneágono",
                "opcion3" => "Hexágono"
            ),
            "pregunta10" => array(
                "opcion1" => "Heptágono",
                "opcion2" => "Octágono",
                "opcion3" => "Decágono",
                "opcion4" => "Undecágono"
            )
        );

        foreach ($preguntas as $num_pregunta => $pregunta_info) {
            echo "<p> {$pregunta_info['texto']}</p>";
            echo "<img class='imagen-pregunta' src='{$pregunta_info['imagen']}' alt=''><br>";
            
            foreach ($opciones_respuesta["pregunta$num_pregunta"] as $value => $opcion) {
                echo "<label><input type='radio' name='pregunta$num_pregunta' value='$value'> $opcion</label><br>";
            }

            echo "<br>";
        }
        ?>
        <input type="submit" value="Enviar Examen">
    </form>
</body>

<script>
        function validarFormulario() {
            var preguntas = <?php echo json_encode(array_keys($preguntas)); ?>;
            
            for (var i = 0; i < preguntas.length; i++) {
                var respuestaSeleccionada = false;

                // Verificar si al menos una opción ha sido seleccionada para cada pregunta
                var opciones = document.getElementsByName('pregunta' + preguntas[i]);
                for (var j = 0; j < opciones.length; j++) {
                    if (opciones[j].checked) {
                        respuestaSeleccionada = true;
                        break;
                    }
                }

                if (!respuestaSeleccionada) {
                    alert('Por favor, selecciona una respuesta para la pregunta ' + preguntas[i]);
                    return false;
                }
            }

            return true; // Enviar el formulario si todas las preguntas tienen respuesta
        }
    </script>

</html>

