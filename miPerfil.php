<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: php/registro.php");
    session_destroy();
    die();
}

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

$id = $_SESSION['id_usuario'];

// Utiliza una consulta preparada para evitar la inyección de SQL
$query = "SELECT * FROM usuarios 
          INNER JOIN avatares ON usuarios.id_avatar = avatares.id_avatar 
          WHERE usuarios.id_usuario = '$id'";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();

// Obtener los datos de la consulta
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $nombre_usuario = $fila['nombre_usuario'];
    $edad = $fila['edad'];
    $correo = $fila['correo'];
    $nombre_avatar = $fila['nombre_avatar'];
    $imagen_avatar = $fila['imagen_avatar'];
} else {
    echo "No se encontraron datos para la persona con ID $id";
    exit();
}

// Obtener avatares para el menú desplegable
$query_avatares = "SELECT * FROM avatares";
$result_avatares = $conn->query($query_avatares);

$avatares = array();

if ($result_avatares->num_rows > 0) {
    while ($fila_avatar = $result_avatares->fetch_assoc()) {
        $avatares[] = $fila_avatar;
    }
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="icon" href="assets/img/cara.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/img/cara.jpg" type="image/x-icon">
    <link rel="stylesheet" href="/assets/styles/perfil.css">
    <link rel="stylesheet" href="assets/icons/iconos.css">
</head>

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
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 20px;
    background-color: var(--beige);
    margin: 0;
    padding: 0;
}

.container {
    background-color: var(--beige);
    border: 1px solid var(--beige);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.arriba {
    display: flex;
    align-items: center;
    background-color: #AA8976;
}

.profile-header {
    background-color: var(--cafe);
    color: #fff;
    padding: 20px;
    text-align: center;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    display: flex;
    align-items: center;
}

.profile-header h1 {
    margin: 0;
}

.profile-body {
    padding: 20px;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 10px;
}

strong {
    margin-right: 5px;
}

img.avatar {
    max-width: 100px;
    height: auto;
    border-radius: 50%;
    margin-top: 10px;
}

.profile-actions {
    text-align: center;
    margin-top: 20px;
}

#btn_avatar {
    background-color: var(--cafe); /* Color de fondo */
    color: 00000; /* Color del texto */
    padding: 10px 20px; /* Relleno interior */
    border: none; /* Sin borde */
    border-radius: 4px; /* Bordes redondeados */
    cursor: pointer; /* Cambiar el cursor al pasar por encima */
}

#btn_avatar:hover {
    background-color: var(--cafe); /* Cambiar el color de fondo al pasar por encima */
}

#btn_avatar1 {
    background-color: var(--beige); /* Color de fondo */
    color: 00000; /* Color del texto */
    padding: 10px 20px; /* Relleno interior */
    border: none; /* Sin borde */
    border-radius: 4px; /* Bordes redondeados */
    cursor: pointer; /* Cambiar el cursor al pasar por encima */
}

</style>

<body>

<div class="container">
    <div class="profile-header">
    <a href="principal.php">
        <span class="icon icon-home" style="font-size: 35px; margin-left: 100%; color: var(--beige);"></span>
</a>

        <h1 style="margin-left: 43%;">Mi Perfil</h1>

        <form action="cerrar_sesion.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres cerrar sesión? Podrás iniciar sesión cuando quieras.');">
        <button type="submit" id="btn_avatar1" name="cerrar_sesion" style="margin-left: 280%;" style="margin-top: 7%;">Cerrar Sesión</button>
    </form>

    <form action="eliminar_perfil.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu perfil? Esta acción no se puede deshacer.');">
        <button type="submit" id="btn_avatar1" name="eliminar_perfil" style="margin-left: 260%;">Eliminar Perfil</button>
    </form>
    </div>
</div>

<div class="container">


    <ul>
        <li><img src="<?php echo $imagen_avatar; ?>" alt="Avatar"></li>
        <li><strong><?php echo $nombre_usuario; ?></strong></li>
        <li><strong>Edad:</strong> <?php echo $edad; ?></li>
        <li><strong>Correo:</strong> <?php echo $correo; ?></li>
    </ul>

<form action="update_avatar.php" method="post">
    <label for="avatar">Seleccionar nuevo avatar:</label>
    <select name="avatar" id="avatar" required>
        <!-- Asegúrate de tener la variable $avatares definida en tu código PHP -->
        <?php foreach ($avatares as $avatar): ?>
            <option value="<?php echo $avatar['id_avatar']; ?>" data-image="<?php echo $avatar['imagen_avatar']; ?>">
                <?php echo $avatar['nombre_avatar']; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <img id="avatar-preview" src="" alt="Vista previa del avatar" style="max-width: 100px; max-height: 100px; margin-top: 10px; display: none;">
    <br>
    <button type="submit" id="btn_avatar">Actualizar Avatar</button>
</form>

</div>

<script>
    // Mostrar la imagen de vista previa del avatar al seleccionar uno
    document.getElementById('avatar').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var imagePath = selectedOption.getAttribute('data-image');

        var avatarPreview = document.getElementById('avatar-preview');
        avatarPreview.style.display = 'none';

        if (imagePath) {
            // Mostrar la vista previa
            avatarPreview.src = imagePath;
            avatarPreview.style.display = 'block';

            // Centrar la imagen en el contenedor
            centerAvatarPreview();
        }
    });

     // Función para centrar la imagen de vista previa
     function centerAvatarPreview() {
        var avatarPreview = document.getElementById('avatar-preview');
        var containerWidth = avatarPreview.parentElement.offsetWidth;
        var containerHeight = avatarPreview.parentElement.offsetHeight;

        // Calcular las coordenadas de margen para centrar la imagen
        var marginLeft = (containerWidth - avatarPreview.width) / 2;
        var marginTop = (containerHeight - avatarPreview.height) / 2;

        // Establecer los márgenes
        avatarPreview.style.marginLeft = marginLeft + 'px';
        avatarPreview.style.marginTop = marginTop + 'px';
    }

    

</script>

</body>
</html>
