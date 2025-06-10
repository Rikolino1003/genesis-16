<?php
include 'conexion.php';

// Procesar formulario cuando se envía vía POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $n = $_POST['nombre'];
    $d = $_POST['descripcion'];
    $p = $_POST['precio'];
    $u = $_POST['ubicacion'];
    $i = $_POST['imagen'];

    // Insertar en la base de datos con consulta preparada
    $st = $pdo->prepare("INSERT INTO productos(nombre, descripcion, precio, ubicacion, imagen) VALUES (?, ?, ?, ?, ?)");
    $st->execute([$n, $d, $p, $u, $i]);

    // Redirigir al panel admin después de guardar
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cocina</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Agregar Nueva Cocina</h1>
    </header>

    <div class="container form">
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>

            <textarea name="descripcion" placeholder="Descripción" required></textarea>

            <input type="number" name="precio" placeholder="Precio" required step="0.01" min="0">

            <input type="text" name="ubicacion" placeholder="Ubicación" required>

            <input type="text" name="imagen" placeholder="Nombre archivo imagen" required>

            <button type="submit">Guardar</button>
        </form>
    </div>

    <footer>
        <a href="admin.php">Volver</a>
    </footer>
</body>
</html>
