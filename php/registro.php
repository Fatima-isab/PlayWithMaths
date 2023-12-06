<?php
session_start();
if(isset($_SESSION['correo'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play with Maths</title>
    <link rel="stylesheet" href="../assets/styles/registro.css">
</head>

<body>
    <main>
        
        <div class="contenedor">
            
            <div class="trasera">

                <div class="traseraLogin">
                    <h3>¿Tienes una cuenta creada?</h3>
                    <button id="btn-iniciar-sesion">Iniciar sesión</button>
                </div>

                <div class="traseraSign">
                    <h3>¿No tienes una cuenta creada?</h3>
                    <button id="btn-registro">Registrate</button>
                </div>
            </div>

            <div class="contenedor_registro">

                <form action="login_usuario.php" method="POST" class="formulario_login" >
                    <h2>Iniciar sesión</h2>
                    <input type="text" placeholder="Correo electronico" name="correo">
                    <input type="password" placeholder="Contraseña" name="contrasena"> 
                    <button>Iniciar</button>
                </form>

                <form  action="registro_usuario.php" method="POST" class="formulario_sign">
                    <h2>Registro</h2>
                    <input type="text" placeholder="Nombre completo" name="Nombres" required>
                    <input type="text" placeholder="Introduce tu correo" name="correo"required>
                    <input type="password" placeholder="Introduce una contraseña" name="contrasena" required>
                    <button>Registrarse</button>

                </form>
            </div>
        </div>
  
    </main>
    <script>
        const correo = document.querySelector("correo");
        const btn = document.querySelector("buttom");
        
        let regExp = /^[^ ]+.com$/;
        function check(){
            if(correo.value.match(refExp)){
            }
        }
        
    </script>
    <script src="../assets/scripts/registro.js"></script>
</body>
</html>

