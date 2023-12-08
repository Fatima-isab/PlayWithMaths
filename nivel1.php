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
    $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '1'";
    $result = $conn->query($query_verificar_completada);
    if ($result->num_rows == 0) {
        $circleColor = "var(--verdeazulado)";
        } else {
            $circleColor = "var(--verde)";
        }

        $query_verificar_completada2 = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = '2'";
        $result2 = $conn->query($query_verificar_completada2);
        if ($result2->num_rows == 0) {
            $circleColor2 = "var(--verdeazulado)";
            } else {
                $circleColor2 = "var(--verde)";
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
    <link rel="stylesheet" type="text/css" href="./assets/styles/style.css">
    <style>
        body {
            background-image: url('assets/img/Fondo_mejorado.jpg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <span class="title">Descubriendo las formas</span>
    

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
        .title{
            margin-left: 30%;
            font-size: 50px;
        }
        .circle-container {
            text-align:center;
            font-size: 80px;
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
            background-color:  <?php echo $circleColor; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
        }

        .circle2 {
            width: 100px;
            height: 100px;
            background-color:  <?php echo $circleColor2; ?>;
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
        }


      
    </style>

<div class="circle-container">
        <a href="./nivel1/1.php">
        <div class="circle1"><span>1</span></div>
        </a>
        <a href="./nivel1/2.php">
        <div class="circle2"><span>2</span></div>
        </a>
        <a href="./nivel1/3.php">
        <div class="circle"><span>3</span></div>
        </a>
        <br>
        <div class="circle"><span>4</span></div>
        <div class="circle"><span>5</span></div>
        <div class="circle"><span>6</span></div>
        <br>
        <div class="circle"><span>7</span></div>
        <div class="circle"><span>8</span></div>
        <div class="circle"><span>9</span></div>
    </div>

</body>
</html>