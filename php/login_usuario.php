<?php
session_start();
include 'conexion_registro.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);


$validar_login = mysqli_query($conexion, "SELECT * FROM personas WHERE correo='$correo' 
and contrasena ='$contrasena'");

if(mysqli_num_rows($validar_login) > 0){
    $usuario = mysqli_fetch_assoc($validar_login); // Obtener los datos del usuario
    $_SESSION['IdPersonas'] = $usuario['IdPersonas']; // Guardar el IdPersonas(llave primaria del usuario) en la sesión
    $_SESSION ['usuario'] = $correo;
    $id= $_SESSION['IdPersonas'];
    $query = "INSERT IGNORE INTO vendedores (IdPersona) VALUES ('$id'); INSERT IGNORE INTO clientes (IdPersona) VALUES ('$id')";
    mysqli_multi_query($conexion, $query);
    header("location: ../inicio.php");
    exit;
}else{
    echo '
    <script>
        alert("Correo o contraseña incorrecta, verifique los datos introducidos");
        window.location = "../sign_up.php";
        </script>
    ';
    exit;
}

?>