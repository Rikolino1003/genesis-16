<?php
include("conexion.php");
session_start();

// Inicializar variables
$mensaje = "";

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])) {
    $usuario = trim($_POST['usuario']);
    $email = trim($_POST['email']);
    $clave = trim($_POST['clave']);

    // Validaciones
    if (empty($usuario) || empty($email) || empty($clave)) {
        $mensaje = "❌ Todos los campos son obligatorios.";
    } elseif (strlen($clave) < 6) {
        $mensaje = "❌ La contraseña debe tener al menos 6 caracteres.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "❌ El correo electrónico no es válido.";
    } else {
        try {
            // Verificar si el email ya existe
            $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $consulta->execute([$email]);

            if ($consulta->rowCount() > 0) {
                $mensaje = "⚠️ Este correo ya está registrado.";
            } else {
                // Crear el nuevo usuario
                $password_hash = password_hash($clave, PASSWORD_DEFAULT);
                $insertar = $pdo->prepare("INSERT INTO usuarios
(usuario, email, clave, rol) VALUES (?, ?, ?, 'usuario')");

                if ($insertar->execute([$usuario, $email, $password_hash])) {
                    $mensaje = "✅ Registro exitoso. Ahora puedes <a
href='login.php'>iniciar sesión</a>.";
                } else {
                    $mensaje = "❌ Error al registrar el usuario.";
                }
            }
        } catch (PDOException $e) {
            $mensaje = "❌ Error en la base de datos: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .registro-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .registro-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        .password-wrapper {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            color: #666;
        }
        .registro-container button[type="submit"] {
            width: 100%;
            background: #007BFF;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .registro-container button[type="submit"]:hover {
            background: #0056b3;
        }
        .mensaje {
            text-align: center;
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .mensaje.error {
            background-color: #ffe6e6;
            color: #dc3545;
        }
        .mensaje.success {
            background-color: #d4edda;
            color: #155724;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
        .links a {
            color: #007BFF;
            text-decoration: none;
            margin: 0 10px;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <h2>Crear cuenta</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="mensaje <?php echo strpos($mensaje, '✅') !==
false ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <form action="registro.php" method="POST">
            <div class="form-group">
                <label for="usuario"><i class="fas fa-user"></i>
Nombre de usuario</label>
                <input type="text" id="usuario" name="usuario"
placeholder="Ej: Juan Pérez" required
                       value="<?php echo isset($_POST['usuario']) ?
htmlspecialchars($_POST['usuario']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i>
Correo electrónico</label>
                <input type="email" id="email" name="email"
placeholder="ejemplo@correo.com" required
                       value="<?php echo isset($_POST['email']) ?
htmlspecialchars($_POST['email']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="clave"><i class="fas fa-lock"></i>
Contraseña</label>
                <div class="passsword-wrapper">
                    <input type="password" id="clave" name="clave"
placeholder="Mínimo 6 caracteres" required>
                    <button type="button" class="toggle-clave"
onclick="togglePassword()">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" name="registrar">
                <i class="fas fa-user-plus"></i> Registrarse
            </button>

            <div class="links">
                <a href="login.php"><i class="fas fa-sign-in-alt"></i>
Ya tengo cuenta</a>
                <a href="index.php"><i class="fas fa-home"></i> Inicio</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('clave');
            const toggleButton = document.querySelector('.toggle-clave i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('fa-eye');
                toggleButton.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('fa-eye-slash');
                toggleButton.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>