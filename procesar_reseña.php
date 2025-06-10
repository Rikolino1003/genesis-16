<?php
include 'conexion.php';

$mensajeEnviado = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    // Validación básica
    if (!$nombre || !$email || !$mensaje) {
        $error = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo electrónico no es válido.";
    } else {
        // Insertar en la base de datos
        $stmt = $pdo->prepare("INSERT INTO mensajes(nombre, email, mensaje) VALUES (?, ?, ?)");
        if ($stmt->execute([$nombre, $email, $mensaje])) {
            $mensajeEnviado = true;
        } else {
            $error = "Hubo un error al enviar el mensaje. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container form">
        <?php if ($mensajeEnviado): ?>
            <p>Mensaje enviado correctamente. <a href="index.php">Volver al inicio</a></p>
        <?php else: ?>
            <?php if ($error): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST">
                <input type="text" name="nombre" placeholder="Tu nombre" required>
                <input type="email" name="email" placeholder="Tu correo" required>
                <textarea name="mensaje" placeholder="Escribe tu mensaje" required></textarea>
                <button type="submit">Enviar</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
