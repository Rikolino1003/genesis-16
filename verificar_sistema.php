<?php
echo "<h2>Verificación del Sistema</h2>";

// Verificar directorios
$directories = [
    'img',
    'admin'
];

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        echo "✅ Directorio '$dir' existe<br>";
    } else {
        echo "❌ Directorio '$dir' no existe<br>";
        mkdir($dir);
        echo "📁 Directorio '$dir' creado<br>";
    }
}

// Verificar archivos
$files = [
    'styles.css',
    'conexion.php',
    'admin.php',
    'index.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "✅ Archivo '$file' existe<br>";
    } else {
        echo "❌ Archivo '$file' no existe<br>";
    }
}

// Verificar permisos
echo "<h3>Permisos de directorios:</h3>";
foreach ($directories as $dir) {
    $perms = substr(sprintf('%o', fileperms($dir)), -4);
    echo "$dir: $perms<br>";
}