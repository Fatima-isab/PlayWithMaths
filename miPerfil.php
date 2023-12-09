<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("location: php/registro_usuario.php");
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
    <link rel="stylesheet" href="assets/styles/perfil.css">
    <link rel="stylesheet" href="assets/icons/iconos.css">
</head>

<style>
    .arriba {
    display: flex;
    align-items: center;
}
</style>

<body>

<div class="container">
    <div class="profile-header">
        <h1>Mi Perfil</h1>
    </div>
</div>

<div class="arriba">

<a href="principal.php">
        <span class="icon icon-home" style="font-size: 35px; margin-left: 150%; color: #000000;"></span>
</a>

<form action="cerrar_sesion.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres cerrar sesión? Podrás iniciar sesión cuando quieras.');">
        <button type="submit" id="btn_avatar" name="cerrar_sesion" style="margin-left: 1080%;" style="margin-top: 7%;">Cerrar Sesión</button>
    </form>

    <form action="eliminar_perfil.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu perfil? Esta acción no se puede deshacer.');">
        <button type="submit" id="btn_avatar" name="eliminar_perfil" style="margin-left: 1100%;">Eliminar Perfil</button>
    </form>
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
