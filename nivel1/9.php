<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
</head>
<a href="../assets/img/Examenes/Modulo1.1/P1.png"></a>
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
    body {
    font-family: 'Arial', sans-serif;
    margin: 20px;
}

h1 {
    text-align: center;
    color: var(--cafe); /* Cambia el color según tus preferencias */
}

form {
    max-width: 600px;
    margin: 0 auto;
    background-color: var(--beige);
    padding: 20px;
    border-radius: 10px;
}

p {
    font-size: 16px;
    font-weight: bold;
    color: #2c3e50;
}

img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

label {
    display: block;
    margin-bottom: 10px;
}

input[type="radio"] {
    margin-right: 5px;
}

input[type="submit"] {
    background-color: var(--cafe);
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: var(--cafe);
}

.imagen-pregunta {
    display: block;
    margin: 0 auto; /* Centra horizontalmente */
    max-width: 100%;
    height: auto;
    width: 200px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


</style>

<body>
    <h1>Descubriendo las formas</h1>
    <form action="calificar_examen.php" method="post">
        <?php
        $preguntas = array(
            "1" => array(
                "texto" => "¿Cuál es el nombre de la siguiente figura?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P1.png"
            ),
            "2" => array(
                "texto" => "¿Cuántos lados tienen las siguientes figuras?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P2.webp"
            ),
            "3" => array(
                "texto" => "¿Cuántos lados tiene un decágono?",
                "imagen" => ""
            ),
            "4" => array(
                "texto" => "¿Cuál es el nombre de la figura que no tiene ningun lado?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P4.jpeg"
            ),
            "5" => array(
                "texto" => "¿Cuántos lados tiene un triángulo?",
                "imagen" => "imagen5.jpg"
            ),
            "6" => array(
                "texto" => "¿Qué triángulo tiene todos sus lados iguales?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P6.png"
            ),
            "7" => array(
                "texto" => "¿Cuál figura es un rectangulo?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P7.jpg"
            ),
            "8" => array(
                "texto" => "¿Cuántos lados tiene un octágono?",
                "imagen" => ""
            ),
            "9" => array(
                "texto" => "¿Cuál es el nombre de la siguiente figura?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P9.png"
            ),
            "10" => array(
                "texto" => "¿Comó se llama la figura que tiene 7 lados?",
                "imagen" => "../assets/img/Examenes/Modulo1.1/P10.jpg"
            )
        );

        $opciones_respuesta = array(
            "pregunta1" => array(
                "opcion1" => "Cuadrado",
                "opcion2" => "Rectangulo",
                "opcion3" => "Romboide"
            ),
            "pregunta2" => array(
                "opcion1" => "5",
                "opcion2" => "3",
                "opcion3" => "4"
            ),
            "pregunta3" => array(
                "opcion1" => "8",
                "opcion2" => "9",
                "opcion3" => "10"
            ),
            "pregunta4" => array(
                "opcion1" => "Cuadrado",
                "opcion2" => "Triángulo",
                "opcion3" => "Circulo",
                "opcion4" => "Rectángulo"
            ),
            "pregunta5" => array(
                "opcion1" => "3",
                "opcion2" => "4",
                "opcion3" => "5"
            ),
            "pregunta6" => array(
                "opcion1" => "Equilatero",
                "opcion2" => "Isósceles",
                "opcion3" => "Escaleno"
            ),
            "pregunta7" => array(
                "opcion1" => "1",
                "opcion2" => "2"
            ),
            "pregunta8" => array(
                "opcion1" => "7",
                "opcion2" => "8",
                "opcion3" => "9"
            ),
            "pregunta9" => array(
                "opcion1" => "Pentágono",
                "opcion2" => "Eneágono",
                "opcion3" => "Hexágono"
            ),
            "pregunta10" => array(
                "opcion1" => "Heptágono",
                "opcion2" => "Octágono",
                "opcion3" => "Decágono",
                "opcion4" => "Undecágono"
            )
        );

        foreach ($preguntas as $num_pregunta => $pregunta_info) {
            echo "<p> {$pregunta_info['texto']}</p>";
            echo "<img class='imagen-pregunta' src='{$pregunta_info['imagen']}' alt=''><br>";
            
            foreach ($opciones_respuesta["pregunta$num_pregunta"] as $value => $opcion) {
                echo "<label><input type='radio' name='pregunta$num_pregunta' value='$value'> $opcion</label><br>";
            }

            echo "<br>";
        }
        ?>
        <input type="submit" value="Enviar Examen">
    </form>
</body>
</html>

