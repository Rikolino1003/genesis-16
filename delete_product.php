<?php
include 'conexion.php';

// Obtener el ID desde GET y validar que sea un número
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Si el ID es válido, ejecutar la eliminación
if ($id > 0) {
    $del = $pdo->prepare("DELETE FROM productos WHERE id = ?");
    $del->execute([$id]);
}

// Redirigir de vuelta al panel de administración
header('Location: admin.php');
exit;
?>
