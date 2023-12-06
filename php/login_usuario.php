<?php
session_start();
include 'conexion_registro.php';

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$contraseña = hash('sha512', $contraseña);


$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' 
and contraseña ='$contraseña'");

if(mysqli_num_rows($validar_login) > 0){
    $usuario = mysqli_fetch_assoc($validar_login); // Obtener los datos del usuario
    $_SESSION['id_uauario'] = $usuario['id_usuario']; // Guardar el IdPersonas(llave primaria del usuario) en la sesión
    $_SESSION ['usuario'] = $correo;
    $id= $_SESSION['id_usuario'];
    mysqli_multi_query($conexion, $query);
    header("location: ../principal.html");
    exit;
}else{
    echo '
    <script>
        alert("Correo o contraseña incorrecta, verifique los datos introducidos");
        window.location = "registro.php";
        </script>
    ';
    exit;
}

?>