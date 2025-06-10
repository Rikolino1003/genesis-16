<?php
session_start();
require_once 'conexion.php';

// Verificar si el usuario está logueado y es admin
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - CRUD</title>
    <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Panel Admin - Gestión de Cocinas</h1>
    </header>

    <div class="container">
        <h2>Productos</h2>
        <a href="add_product.php">Agregar Nueva Cocina</a>

        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM productos");
                while ($p = $stmt->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td>$<?= $p['precio'] ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $p['id'] ?>">Editar</a> |
                        <a href="delete_product.php?id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2>Mensajes</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $msg = $pdo->query("SELECT * FROM mensajes ORDER BY fecha DESC");
                while ($m = $msg->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                    <td><?= $m['id'] ?></td>
                    <td><?= htmlspecialchars($m['nombre']) ?></td>
                    <td><?= htmlspecialchars($m['email']) ?></td>
                    <td><?= htmlspecialchars($m['mensaje']) ?></td>
                    <td><?= $m['fecha'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <a href="index.php">Volver al inicio</a>
    </footer>
</body>
</html>
