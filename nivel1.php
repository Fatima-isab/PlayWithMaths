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
            background-color:var(--verde);
            border-radius: 50%;
            display: inline-block;
            margin: 25px;
            position: relative;
        }

        .circle::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40px;
            color: white;
        }
    </style>

<div class="circle-container">
        <a href="./nivel1/1.php">
        <div class="circle"><span>1</span></div>
        </a>
        <a href="./nivel1/2.php">
        <div class="circle"><span>2</span></div>
        </a>
        <div class="circle"><span>3</span></div>
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