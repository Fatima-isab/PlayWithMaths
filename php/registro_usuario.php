<?php

include 'conexion_registro.php';

$Nombres = $_POST[''];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);


// Verificar que no se repita el correo
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
    <script>
    ("El correo ya se ha registrado");
    window.location = "resgitro.php";
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