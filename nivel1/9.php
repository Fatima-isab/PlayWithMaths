<?php
// Conexión a la base de datos (Asegúrate de tener tus credenciales correctas)
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

$id_examen = '1';
// Consulta para obtener las preguntas del examen
$query = "SELECT * FROM preguntas_examenes WHERE id_examen = $id_examen";
$result = $conn->query($query);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    $questions = array();

    // Obtener las preguntas en un formato JSON
    while ($row = $result->fetch_assoc()) {
        $questions[] = array(
            'id_pregunta' => $row['id_pregunta'],
            'enunciado_pregunta' => $row['enunciado_pregunta'],
            'respuesta_correcta' => $row['respuesta_correcta'],
            'imagen_pregunta' => $row['imagen_pregunta'],
        );
    }

    // Devolver las preguntas como JSON
    echo json_encode($questions);
} else {
    echo json_encode(array('message' => 'No hay preguntas disponibles'));
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
    
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br><br><br>
    <h2>Examen</h2>
    <br><br><br>


    <a href="../nivel1/8.php">
        <button>Anterior</button>
    </a>

    <a href="../nivel1.php">
        <button>Salir</button>
    </a>
    </div>

</body>

</html>