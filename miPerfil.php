<?php
 session_start();

 if(!isset($_SESSION['usuario'])){

    header("location: registro.php");
    session_destroy();
    die();
 }
//session_destroy();
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "maths";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$id=$_SESSION['id_usuario'];

$res=mysqli_query($conn, "SELECT idvendedores FROM vendedores WHERE idpersona=$id");
$row = mysqli_fetch_assoc($res);
$idv = $row['idvendedores'];
// Consulta para obtener los datos de la tabla
$sql = "SELECT IdProductos, IdVendedor, Nombre, Ruta_Foto, Precio, Descripcion, FCaducidad, Categoria, 
Inventario FROM productos WHERE IdVendedor=$idv";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play With Maths</title>
    <link rel="stylesheet" type="text/css" href="./assets/styles/style.css">
    <style>
        body {
            background-image: url('assets/img/Fondo.jpeg');
            background-size: 100% auto;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <span class="title">Play With Maths</span>
    <p></p>
    <a href="geometría.html" id="enlace">
    <img src="assets/img/Geometria.png" alt="">
    <div class="imge">
    <p>Geometria</p>
    </div>
    </a>

</body>
</html>