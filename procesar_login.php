<?php
session_start();
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);
    
    try {
        // Consultar usuario
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();
        
        // Verificar usuario y contraseña
        if ($user && password_verify($clave, $user['clave'])) {
            // Guardar datos en sesión
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['rol'] = $user['rol'];
            
            // Actualizar último acceso
            $stmt = $pdo->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);
            
            // Redirigir según el rol
            if ($user['rol'] === 'admin') {
                $_SESSION['mensaje'] = "Bienvenido Administrador";
                header("Location: admin.php");
            } else {
                $_SESSION['mensaje'] = "Bienvenido " . $user['usuario'];
                header("Location: usuario.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error del sistema: " . $e->getMessage();
        error_log("Error de login: " . $e->getMessage());
        header("Location: index.php");
        exit();
    }
}