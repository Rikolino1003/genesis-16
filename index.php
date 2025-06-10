<?php
// Configuración inicial
session_start(); // Iniciamos la sesión
error_reporting(E_ALL); // Habilitamos todos los errores para desarrollo
ini_set('display_errors', 1); // Mostramos los errores en pantalla

// Conexión a la base de datos
try {
    include 'conexion.php';
} catch(Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es"> 
    <!-- Enlaces a hojas de estilo externas -->
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<header class="main-header">
    <div class="header-container">
        <!-- Logo y Marca -->
        <div class="brand">
            <i class="fas fa-hard-hat"></i>
            <div class="brand-text">
                <h1>Genesis:16</h1>
            </div>
        </div>

        <!-- Autenticación -->
        <div class="auth-section">
            <?php if(isset($_SESSION['usuario'])): ?>
                <div class="user-menu">
                    <button class="user-button">
                        <i class="fas fa-user-circle"></i>
                        <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                    </button>
                    <div class="user-dropdown">
                        <a href="panel_control.php"><i class="fas fa-cog"></i> Panel</a>
                        <a href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
                    </div>
                </div>
            <?php else: ?>
                <button class="login-button" onclick="mostrarLogin()">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Iniciar Sesión</span>
                </button>
            <?php endif; ?>
        </div>
    </div>
</header>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genesis:16 </title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <!-- Logo y Marca -->
            <a href="#inicio" class="brand">
                <i class="fas fa-hard-hat"></i>
                <span>Genesis:16</span>
            </a>

            <!-- Navegación Principal -->
            <nav class="nav-menu">
                <ul class="nav-list">
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#acerca">Nosotros</a></li>
                    <li><a href="#beneficios">Beneficios</a></li>
                    <li><a href="#resenas">Reseñas</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </nav>

            <!-- Autenticación -->
            <div class="auth-section">
                <?php if(isset($_SESSION['usuario'])): ?>
                    <div class="user-menu">
                        <button class="user-button">
                            <i class="fas fa-user-circle"></i>
                            <span><?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
                        </button>
                        <div class="user-dropdown">
                            <a href="panel_control.php"><i class="fas fa-cog"></i> Panel</a>
                            <a href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
                        </div>
                    </div>
                <?php else: ?>
                    <button class="login-button" onclick="mostrarLogin()">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Iniciar</span>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <body>



            
            <!-- Área de autenticación -->
            <div class="nav-auth">
                <?php if(isset($_SESSION['usuario'])): ?>
                    <!-- Muestra información del usuario si está logueado -->
                    <span class="user-info">
                        <i class="fas fa-user"></i> Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?> |
                        <a href="panel_control.php">Panel de Control</a> |
                        <a href="cerrar_sesion.php">Cerrar Sesión</a>
                    </span>
                <?php else: ?>
                    <!-- Botón de login si no hay sesión -->
                    <a href="#" onclick="mostrarLogin()" class="nav-login">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Sección Hero con imagen de fondo -->
<!-- Sección Hero Optimizada -->
<section id="inicio" class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-text">
            <div class="hero-header">
                <span class="hero-subtitle">Bienvenido a Genesis:16</span>
                <h1 class="hero-title">Herramientas resistentes, 
                    <span class="text-highlight">espacios duraderos</span>
                </h1>
            </div>
            
            <div class="hero-actions">
                <p class="hero-description">Todo lo que necesitas para construir con eficiencia y seguridad.</p>
                <div class="hero-buttons centered">
                    <a href="#productos" class="btn-hero primary">
                        <i class="fas fa-tools"></i> Ver Catálogo
                    </a>
                    <a href="#contacto" class="btn-hero secondary">
                        <i class="fas fa-headset"></i> Contáctanos
                    </a>
                </div>
            </div>

            <div class="hero-features">
                <div class="feature-item"><i class="fas fa-truck-fast"></i> Envío Gratis</div>
                <div class="feature-item"><i class="fas fa-shield-check"></i> Garantía Total</div>
                <div class="feature-item"><i class="fas fa-headset"></i> Soporte 24/7</div>
            </div>
        </div>
    </div>
</section>

    <!-- Modal de Login -->
<!-- Modal de Login -->
<div id="modalLogin" class="modal">
    <div class="modal-content login-container">
        <span class="close" onclick="cerrarModal()">&times;</span>
        
        <!-- Mensajes de error y éxito -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php 
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
                ?>
            </div>
        <?php endif; ?>

            <!-- Formulario de login -->
            <form method="POST" action="procesar_login.php" class="form-card">
                <h2><i class="fas fa-sign-in-alt"></i> Acceso al Sistema</h2>
                
                <!-- Campo de usuario -->
                <div class="form-group">
                    <label for="usuario">
                        <i class="fas fa-user"></i> Usuario
                    </label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>

                <!-- Campo de contraseña -->
                <div class="form-group">
                    <label for="clave">
                        <i class="fas fa-lock"></i> Contraseña
                    </label>
                    <div class="password-wrapper">
                        <input type="password" id="clave" name="clave" required>
                        <button type="button" id="togglePassword" class="toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Botón de submit -->
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                </button>
                

                <!-- Enlaces adicionales -->
                <div class="register-link">
                    <p>¿Aún no tienes cuenta? 
                        <a href="registro.php">
                            <i class="fas fa-user-plus"></i> Regístrate aquí
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Contenido principal -->
    <main class="container">

        <!-- Sección Productos -->
        <section id="productos" class="section">
            <div class="section-inner">
                <h2 class="section-title">Nuestros Productos</h2>
                <div class="grid">
                    <?php 
                    // Consulta y muestra de productos
                    try {
                        $stmt = $pdo->query("SELECT * FROM productos"); 
                        if($stmt->rowCount() == 0) {
                            echo "<p class='no-products'>No hay productos disponibles en este momento.</p>";
                        }
                        while($p = $stmt->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                        <div class="card">
                            <img src="img/<?php echo htmlspecialchars($p['imagen']); ?>" 
                                 alt="<?php echo htmlspecialchars($p['nombre']); ?>">
                            <div class="card-content">
                                <h3><?php echo htmlspecialchars($p['nombre']); ?></h3>
                                <p><?php echo htmlspecialchars($p['descripcion']); ?></p>
                                <p class="precio">$<?php echo number_format($p['precio'], 2); ?></p>
                                <a href="producto.php?id=<?php echo $p['id']; ?>" class="btn-ver">
                                    <i class="fas fa-eye"></i> Ver detalles
                                </a>
                            </div>
                        </div>
                    <?php 
                        endwhile;
                    } catch(Exception $e) {
                        echo "<p class='error'>Error al cargar los productos: " . $e->getMessage() . "</p>";
                    }
                    ?>
                </div>
            </div>
        </section>
                <!-- Sección Acerca de -->

        <!-- Sección Acerca de -->
        <section id="acerca" class="section">
            <div class="section-inner">
                <h2 class="section-title">Conoce Genesis:16</h2>
                
                <!-- Información Principal -->
        <!-- Información Principal -->
        <div class="about-main">
            <div class="about-text">
                <h3><i class="fas fa-users"></i> ¿Quiénes somos?</h3>
                <p>Somos una empresa dedicada a ofrecer herramientas de alta calidad para profesionales de la construcción. 
                   Con más de 10 años de experiencia, brindamos soluciones prácticas y eficientes para tu trabajo diario.</p>
                
                <!-- Características principales -->
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-medal"></i>
                        <div class="feature-content">
                            <h4>Calidad Premium</h4>
                            <p>Las mejores herramientas</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-history"></i>
                        <div class="feature-content">
                            <h4>Experiencia</h4>
                            <p>10+ años en el sector</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-tools"></i>
                        <div class="feature-content">
                            <h4>Variedad</h4>
                            <p>Amplio catálogo</p>
                        </div>
                    </div>
                </div>
            </div>
                        <!-- Imagen corporativa -->
            <div class="about-image-wrapper">
                <img src="img/equipo.jpg" alt="Nuestro equipo" class="about-image">
            </div>
        </div>
                <!-- Cómo Trabajamos -->
        <div class="about-content reverse">
            <div class="about-image">
                <img src="img/trabajo.jpg" alt="Trabajo en equipo" class="img-responsive">
            </div>
            <div class="about-text">
                <h3><i class="fas fa-cogs"></i> ¿Cómo trabajamos?</h3>
                <p>En cada proyecto, nuestro profesionalismo se refleja en nuestro compromiso con brindarte soluciones prácticas y eficientes. Explora nuestra selección de herramientas y experimenta la diferencia de trabajar con un equipo que valora tu tiempo y tus necesidades.</p>
            </div>
        </div>
        
                <!-- Especialidades -->
                <div class="specialties-compact">
                    <h3><i class="fas fa-star"></i> Nuestras Especialidades</h3>
                    <div class="specialties-grid">
                        <div class="specialty-item">
                            <i class="fas fa-kitchen-set"></i>
                            <div class="specialty-content">
                                <h4>Cocinas para Obras</h4>
                                <p>Diseños personalizados</p>
                            </div>
                        </div>
                        <div class="specialty-item">
                            <i class="fas fa-tools"></i>
                            <div class="specialty-content">
                                <h4>Herramientas Pro</h4>
                                <p>Equipamiento de calidad</p>
                            </div>
                        </div>
                        <div class="specialty-item">
                            <i class="fas fa-comments"></i>
                            <div class="specialty-content">
                                <h4>Asesoría Experta</h4>
                                <p>Soporte personalizado</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


<!-- Sección Beneficios -->
<section id="beneficios" class="section">
    <div class="section-inner">
         <div class="section-header">
            <h2 class="section-title text-center">
                <i class="fas fa-award"></i> 
                Nuestra Propuesta de Valor
            </h2>
        <p class="section-description">
            Descubre las ventajas que nos hacen ser tu mejor opción en herramientas y equipamiento profesional
        </p>

        <div class="benefits-grid">
            <!-- Calidad y Precio -->
            <div class="benefit-item">
                <i class="fas fa-dollar-sign"></i>
                <h3>Precios Competitivos</h3>
                <ul class="price-features">
                    <li><i class="fas fa-check"></i> Mejor relación calidad-precio</li>
                    <li><i class="fas fa-check"></i> Descuentos por volumen</li>
                    <li><i class="fas fa-check"></i> Ofertas especiales mensuales</li>
                    <li><i class="fas fa-check"></i> Financiación disponible</li>
                </ul>
            </div>

            <!-- Logística -->
            <div class="benefit-item">
                <i class="fas fa-shipping-fast"></i>
                <h3>Envío y Distribución</h3>
                <ul class="price-features">
                    <li><i class="fas fa-check"></i> Entrega a domicilio garantizada</li>
                    <li><i class="fas fa-check"></i> Seguimiento en tiempo real</li>
                    <li><i class="fas fa-check"></i> Cobertura nacional completa</li>
                    <li><i class="fas fa-check"></i> Envío express disponible</li>
                </ul>
            </div>

            <!-- Garantía y Soporte -->
            <div class="benefit-item">
                <i class="fas fa-shield-alt"></i>
                <h3>Garantía Profesional</h3>
                <ul class="price-features">
                    <li><i class="fas fa-check"></i> Garantía extendida en productos</li>
                    <li><i class="fas fa-check"></i> Soporte técnico especializado</li>
                    <li><i class="fas fa-check"></i> Servicio post-venta</li>
                    <li><i class="fas fa-check"></i> Mantenimiento incluido</li>
                </ul>
            </div>

            <!-- Experiencia Cliente -->
            <div class="benefit-item">
                <i class="fas fa-heart"></i>
                <h3>Experiencia Cliente</h3>
                <ul class="price-features">
                    <li><i class="fas fa-check"></i> Asesoría personalizada</li>
                    <li><i class="fas fa-check"></i> Capacitación gratuita</li>
                    <li><i class="fas fa-check"></i> Club de beneficios</li>
                    <li><i class="fas fa-check"></i> Atención prioritaria</li>
                </ul>
            </div>
        </div>

        <!-- Llamada a la acción -->
        <div class="benefits-cta">
            <p>¿Listo para experimentar la diferencia?</p>
            <a href="#productos" class="btn-benefits">
                <i class="fas fa-shopping-cart"></i> Explorar Productos
            </a>
        </div>
    </div>
</section>
        
        </section>


        <!-- Sección Reseñas -->

<section id="resenas" class="section">
    <div class="section-inner">
        <h2 class="section-title"><i class="fas fa-comments"></i> Experiencias Genesis:16</h2>
        
        <!-- Grid de reseñas -->
        <div class="reviews-grid">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM resenas ORDER BY fecha DESC LIMIT 3");
                while($resena = $stmt->fetch(PDO::FETCH_ASSOC)):
            ?>
                <div class="review-card">
                    <div class="review-badge">
                        <i class="fas fa-quote-right"></i>
                    </div>
                    <div class="stars">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i <= $resena['calificacion'] ? 'active' : ''; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <p class="review-text"><?php echo htmlspecialchars($resena['comentario']); ?></p>
                    <div class="review-author">
                        <span class="name"><?php echo htmlspecialchars($resena['nombre_cliente']); ?></span>
                        <span class="date"><?php echo date('d/m/Y', strtotime($resena['fecha'])); ?></span>
                    </div>
                </div>
            <?php 
                endwhile;
            } catch(Exception $e) {
                echo "<p class='error'>Error al cargar las reseñas</p>";
            }
            ?>
        </div>

        <!-- Formulario flotante para reseña -->
        <div class="review-form-wrapper">
            <button class="btn-review-toggle" onclick="toggleReviewForm()">
                <i class="fas fa-pen"></i> Compartir Experiencia
            </button>

            <form id="reviewForm" action="procesar_resena.php" method="POST" class="review-form hidden">
                <div class="form-fields">
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" name="nombre" placeholder="Nombre" required>
                    </div>
                    
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>

                    <div class="rating-group">
                        <span class="rating-label">Tu calificación:</span>
                        <div class="star-rating">
                            <?php for($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="calificacion" value="<?php echo $i; ?>" 
                                       id="star<?php echo $i; ?>" required>
                                <label for="star<?php echo $i; ?>"><i class="fas fa-star"></i></label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-comment input-icon"></i>
                        <textarea name="comentario" placeholder="Tu experiencia..." required></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-paper-plane"></i> Publicar
                </button>
            </form>
        </div>
    </div>
</section>


    <!-- Footer Mejorado -->
    <section id="contacto" class="section"> 
    <footer class="footer">
        <div class="footer-content">
            <!-- Sección Acerca de -->
            <div class="footer-section">
                <h3><i class="fas fa-building"></i> Genesis:16</h3>
                <p class="footer-about">
                    Somos especialistas en herramientas y equipamiento profesional para la construcción. 
                    Nuestra misión es proporcionar soluciones de calidad para tu trabajo.
                </p>
            </div>
    
            <!-- Sección Enlaces Rápidos -->
            <div class="footer-section">
                <h3><i class="fas fa-link"></i> Enlaces Rápidos</h3>
                <ul class="footer-links">
                    <li><a href="#inicio"><i class="fas fa-angle-right"></i> Inicio</a></li>
                    <li><a href="#productos"><i class="fas fa-angle-right"></i> Productos</a></li>
                    <li><a href="#resenas"><i class="fas fa-angle-right"></i> Reseñas</a></li>
                </ul>
            </div>
    
            <!-- Sección Contacto -->
            <div class="footer-section">
                <h3><i class="fas fa-address-book"></i> Contacto</h3>
                <ul class="contact-info">
                    <li>
                        <i class="fas fa-phone"></i>
                        <div class="contact-details">
                            <span>Teléfono:</span>
                            <a href="tel:+573009876543">+57 300 987 6543</a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <div class="contact-details">
                            <span>Email:</span>
                            <a href="mailto:ventas@genesis16.com">ventas@genesis16.com</a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="contact-details">
                            <span>Dirección:</span>
                            <address>Calle Falsa 123, Bogotá</address>
                        </div>
                    </li>
                </ul>
            </div>
    
            <!-- Sección Redes Sociales -->
            <div class="footer-section">
                <h3><i class="fas fa-share-alt"></i> Síguenos</h3>
                <div class="social-links">
                    <a href="#" class="social-link facebook" title="Síguenos en Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link instagram" title="Síguenos en Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link youtube" title="Mira nuestros tutoriales">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="social-link whatsapp" title="Contáctanos por WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    
        <!-- Sección inferior del footer -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; 2025 Genesis:16. Todos los derechos reservados.
                </p>
                <div class="footer-bottom-links">
                    <a href="#">Términos y Condiciones</a>
                    <span class="separator">|</span>
                    <a href="#">Política de Privacidad</a>
                    <span class="separator">|</span>
                    <a href="#">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Funcionalidad del modal de login
        function mostrarLogin() {
            document.getElementById('modalLogin').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modalLogin').style.display = 'none';
        }

        // Toggle para mostrar/ocultar contraseña
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('clave');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            if (event.target == document.getElementById('modalLogin')) {
                cerrarModal();
            }
        }

        // Scroll suave para los enlaces de navegación
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        // Agregar al final del archivo o en script.js
            function toggleReviewForm() {
            const form = document.getElementById('reviewForm');
            form.classList.toggle('hidden');
            }
    </script>
</body>
</html>