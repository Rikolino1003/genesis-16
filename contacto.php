<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Contacto</h1>
    </header>

    <div class="container form">
        <form method="POST" action="procesar_contacto.php">
            <input 
                type="text" 
                name="nombre" 
                placeholder="Nombre" 
                required
            >

            <input 
                type="email" 
                name="email" 
                placeholder="Correo electrónico" 
                required
            >

            <textarea 
                name="mensaje" 
                placeholder="Escribe tu mensaje aquí" 
                required
            ></textarea>

            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>