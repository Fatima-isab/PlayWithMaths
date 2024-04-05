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


// Verificar si el usuario ya ha completado la lección
$id_usuario = $_SESSION['id_usuario'];
$query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '11'";
$result = $conn->query($query_verificar_completada);
if ($result->num_rows == 0) {
    $circleColor = "var(--verdeazulado)";
} else {
    $circleColor = "var(--verde)";
}

$query_verificar_completada2 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '12'";
$result2 = $conn->query($query_verificar_completada2);
if ($result2->num_rows == 0) {
    $circleColor2 = "var(--verdeazulado)";
} else {
    $circleColor2 = "var(--verde)";
}

$query_verificar_completada3 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '13'";
$result3 = $conn->query($query_verificar_completada3);
if ($result3->num_rows == 0) {
    $circleColor3 = "var(--verdeazulado)";
} else {
    $circleColor3 = "var(--verde)";
}

$query_verificar_completada4 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '14'";
$result4 = $conn->query($query_verificar_completada4);
if ($result4->num_rows == 0) {
    $circleColor4 = "var(--verdeazulado)";
} else {
    $circleColor4 = "var(--verde)";
}


$query_verificar_completada5 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '15'";
$result5 = $conn->query($query_verificar_completada5);
if ($result5->num_rows == 0) {
    $circleColor5 = "var(--verdeazulado)";
} else {
    $circleColor5 = "var(--verde)";
}

$query_verificar_completada6 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '16'";
$result6 = $conn->query($query_verificar_completada6);
if ($result6->num_rows == 0) {
    $circleColor6 = "var(--verdeazulado)";
} else {
    $circleColor6 = "var(--verde)";
}

$query_verificar_completada7 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '17'";
$result7 = $conn->query($query_verificar_completada7);
if ($result7->num_rows == 0) {
    $circleColor7 = "var(--verdeazulado)";
} else {
    $circleColor7 = "var(--verde)";
}

$query_verificar_completada8 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '18'";
$result8 = $conn->query($query_verificar_completada8);
if ($result8->num_rows == 0) {
    $circleColor8 = "var(--verdeazulado)";
} else {
    $circleColor8 = "var(--verde)";
}

// Consultar la calificación más reciente del usuario
$query_calificacion = "SELECT calificacion FROM examenes_realizados WHERE id_usuario = $id_usuario ORDER BY fecha_realizacion DESC LIMIT 1";
$result_calificacion = $conn->query($query_calificacion);

if ($result_calificacion->num_rows > 0) {
    $row = $result_calificacion->fetch_assoc();
    $calificacion = $row['calificacion'];

    // Definir colores
    $colorAprobado = "var(--verde)";
    $colorReprobado = "var(--cafe)";

    // Verificar si la calificación es superior a 6
    if ($calificacion > 6) {
        $circleColor9 = $colorAprobado;
    } else {
        $circleColor9 = $colorReprobado;
    }
} else {
    // Si no hay calificación, asignar un color por defecto
    $circleColor9 = "var(--verdeazulado)"; 
}




// Cerrar la conexión
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
    <link rel="stylesheet" type="text/css" href="./assets/styles/style.css">
    <link rel="stylesheet" href="assets/icons/iconos.css">
    <style>
        :root {
            --amarillo: #F0E129;
            --cafe: #AA8976;
            --beige: #F0E2D0;
            --verde: #70AF85;
            --verdeazulado: #C6EBC9;
            --blanco: #FFFF;
            --negro: #000000;
            --fsizeContenido: 22px;
            --fsizesubtitulos: 26px;

        }

        body {
            background-image: url('assets/img/Fondo_mejorado.jpg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }



        .arriba {
            display: flex;
            align-items: center;
        }

        a {
            display: inline-block;
        }

        .title {
            margin-left: 30%;
            font-size: 50px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: red;
        }

        .circle-container {
            text-align: center;
            font-size: 80px;
            margin-left: 9%;
            margin-top: -2%;
        }

        .circle {
            width: 100px;
            height: 100px;
            background-color: var(--verdeazulado);
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
        }

        .circle1 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000000;
        }

        .circle2 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor2; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle3 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor3; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle4 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor4; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle5 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor5; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle6 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor6; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle7 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor7; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle8 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor8; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

        .circle9 {
            width: 100px;
            height: 100px;
            background-color: <?php echo $circleColor9; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
            color:#000;
        }

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
    </style>
</head>

<body>
    <div class="arriba">
        <a href="principal.php">
            <span class="icon icon-home" style="font-size: 50px; margin-left: 250%; margin-top:80%; color: var(--cafe);"></span>
        </a>
        <h2 class="title">Descubriendo las formas</h2>
    </div>

    <div class="circle-container">
        <a href="./nivel1/1.php">
            <div class="circle1"><span>1</span></div>
        </a>
        <a href="./nivel1/2.php">
            <div class="circle2"><span>2</span></div>
        </a>
        <a href="./nivel1/3.php">
            <div class="circle3"><span>3</span></div>
        </a>
        <br>
        <a href="./nivel1/4.php">
            <div class="circle4"><span>4</span></div>
        </a>
        <a href="./nivel1/5.php">
            <div class="circle5"><span>5</span></div>
        </a>
        <a href="./nivel1/6.php">
            <div class="circle6"><span>6</span></div>
        </a>
        <br>
        <a href="./nivel1/7.php">
            <div class="circle7"><span>7</span></div>
        </a>
        <a href="./nivel1/8.php">
            <div class="circle8"><span>8</span></div>
        </a>
        <a href="./nivel1/9.php">
            <div class="circle9"><span>9</span></div>
        </a>
    </div>

</body>

</html>