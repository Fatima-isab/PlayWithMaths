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

$id_usuario = $_SESSION['id_usuario'];

// Array para almacenar el texto de las bananas
$bananas_text_1 = [
    19 => "🔒", 29 => "🔒", 39 => "🔒", 49 => "🔒", 59 => "🔒", 69 => "🔒"
];

$bananas_text_2 = [
    179 => "🔒", 189 => "🔒", 199 => "🔒", 209 => "🔒", 219 => "🔒", 229 => "🔒"
];

// Función para verificar si una lección está completada
function isLessonCompleted($conn, $id_usuario, $lesson_id) {
    $query = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $lesson_id";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

// Verificar el estado de cada lección en el primer contenedor
foreach ($bananas_text_1 as $lesson_id => &$text) {
    if (isLessonCompleted($conn, $id_usuario, $lesson_id)) {
        $text = "🍌"; // Cambiar el texto si la lección está completada
    }
}

// Verificar el estado de cada lección en el segundo contenedor
foreach ($bananas_text_2 as $lesson_id => &$text) {
    if (isLessonCompleted($conn, $id_usuario, $lesson_id)) {
        $text = "🍌"; // Cambiar el texto si la lección está completada
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play With Maths</title>
    <link rel="icon" href="assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/styles/premios.css">
    <link rel="stylesheet" type="text/css" href="./assets/styles/style.css">
    <link rel="stylesheet" href="assets/icons/iconos.css">
    <style>
        /* Estilos CSS para los contenedores de premios */
body {
    text-align: center;
    background-color: #fff;
    background-image: url('assets/img/fondo3.jpg');
    background-size: 100% auto;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
    background-color: fff;
}



        .premios-container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 35%;
            text-align: center;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }
        .banana {
            font-size: 55px;
            margin: 10px;
            transition: color 0.3s;
            cursor: pointer;
        }
        .banana-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .locked .banana {
            color: grey;
        }
        .unlocked-blue .banana {
            color: blue;
        }
        .unlocked-pink .banana {
            color: pink;
        }
       
        .arriba {
    display: flex;
    align-items: center;

    .icon {
        text-decoration: none; 
        display: inline-block; 
        border-radius: 50%;
        overflow: hidden; 
        width: 60px; 
        height: 60px;
        background-color: var(--beige); 
        text-align: center;
        align-items: center;
    }
}
    </style>
</head>
<body>
<div class="arriba">
        <a href="principal.php">
            <span class="icon icon-home" style="font-size: 50px; margin-left: 250%; color: var(--cafe);"></span>
        </a>
        <h2 class="title">Premios</h2>
    </div>

    <!-- Contenedor de premios 1 -->
    <div class="premios-container">
        <h2>Figuras</h2>
        <div class="banana-container">
            <?php foreach ($bananas_text_1 as $lesson_id => $text): ?>
                <div class="banana <?php echo isLessonCompleted($conn, $id_usuario, $lesson_id) ? 'unlocked-blue' : 'locked'; ?>"><?php echo $text; ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Contenedor de premios 2 -->
    <div class="premios-container">
        <h2>Operaciones básicas</h2>
        <div class="banana-container">
            <?php foreach ($bananas_text_2 as $lesson_id => $text): ?>
                <div class="banana <?php echo isLessonCompleted($conn, $id_usuario, $lesson_id) ? 'unlocked-pink' : 'locked'; ?>"><?php echo $text; ?></div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
