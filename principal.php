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
        body {
            background-image: url('assets/img/Fondo_mejorado.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }

        .arriba {
            display: flex;
            align-items: center;

        }

        .imge{
            margin-left: -10%;
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
    }

    </style>

</head>

<body>
    <div class="arriba">
        <a href="miPerfil.php">
            <span class="icon icon-user" style="font-size: 50px; margin-left: 400%; color: var(--cafe);"></span>
        </a>
        <a href="premios.php">
            <span class="icon icon-gift" style="font-size: 50px; margin-left: 1800%; color: var(--cafe);"></span>
        </a>
        <h2 class="title">Play With Maths</h2>
    </div>
    <p></p>
<div class="imge">
    <a href="geometria.html" id="enlace">
        <img src="assets/img/Geomet.png" alt="" width="40%, height=40%"> 
    </a>
    <a href="aritmetica.html" id="enlace2">
        <img src="assets/img/aritmetica.png" alt="" width="42%, height=42%">
    </a>
    </div>
</body>

</html>