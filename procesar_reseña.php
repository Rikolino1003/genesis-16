
<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO resenas (
                nombre_cliente, 
                email, 
                calificacion, 
                comentario, 
                fecha,
                aprobada
            ) VALUES (?, ?, ?, ?, NOW(), 1)
        ");
        
        $stmt->execute([
            $_POST['nombre'],
            $_POST['email'],
            $_POST['calificacion'],
            $_POST['comentario']
        ]);
        
        $_SESSION['mensaje'] = "¡Gracias por tu reseña!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error al guardar la reseña";
        error_log($e->getMessage());
    }
    
    header("Location: index.php#resenas");
    exit();
}