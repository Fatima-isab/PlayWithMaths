<?php

include 'conexion_registro.php';

$nombre_usuario = $_POST['nombre_usuario'];
$edad = $_POST['edad'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$contraseña = hash('sha512', $contraseña);

$query = "INSERT INTO usuarios (nombre_usuario, edad, correo, contraseña, id_avatar) 
VALUES('$nombre_usuario', 'edad', '$correo', '$contraseña', 1)"; 

// Verificar que no se repita el correo
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
    <script>
    alert("El correo ya se ha registrado");
    window.location = "registro.php";
    </script>
    ';
    exit();
} 
$ejecutar = mysqli_query($conexion, $query);
if ($ejecutar) {
    echo '<script>
    alert("Registro exitoso");
    window.location = "registro.php";
    </script>';
} else {
    echo '<script>
    alert("No se pudo registrar, inténtalo más tarde");
    window.location = "registro.php";
    </script>';
}

mysqli_close($conexion);

?>