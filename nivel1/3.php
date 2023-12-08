<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubriendo las formas</title>
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

        h1 {
            color: var(--rojo);
        }

        .shape-container {
            display: flex;
            justify-content: space-around;
            margin-top: 4%;
        }

        .shape {
            width: 200px;
            height: 200px;
            display: flex;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

       
       

        .trapecio {
            width: 150px;
            height: 0px;
            border-right: 60px solid transparent;
            border-left: 60px solid transparent;
            border-bottom: 100px solid #428bca;
            margin-top: 2%;
            margin-left: -2%;
        }

        .ovalo {
            width: 250px;
            height: 100px;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            background: #5cb85c;
            border: #554;
            margin-top: 1.5%;
            margin-left: -5%;
        }

        .hexagono {
            margin-left: -60%;
            margin-top: 10%;
        }

        .pentagono {
            margin-left: -10%;
            margin-top: 10%;
        }
    </style>
</head>

<body>

    <h1>Descubriendo las formas</h1>
        <br><br><br>
    <h2>¡Toca una figura para conocer su nombre!</h2>

    <div class="shape-container">
        <div class="shape trapecio" onclick="showInfo('Trapecio')"></div>
        <div class="shape ovalo" onclick="showInfo('Ovalo')"></div>
        <div class="shape hexagono" onclick="showInfo('Héxagono')"><svg width="200" height="200">
                <polygon points="75,5 144,45 144,105 75,145 6,105 6,45" style="fill:red;stroke:red;stroke-width:2" />
            </svg></div>
        <div class="shape pentagono" onclick="showInfo('Péntagono')"><svg width="250" height="150">
                <polygon points="125,5 200,75 165,145 85,145 50,75" style="fill:yellow;stroke:yellow;stroke-width:2" />
            </svg></div>
    </div>


        <div id="info-container"></div>

        <div class="botones">
            <a href="../nivel1/2.php">
                <button>Anterior</button>
            </a>
            <a href="../nivel1/4.php">
                <button>Siguiente</button>
            </a>

            <a href="../nivel1.php">
                <button>Salir</button>
            </a>
        </div>


        <script>
            function showInfo(shape) {
                const infoContainer = document.getElementById('info-container');
                infoContainer.innerHTML = `<p class="respuesta">Es un: <strong>${shape}</strong></p>`;
            }
        </script>

</body>

</html>