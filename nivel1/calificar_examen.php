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

    echo "<h2>Examen actualizado</h2>";
    echo "<p>Nueva calificación: $calificacion / 10</p>";
} else {
    // Si no existe, insertar un nuevo registro
    $query_insert_resultado = "INSERT INTO examenes_realizados (id_examen, id_usuario, titulo_examen, fecha_realizacion, calificacion)
                               VALUES ($id_examen, $id_usuario, '$titulo_examen', '$fecha_realizacion', $calificacion)";
    $conn->query($query_insert_resultado);

    echo "<h2>Examen completado</h2>";
    echo "<p>Calificación obtenida: $calificacion / 10</p>";
}

$conn->close();
?>
