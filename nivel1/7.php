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
            margin: 0;
            background-color: #fff;
            background-image: url('../assets/img/Fondo_lecciones.jpg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;

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
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape svg {
            max-width: 100%;
            max-height: 100%;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .octagono{
            margin: 0;
        }

        .respuesta {
            width: 50%;
            margin-left: 25%;
            margin-top: 5%;
            font-size: medium;
        }
    </style>
</head>

<body>

    <h1>Descubriendo las formas</h1>
    <br><br><br>

    <h2>¡Toca una figura para conocer su nombre!</h2>

    <div class="shape-container">
        <div class="shape heptagono" onclick="showInfo('Heptágono')"> <svg width="200" height="200">
                <polygon points="100,2 181,35 173,94 117,166 43,120 49,60 105,17" style="fill:blue;stroke:green;stroke-width:2" />
            </svg></div>
        <div class="shape octagono" onclick="showInfo('Octágono')"><svg width="200" height="200">
                <polygon points="100,10 150,10 190,50 190,150 150,190 100,190 60,150 60,50" style="fill:purple;stroke:orange;stroke-width:2" />
            </svg></div>
        <div class="shape eneagono" onclick="showInfo('Eneágono')"><svg width="200" height="200">
                <polygon points="100,10 160,30 190,80 190,150 160,190 100,200 40,190 10,150 10,80" style="fill:gray;stroke:darkred;stroke-width:2" />
            </svg></div>
        <div class="shape decagono" onclick="showInfo('Decágono')"><svg width="200" height="200">
                <polygon points="100,5 155,18 185,65 185,135 155,182 100,195 45,182 15,135 15,65 45,18" style="fill:teal;stroke:brown;stroke-width:2" />
            </svg></div>
    </div>






    <div id="info-container"></div>

    <div>

        <a href="../nivel1/6.php">
            <button>Anterior</button>
        </a>
        <a href="../nivel1/8.php">
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