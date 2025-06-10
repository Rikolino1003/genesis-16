
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $clave = trim($_POST['clave']);
    
    try {
        // Depuración: Ver los datos que llegan
        error_log("Usuario intentando login: " . $usuario);
        
        // Buscar el usuario por nombre de usuario
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Agregamos PDO::FETCH_ASSOC
        
        // Depuración: Ver si encontramos el usuario
        if ($user) {
            error_log("Usuario encontrado en la BD");
            error_log("Hash almacenado: " . $user['clave']);
            error_log("Verificando contraseña ingresada");
            
            if (password_verify($clave, $user['clave'])) {
                // Login exitoso
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['usuario'];
                $_SESSION['rol'] = $user['rol'];
                
                error_log("Login exitoso para: " . $user['usuario'] . " con rol: " . $user['rol']);
                
                // Redirigir según el rol
                if ($user['rol'] == 'admin') {
                    header("Location: admin.php");
                } else {
                    header("Location: usuario.php");
                }
                exit();
            } else {
                error_log("Contraseña incorrecta para usuario: " . $usuario);
                $_SESSION['error'] = "Usuario o contraseña incorrectos";
            }
        } else {
            error_log("Usuario no encontrado: " . $usuario);
            $_SESSION['error'] = "Usuario o contraseña incorrectos";
        }
        
        header("Location: login.php");
        exit();
        
    } catch (PDOException $e) {
        error_log("Error de BD: " . $e->getMessage());
        $_SESSION['error'] = "Error en la base de datos: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }
}