<?php
include 'conexion.php';

// Obtener y validar ID
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: admin.php');
    exit;
}

// Obtener los datos del producto
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: admin.php');
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre     = trim($_POST['nombre'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio     = floatval($_POST['precio'] ?? 0);
    $ubicacion  = trim($_POST['ubicacion'] ?? '');
    $imagen     = trim($_POST['imagen'] ?? '');

    if ($nombre && $descripcion && $precio > 0 && $ubicacion && $imagen) {
        $update = $pdo->prepare("UPDATE productos SET nombre=?, descripcion=?, precio=?, ubicacion=?, imagen=? WHERE id=?");
        $update->execute([$nombre, $descripcion, $precio, $ubicacion, $imagen, $id]);
        header('Location: admin.php');
        exit;
    } else {
        $error = "Todos los campos son obligatorios y el precio debe ser mayor que cero.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cocina</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Editar Cocina #<?= htmlspecialchars($id) ?></h1>
    </header>

    <div class="container form">
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required placeholder="Nombre del producto">
            <textarea name="descripcion" required placeholder="Descripción"><?= htmlspecialchars($producto['descripcion']) ?></textarea>
            <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required placeholder="Precio">
            <input type="text" name="ubicacion" value="<?= htmlspecialchars($producto['ubicacion']) ?>" required placeholder="Ubicación">
            <input type="text" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>" required placeholder="URL de la imagen">
            <button type="submit">Actualizar</button>
        </form>
    </div>

    <footer>
        <a href="admin.php">← Volver</a>
    </footer>
</body>
</html>
