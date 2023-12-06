<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="./assets/styles/style.css">
</head>
<body>
  <div class="container">
    <h2>Iniciar sesión</h2>
    <form action="login.php" method="post">
      <div class="form-group">
        <label for="username"></label>
        <input type="text" id="correo" name="correo" placeholder="Introduce tu correo">
      </div>
      <div class="form-group">
        <label for="password"></label>
        <input type="password" id="password" name="password" placeholder="Introduce una contraseña" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Entrar">
      </div>
    </form>
  </div>
</body>
</html>
