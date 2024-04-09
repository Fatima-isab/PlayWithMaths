<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrastrar y Soltar Figuras</title>
    <style>
        #dropzone {
            width: 300px;
            height: 300px;
            border: 2px dashed #aaa;
            text-align: center;
            line-height: 300px;
            margin: 20px auto;
        }

        #dropzone.hover {
            border-color: #333;
        }

        .shape {
            display: inline-block;
            width: 100px;
            height: 100px;
            margin: 10px;
            cursor: pointer;
        }

        #cuadro {
            background-color: blue;
            border-radius: 5px;
        }

        #triangulo {
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 50px solid transparent;
            border-bottom: 100px solid green;
        }

        #circulo {
            background-color: red;
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="actPuzzle" style="background-color: yellow;">
    <div id="dropzone" ondragover="allowDrop(event)" ondrop="drop(event)" ondragenter="dragEnter(event)" ondragleave="dragLeave(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
        Arrastra el círculo aquí
    </div>

    <div>
        <div id="cuadro" class="shape" draggable="true" ondragstart="drag(event)" ontouchstart="touchStart(event)"></div>
        <div id="triangulo" class="shape" draggable="true" ondragstart="drag(event)" ontouchstart="touchStart(event)"></div>
        <div id="circulo" class="shape" draggable="true" ondragstart="drag(event)" ontouchstart="touchStart(event)"></div>
    </div>
    </div>
    
    <script src="../../../assets/scripts/puzzle.js"></script>
</body>
</html>
