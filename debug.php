<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'conexion.php';

echo "<h2>Depuración de Genesis:16</h2>";

try {
    // Probar conexión
    echo "<h3>Prueba de conexión</h3>";
    if($pdo) {
        echo "✅ Conexión exitosa a la base de datos<br><br>";
    }

    // Verificar usuarios
    echo "<h3>Usuarios en el sistema:</h3>";
    $stmt = $pdo->query("SELECT * FROM usuarios");
    echo "Cantidad de usuarios: " . $stmt->rowCount() . "<br><br>";
    
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Último acceso</th>
            </tr>";
    
    while($row = $stmt->fetch()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['usuario']}</td>
                <td>{$row['rol']}</td>
                <td>{$row['ultimo_acceso']}</td>
              </tr>";
    }
    echo "</table><br>";

    // Verificar tablas existentes
    echo "<h3>Tablas en la base de datos:</h3>";
    $stmt = $pdo->query("SHOW TABLES");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Obtener el nombre de la tabla usando la primera clave del array
        $tableName = reset($row);
        echo "📁 " . htmlspecialchars($tableName) . "<br>";
    }

} catch (PDOException $e) {
    echo "<div style='color:red'>❌ Error: " . $e->getMessage() . "</div>";
}

// Información del sistema
echo "<h3>Información del sistema:</h3>";
echo "📌 PHP version: " . phpversion() . "<br>";
echo "📌 Server: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "📌 Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "<h3>Tablas en la base de datos:</h3>";
$stmt = $pdo->query("SELECT TABLE_NAME 
                     FROM INFORMATION_SCHEMA.TABLES 
                     WHERE TABLE_SCHEMA = 'genesis16'");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "📁 " . htmlspecialchars($row['TABLE_NAME']) . "<br>";
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    line-height: 1.6;
}
table {
    border-collapse: collapse;
    margin: 10px 0;
}
th, td {
    padding: 8px;
    text-align: left;
}
h2, h3 {
    color: #333;
}
</style>