
<?php
session_start();
require_once 'conexion.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = htmlspecialchars(trim($_POST['usuario']));

    if (empty($usuario)) {
        $mensaje = "❌ Por favor ingresa tu nombre de usuario.";
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ? OR email = ?");
            $stmt->execute([$usuario, $usuario]);
            $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioEncontrado) {
                $email = $usuarioEncontrado['email'];
                // Generar nueva contraseña aleatoria
                $nueva_clave = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
                $clave_hash = password_hash($nueva_clave, PASSWORD_DEFAULT);

                // Actualizar contraseña en la base de datos
                $update = $pdo->prepare("UPDATE usuarios SET clave = ? WHERE usuario = ?");
                if ($update->execute([$clave_hash, $usuarioEncontrado['usuario']])) {
                    
                    // Configurar el correo
                    $para = $email;
                    $asunto = "Recuperación de contraseña - Cocina y Herramientas";
                    
                    // Mensaje en formato HTML
                    $mensaje_correo = "
                    <html>
                    <head>
                        <title>Recuperación de contraseña</title>
                    </head>
                    <body>
                        <h2>Recuperación de contraseña</h2>
                        <p>Hola {$usuarioEncontrado['usuario']},</p>
                        <p>Has solicitado restablecer tu contraseña.</p>
                        <p>Tu nueva contraseña temporal es: <strong>$nueva_clave</strong></p>
                        <p>Por seguridad, te recomendamos cambiar esta contraseña después de iniciar sesión.</p>
                        <hr>
                        <p>Si no solicitaste este cambio, por favor contacta con soporte.</p>
                    </body>
                    </html>";

                    // Cabeceras para correo HTML
                    $cabeceras = "MIME-Version: 1.0\r\n";
                    $cabeceras .= "Content-type: text/html; charset=UTF-8\r\n";
                    $cabeceras .= "From: Sistema de Cocinas <noreply@tudominio.com>\r\n";
                    
                    if (mail($para, $asunto, $mensaje_correo, $cabeceras)) {
                        $mensaje = "✅ Se ha enviado una nueva contraseña a tu correo electrónico.";
                    } else {
                        $mensaje = "❌ Error al enviar el correo. Por favor, intenta nuevamente.";
                        error_log("Error al enviar correo a: $email");
                    }
                }
            } else {
                // Mensaje genérico por seguridad
                $mensaje = "✅ Si el usuario existe, recibirás un correo con las instrucciones.";
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            $mensaje = "❌ Error del sistema. Por favor, intenta más tarde.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .recuperar-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        .mensaje {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .mensaje.error {
            background: #ffe6e6;
            color: #dc3545;
        }
        .mensaje.success {
            background: #d4edda;
            color: #155724;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            color: #007bff;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="recuperar-container">
        <h2>Recuperar Contraseña</h2>
        
        <?php if ($mensaje): ?>
            <div class="mensaje <?php echo strpos($mensaje, '✅') !== false ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="usuario">
                    <i class="fas fa-user"></i> Usuario o Correo Electrónico
                </label>
                <input 
                    type="text" 
                    id="usuario" 
                    name="usuario" 
                    required 
                    placeholder="Ingresa tu usuario o correo"
                >
            </div>

            <button type="submit">
                <i class="fas fa-key"></i> Recuperar Contraseña
            </button>

            <div class="links">
                <a href="login.php">
                    <i class="fas fa-arrow-left"></i> Volver al login
                </a>
            </div>
        </form>
    </div>
</body>
</html>