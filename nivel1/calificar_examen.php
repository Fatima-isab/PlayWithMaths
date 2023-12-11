<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$id_usuario = $_SESSION['id_usuario'];
$id_examen = 1; 
$titulo_examen = "Descubriendo las formas";
$fecha_realizacion = date('Y-m-d');

$calificacion = 0;

$respuestas_correctas = array(
    "pregunta1" => "opcion1",
    "pregunta2" => "opcion2",
    "pregunta3" => "opcion3",
    "pregunta4" => "opcion3",
    "pregunta5" => "opcion1",
    "pregunta6" => "opcion1",
    "pregunta7" => "opcion2",
    "pregunta8" => "opcion2",
    "pregunta9" => "opcion3",
    "pregunta10" => "opcion1"
);

foreach ($respuestas_correctas as $pregunta => $respuesta_correcta) {
    if (isset($_POST[$pregunta])) {
        $respuesta_usuario = $_POST[$pregunta];
        if ($respuesta_usuario == $respuesta_correcta) {
            $calificacion += 1; 
        }
    }
}

// Verificar si ya existe un registro para ese usuario y examen
$query_verificar_examen = "SELECT id_realizado FROM examenes_realizados WHERE id_usuario = $id_usuario AND id_examen = $id_examen";
$result_verificar_examen = $conn->query($query_verificar_examen);

if ($result_verificar_examen->num_rows > 0) {
    // Si ya existe, actualizar la calificación
    $row = $result_verificar_examen->fetch_assoc();
    $id_realizado = $row['id_realizado'];

    // Actualizar la calificación en el registro existente
    $query_actualizar_calificacion = "UPDATE examenes_realizados SET calificacion = $calificacion WHERE id_realizado = $id_realizado";
    $conn->query($query_actualizar_calificacion);

    //echo "<h2>Examen actualizado</h2>";
    //echo "<p>Nueva calificación: $calificacion / 10</p>";
} else {
    // Si no existe, insertar un nuevo registro
    $query_insert_resultado = "INSERT INTO examenes_realizados (id_examen, id_usuario, titulo_examen, fecha_realizacion, calificacion)
                               VALUES ($id_examen, $id_usuario, '$titulo_examen', '$fecha_realizacion', $calificacion)";
    $conn->query($query_insert_resultado);

    //echo "<h2>Examen completado</h2>";
    //echo "<p>Calificación obtenida: $calificacion / 10</p>";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados del Cuestionario</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #F0E2D0;
        }

        .resultados-container {
            text-align: center;
            padding: 20px;
            background-color: #F0E129;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: var(--cafe);
        }

        p {
            font-size: 18px;
            color: #2c3e50;
        }

        .btn-regreso {
            background-color: #AA8976;
            color: #000000;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }

        .btn-regreso:hover {
            background-color: #F0E2D0;
        }
    </style>
</head>
<body>
    <div class="resultados-container">
        <h2>Resultados del Cuestionario</h2>

        <?php
        echo "<p>Tu calificación es: $calificacion / 10</p>";

        if ($calificacion < 6) {
            echo "<p>Vuelve a intentar el examen. ¡Ánimo!</p>";
        } else {
            echo "<p>¡Felicidades! Has logrado superar el examen. ¡Bien hecho!</p>";
        }
        ?>
        <a class="btn-regreso" href="../nivel1.php">Volver a la Página Principal</a>
    </div>
</body>
</html>
