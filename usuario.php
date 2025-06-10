<?php 
session_start(); 
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'usuario') die('Acceso denegado'); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Área de usuario </title>
  <link rel="stylesheet" href="styleees.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header-usuario">
    <h1><i class="fa fa-user-circle"></i> Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h1>
    <p class="subtitulo">Gracias por visitar nuestra pagina! Nos alegra mucho tenerte aqui. </p>
  </header>

  <main class="usuario-contenido">
    <section class="quienes-somos">
      <h2>¿Quiénes somos?</h2>
      <p>Somos tu aliado estratégico para llevar tus proyectos al siguiente nivel. Encontrarás soluciones prácticas y eficientes, respaldadas por herramientas de la más alta calidad, diseñadas específicamente para profesionales como tú que no se conforman con menos. Descubre cómo nuestros productos pueden optimizar tu trabajo, aumentar tu productividad y garantizar resultados impecables. ¡Explora nuestro catálogo y encuentra la herramienta perfecta para tu próximo desafío!.</p>
      <img src="img/equipo.jpg" alt="Nuestro equipo de trabajo">
    </section>

    <section class="como-trabajamos">
      <h2>¿Cómo trabajamos?</h2>
      <p>En cada proyecto, nuestro profesionalismo se refleja en nuestro compromiso con brindarte soluciones prácticas y eficientes. Explora nuestra selección de herramientas y experimenta la diferencia de trabajar con un equipo que valora tu tiempo y tus necesidades.  </p>
      <img src="img/trabajo.jpg" alt="Trabajo en equipo">
    </section>

    <section class="especialidades">
      <h2>Nuestras especialidades</h2>
      <ul>
        <li><i class="fa fa-check-circle"></i> Diseño y venta de cocinas para obras</li>
        <li><i class="fa fa-check-circle"></i> Herramientas de albañilería profesionales</li>
        <li><i class="fa fa-check-circle"></i> Asesoría personalizada para cada cliente</li>
      </ul>
    </section>

    <div class="volver-btn">
      <a href="index.php" class="btn-volver"><i class="fa fa-home"></i>Ver nuestros productos disponibles</a>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2025 - Mi Aplicación Web para Profesionales</p>
  </footer>
</body>
</html>

