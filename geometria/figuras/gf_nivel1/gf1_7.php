<?php
session_start();
if (!isset($_SESSION['usuario'])) {

    header("location: ../php/registro.php");
    session_destroy();
    die();
}

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// ID de la lección que ha sido vista
$leccion_id = '17';

// Verificar si se ha enviado el formulario de respuesta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["visto"])) {
    // Verificar si el usuario ya ha completado la lección
    $id_usuario = $_SESSION['id_usuario'];
    $query_verificar_completada = "SELECT * FROM lecciones_completadas WHERE id_usuario = $id_usuario AND id_leccion = $leccion_id";
    $result = $conn->query($query_verificar_completada);
    if ($result->num_rows == 0) {
        // Insertar un registro en la tabla <link>Lecciones_Completadas</link>
        $query_insert_completada = "INSERT INTO lecciones_completadas (id_usuario, id_leccion, fecha_completado) VALUES ($id_usuario, $leccion_id, CURRENT_DATE)";
        $conn->query($query_insert_completada);
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubriendo las formas</title>
    <link rel="icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../../../assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../../../assets/styles/root.css">
    <link rel="stylesheet" href="../../../assets/styles/aritmetica_op.css">

</head>

<body>
    <h1>Descubriendo las formas</h1>

    <div class="contenedor">
        <div class="inst visible">Al igual hay diferentes tipos de cuadrilateros.</div>
        <div class="inst">El cuadrado tiene todos sus lados iguales.</div>
        <div class="inst">El rectángulo tiene sus lados opuestos iguales.</div>
        <div class="inst">El trapecio tiene 2 lados iguales y dos diferentes.</div>
        <div class="inst">El rompoide no tiene ángulos rectos.</div>
        <div class="inst">En el pizarrón se muestran los diferentes cuadrilateros.</div>
        <div class="inst">Observa las imágenes y diferencialos.</div>
        <div class="inst">¡Espero hayas aprendido algo nuevo en esta lección!</div>
        


        <div class="control">
            <button id="btnAnt" onclick="anterior()" class="boton">Atrás</button>
            <button id="btnSig" name="continuar" onclick="siguiente()" class="boton">Continuar</button>
        </div>
    </div>

    <div>
        <img class="imgLecc" id="imgLecc" src="../../../assets/img/gf_17.jpg" width="360" height="360" onclick="cambiarImagen()">
    </div>

    <div id="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button id="btnSig" name="visto" class="boton">He terminado</button>
        </form>
    </div>


    <div id=botones>
        <a href="../gf_nivel1/gf1_6.php">
            <button class="boton">Anterior</button>
        </a>

        <a href="../gf_nivel 1.php">
            <button class="boton">Salir</button>
        </a>

        <a href="../gf_nivel1/gf1_8.php">
            <button class="boton">Siguiente</button>
        </a>
    </div>

    <script src="../../../assets/scripts/geometria_fig.js"></script> 
    
</body>

</html>