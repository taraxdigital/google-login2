<?php
include_once("vistas/header.php");
?>
<img class="header-image" src="img/caballo.png" alt="Imagen principal" />
<?php
include_once("vistas/header2.php");
?>
<main>
    <!-- Contenido principal -->
    <div class="container">
        

        <h1>Tendencias-top</h1>
        <section class="primero">
            <div class="card-grid">
                <div class="card">
                    <img class="top" src="img/music.png" alt="últimas tendencias" />
                    <div class="card-text">
                        <h2>Música</h2>
                        <p>Los últimos éxitos musicales en España.</p>
                    </div>
                </div>
                <div class="card">
                    <img class="top" src="img/comida.png" alt="últimas tendencias" />
                    <div class="card-text">
                        <h2>Alimentación</h2>
                        <p>Dieta mediterránea, la más saludable y completa.</p>
                    </div>
                </div>
                <div class="card">
                    <img class="top" src="img/px.jpg" alt="últimas tendencias" />
                    <div class="card-text">
                        <h2>Tecnología</h2>
                        <p>Descubre los nuevos avances en inteligencia artificial.</p>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- // -->
        <?php
// Simulamos obtener datos de una base de datos o un archivo de configuración
$videoData = [
    'title' => 'Video Destacado: Innovación Tecnológica',
    'description' => 'Descubre las últimas tendencias en tecnología y cómo están cambiando nuestro mundo.',
    'src' => 'videos/tech_innovation.mp4', // Asegúrate de que esta ruta sea correcta
    'poster' => 'images/video_poster.jpg' // Imagen de vista previa del video
];
?>

<!-- Sección de Video -->
<section class="video-section">
    <div class="container">
        <h2 class="section-title"><?php echo htmlspecialchars($videoData['title']); ?></h2>
        <p class="section-description"><?php echo htmlspecialchars($videoData['description']); ?></p>
        <div class="video-container">
            <video id="videoPlayer" src="img/video.mp4" poster="<?php echo htmlspecialchars($videoData['poster']); ?>"></video>
            <div class="video-controls">
                <button id="playPauseBtn">Reproducir</button>
                <input type="range" id="volumeSlider" min="0" max="1" step="0.1" value="1">
                <div class="progress-container">
                    <div id="progressBar"></div>
                </div>
                <span id="currentTime">0:00</span> / <span id="duration">0:00</span>
            </div>
        </div>
    </div>
</section>
<?php
// Simulamos obtener datos de una base de datos o un archivo de configuración
$prezData = [
    'title' => 'Novedades de en los últimos años.',
    'description' => 'Explora nuestra presentación interactiva sobre las últimas tendencias .',
    'embed' => '<iframe src="https://prezi.com/p/embed/TCpAk6hSqUDUVNzrgxMi/" id="iframe_container" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay; fullscreen" height="315" width="560"></iframe>'
];
?>

<!-- Sección de Prezi -->
<section class="prezi-section">
    <div class="container">
        <h2 class="section-title"><?php echo htmlspecialchars($prezData['title']); ?></h2>
        <p class="section-description"><?php echo htmlspecialchars($prezData['description']); ?></p>
        <div class="prezi-container">
            <?php echo $prezData['embed']; ?>
        </div>
    </div>
