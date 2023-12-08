<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/root.css">
    <style>
        body {
            text-align: center;
            margin: 40px;
            background-color: #fff;
            background-image: url('../assets/img/Fondo_lecciones.jpg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }

        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }

        .shape {
            width: 300px;
            height: 300px;
            display: flex;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .rectangulo {
            width: 250px;
            height: 150px;
            border: 2px solid #554;
            background: var(--verde);
            margin-left: 40%;
            margin-bottom: 15%;
        }

        .rombo {
            width: 150px;
            height: 150px;
            border: 2px solid #554;
            background: var(--verdeazulado);
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            margin-top: -30%;
        }

        .cuadrado {
            width: 150px;
            height: 150px;
            border: 2px solid #554;
            background: var(--cafe);
            margin-top: -18%;
            margin-left: 15%;
        }

        .pentagono {
            margin-top: -10%;
            margin-left: 70%;
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br><br><br>
    <h2>¿Cuál no es un cuadrilatero?</h2>
    <br><br><br>

    <div class="shape rectangulo"></div>
    <div class="shape cuadrado"></div>
    <div class="shape rombo"></div>
    <div class="shape pentagono"> <svg width="300" height="300">
            <polygon points="150,10 240,75 210,225 90,225 60,75" style="fill:var(--amarillo);stroke:#554;stroke-width:2" />
        </svg></div>



    <div>
    <a href="../nivel1/7.php">
        <button>Anterior</button>
    </a>
    
    <a href="../nivel1/9.php">
        <button>Siguiente</button>
    </a>

    <a href="../nivel1.php">
        <button>Salir</button>
    </a>
    </div>

</body>

</html>