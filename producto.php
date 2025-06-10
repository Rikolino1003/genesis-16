<?php
include 'conexion.php';

// Obtener ID desde GET, validarlo como entero
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Consultar el producto por ID
$s = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$s->execute([$id]);
$p = $s->fetch(PDO::FETCH_ASSOC);

// Si no se encuentra el producto, mostrar mensaje y salir
if (!$p) {
    echo 'Producto no encontrado';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($p['nombre']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($p['nombre']) ?></h1>
    </header>

    <div class="container">
        <img src="img/<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" style="max-width: 400px;">

        <p><?= nl2br(htmlspecialchars($p['descripcion'])) ?></p>
        <p><strong>Precio:</strong> $<?= htmlspecialchars($p['precio']) ?></p>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($p['ubicacion']) ?></p>

        <a href="index.php">Volver</a>
    </div>
</body>
</html>