</section>
        <section class="modern-section">
            <div class="container">
                <h2 class="section-title">La revolución digital</h2>
                <p class="section-description">
                    Explorando nuevas fronteras en diseño y tecnología
                </p>
                <div class="feature-grid">
                    <div class="feature-item">
                        <i class="feature-icon" aria-hidden="true">🚀</i>
                        <h3>Innovación</h3>
                        <p>Impulsando el futuro con ideas revolucionarias</p>
                    </div>
                    <div class="feature-item">
                        <i class="feature-icon" aria-hidden="true">💡</i>
                        <h3>Creatividad</h3>
                        <p>Transformando visiones en realidades tangibles</p>
                    </div>
                    <div class="feature-item">
                        <i class="feature-icon" aria-hidden="true">🌿</i>
                        <h3>Sostenibilidad</h3>
                        <p>Creando soluciones responsables para un mañana mejor</p>
                    </div>
                </div>
                <a href="#" class="cta-button">Explora Más</a>
            </div>
        </section>
        
        <section class="digital-marketing-section">
            <div class="containera">
                <div class="content-wrapper">
                    <div class="text-content">
                        <h2 class="section-title">
                            Impulsa tu negocio con Marketing Digital
                        </h2>
                        <p class="section-description">
                            Descubre cómo nuestras estrategias de marketing digital pueden
                            llevar tu empresa al siguiente nivel en el mundo online.
                        </p>
                        <ul class="feature-list">
                            <li>SEO y posicionamiento en buscadores</li>
                            <li>Campañas de publicidad en redes sociales</li>
                            <li>Email marketing personalizado</li>
                            <li>Análisis de datos y optimización de conversiones</li>
                        </ul>
                    </div>
                    <div class="image-content">
                        <img
                            src="img/p6.jpg"
                            alt="Estrategias de Marketing Digital"
                            class="marketing-image" />
                    </div>
                </div>
            </div>
        </section>
        <section class="modern-section">
  <h2 class="section-title">Explora el Futuro de la Tecnología</h2>
  <div class="image-block">
  <h3 class="block-title">Marketing impulsado por IA</h3>
    <img src="img/Leonardo_Lightning_XL_una_mujer_diseadora_Web_DoubleExposure_3.jpg" alt="Innovación que Impulsa el Futuro">
   
    <p class="block-description">Análisis predictivo de tendencias y comportamiento del consumidor.</p>
  </div>
  <div class="image-block">
  <h3 class="block-title">Diseño y Funcionalidad </h3>
    <img src="img/cerebro.jpg" alt="Diseño y Funcionalidad sin Compromisos">
   
    <p class="block-description">Sumérgete en productos que redefinen el estilo y maximizan el rendimiento.</p>
  </div>
  <div class="image-block">
  <h3 class="block-title">La mejor música por bpm</h3>
    <img src="img/BPM.png" alt="Tecnología para una Vida Inteligente">
    
    <p class="block-description">Trabaja eficazmente al ritmo de la música.</p>
  </div>
  <div class="image-block">
  <h3 class="block-title">Marketing de realidad aumentada (RA) y virtual (RV)</h3>
    <img src="img/chica2.jpg" alt="Tecnología para una Vida Inteligente">
   
    <p class="block-description">Integración con IoT para marketing en tiempo real</p>
  </div>
</section>
        <section id="home" class="hero">
            <h2>Conquista el Mundo Digital</h2>
            <p>Descubre. Investiga. Aprende.</p>
        </section>

        <section id="trending">
            <div class="music-grid">
                <div class="music-item">Metaverso Musical</div>
                <div class="music-item">Alimentos Funcionales</div>
                <div class="music-item">Gen Z</div>
                <div class="music-item">Del Lab a la Mesa</div>
            </div>
        </section>
        <div class="contento">
              <div class="column left">
                <h3>De la forma más efectiva posible</h3>
                <ul>
                  <li>
                    <p>✅Domina el mundo digital con nosotros.</p>
                    <p>✅Expertos en Google Adwords: cada clic cuenta.</p>
                    <p>✅Maestros en Analytics: entendemos a tu audiencia.</p>
                    <p>
                      ✅Guardianes de Search Console: tu sitio siempre arriba.
                    </p>
                    <p>
                      ✅Diseño UX/UI cautivador: usuarios que no quieren irse.
                    </p>
                  </li>
                </ul>
              </div>
              <div class="column right">
                <div class="text-entry">
                  <img id="imagen1" src="img/chulilla.jpg" alt="" />
                </div>
              </div>
            </div>

        <section id="playlists">
            <h2>Nuestros Destacados</h2>
            <div class="playlist-container">
                <div class="playlist">Blockchain</div>
                <div class="playlist">AR Gafas</div>
                <div class="playlist">Workout</div>
            </div>
        </section>

        <section id="events">
            <h2>Próximos Eventos</h2>
            <div class="event-list">
                <div class="event">Tecnología talent - 15 Oct</div>
                <div class="event">Festival Benicasim - 22 Oct</div>
                <div class="event">Visita Bodega - 3 Nov</div>
            </div>
        </section>
    </div>
</main>
<?php
include_once("vistas/footer.php");
?>