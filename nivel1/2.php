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
            margin-top: 30px;
        }

        .shape {
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .shape:hover {
            transform: scale(1.2);
        }

        .trianguloo{
            background-color: none;
            margin-top: 110px;
            margin-left: 15px;
        }
        .triangulop{
            background-color: none;
            margin-top: 120px;
            margin-left: 25px;
        }
        .trianguloq{
            background-color: none;
            margin-top: 200px;
            margin-left: 5px;
        }
        .triangulor{
            background-color: none;
            margin-top: 200px;
            margin-left: 5px;
        }
        .triangulox{
            width: 0;
            height: 0;
            border-right: 100px solid transparent;
            border-top: 100px solid transparent;
            border-left: 100px solid transparent;
            border-bottom: 100px solid var(--verde);
            margin-top: 170px;
        }
        .trianguloy{
            width: 0; 
            height: 0; 
            border-left: 100px solid var(--rojo);
            border-top: 50px solid transparent;
            border-bottom: 50px solid transparent; 
            margin-right: 150px;
        }
        .trianguloz{
            width: 0; 
            height: 0; 
            border-left: 100px solid #f0ad4e;
            border-top: 50px solid transparent;
            border-bottom: 50px solid transparent; 
            margin-right: 35px;
            margin-top: 120px;
        }
        .respuesta{
            width: 50%;
            margin-left: 25%;
            margin-top: 1%;
            font-size: medium;  
        }

        #anterior{
            margin-top: 17%;
        }
    </style>
</head>
<body>

    <h1>Descubriendo las formas</h1>

    <div class="shape-container">
        <div class="shape trianguloo" onclick="showInfo('Triángulo')">
        <svg>
        <polygon points="60,20 100,80 20,100" style="fill:var(--amarillo)" />
        </svg></div>
        <div class="shape triangulop" onclick="showInfo('Triángulo')">
        <svg>
        <polygon points="80,20 100,100 20,100" style="fill:var(--rojo)" />
        </svg></div>
        <div class="shape trianguloq" onclick="showInfo('Triángulo')">
        <svg>
        <polygon points="100,20 100,100 20,100" style="fill:var(--rosa)" />
        </svg></div>
        <div class="shape trangulor" onclick="showInfo('Triángulo')">
        <svg>
        <polygon points="60,20 100,100 20,100" style="fill:var(--azul)" />
        </svg></div>
        <div class="shape triangulox" onclick="showInfo('Triángulo')"></div>
        <div class="shape trianguloy" onclick="showInfo('Triángulo')"></div>
        <div class="shape trianguloz" onclick="showInfo('Triángulo')"></div>  
    </div>
    
    <a href="../nivel1/1.php">
    <button id="anterior">Anterior</button>
    </a>
    <div id="info-container"></div>
    <a href="../nivel1.php">
    <button>Salir</button>
    </a>
    <a href="../nivel1/3.php">
    <button>Siguiente</button>
    </a>

    <script>
        function showInfo(shape) {
            const infoContainer = document.getElementById('info-container');
            infoContainer.innerHTML = `<p class="respuesta">Es un: <strong>${shape}</strong></p>`;
        }
    </script>

</body>
</html>