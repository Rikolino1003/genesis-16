<?php
session_start();
session_destroy(); // Destruye todas las variables de sesión
session_write_close(); // Asegura que la sesión se cierre correctamente

// Eliminar la cookie de sesión
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Redireccionar al login
header('Location: login.php');
exit();
?>