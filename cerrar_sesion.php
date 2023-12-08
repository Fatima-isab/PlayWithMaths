<?php
session_start();

// Destruir la sesión y redirigir a la página de inicio de sesión
session_destroy();
header("location: php/registro_usuario.php");
exit();
?>
