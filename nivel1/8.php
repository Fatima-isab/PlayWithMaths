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

        .triangulo{
            width: 0;
            height: 0;
            border-right: 100px solid transparent;
            border-top: 100px solid transparent;
            border-left: 100px solid transparent;
            border-bottom: 100px solid var(--beige);
        }
        .heptagono{
            margin-top: 5%;
            margin-left: 5%;
        }
        .pentagono{
            margin-top: 5%;
            margin-left: 5%;
        }

        .hexagono{
            margin-top: 5%;
            margin-left: 5%;
        }
    </style>
</head>

<body>
    <h1>Descubriendo las formas</h1>
    <br>
    <h2>¿Cuál es la figura con más lados?</h2>
    <div id="info-container"></div>
        <div class="shape-container">
    <div class="shape triangulo" onclick="showInfo('Triángulo')"></div>
    <div class="shape hexagono" onclick="showInfo('Héxagono')"><svg width="200" height="200">
                <polygon points="75,5 144,45 144,105 75,145 6,105 6,45" style="fill:red;stroke:red;stroke-width:2" />
            </svg></div>
    <div class="shape heptagono" onclick="showInfo('Héptagono')"><svg width="200" height="200">
                <polygon points="100,2 181,35 173,94 117,166 43,120 49,60 105,17" style="fill:blue;stroke:green;stroke-width:2" />
            </svg></div>
    <div class="shape pentagono" onclick="showInfo('Pentágono')"> <svg width="190" height="200">
            <polygon points="100,10 190,78 160,198 40,198  10,78" style="fill:var(--amarillo);stroke:#554;stroke-width:2" />
        </svg></div>
        </div>

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


    <script>
        function showInfo(shape) {
            const infoContainer = document.getElementById('info-container');
            infoContainer.innerHTML = `<p class="respuesta">Es un: <strong>${shape}</strong></p>`;
        }
    </script>

</body>

</html>