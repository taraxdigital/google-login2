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
          <div class="horizontal">
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
        <section id="testimonios" class="testimonials">
            <h2 class="section-title">Tu Portal al Futuro</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p>Bienvenido a <b>IA</b> Innovación, tu fuente definitiva para conocer las últimas novedades, en inteligencia artificial, tecnología, alimentación y música.</p><br><p>Como agencia de marketing digital líder, no solo informamos sobre el futuro, lo creamos. Nuestro equipo de expertos diseña sitios web impresionantes que fusionan estética y funcionalidad, llevando tu presencia en línea al siguiente nivel. </p><br>
                    <h4>Herramientas útiles:</h4>
                    <p> No te quedes atrás y transforma tu estrategia digital con soluciones innovadoras que marcan la diferencia.</p><br>
                </div>
                <div class="testimonial-card">
                    
                    <h4>Creación de contenido:</h4>
                    <p>Te ofrezco las últimas novedades en creación de contenido, utilizando herramientas de inteligencia artificial de vanguardia para generar imágenes y videos impactantes que capturan la esencia de tu marca.</p>
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
      
        
      
        <?php
        // Simulamos obtener datos de una base de datos o un archivo de configuración


        $prezData = [
            'title' => 'Novedades de en los últimos años.',
            'description' => 'Explora nuestra presentación interactiva sobre las últimas tendencias .',
            'embed' => '<iframe src="https://prezi.com/p/embed/TCpAk6hSqUDUVNzrgxMi/" id="iframe_container" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" allow="autoplay; fullscreen" height="315" width="560"></iframe>'
        ];
        ?>
        <div class="ai-section">
        <h2>Inteligencia Artificial al servicio de tu creatividad: Explora las últimas herramientas</h2>
        <p>
        En 2024, la inteligencia artificial (IA) transforma la creación de imágenes y videos con avances en realismo y control creativo. Adobe ha lanzado Firefly, que permite generar videos a partir de texto e imágenes, integrándose en su ecosistema Creative Cloud. Los modelos de texto a imagen logran un nivel de detalle que dificulta distinguir entre imágenes generadas por IA y reales.
        El uso de medios sintéticos, como deepfakes, presenta oportunidades creativas y desafíos éticos. La colaboración entre humanos y IA redefine el proceso creativo, mientras que estas tecnologías mejoran la personalización del contenido en marketing y redes sociales. Además, la ética y la transparencia son prioridades, promoviendo la trazabilidad y autenticidad en el contenido generado.
        </p>
    </div>
    <section class="carousel-section">
    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/ia.webp" alt="Imagen 1" />
            </div>
            <div class="carousel-item">
                <img src="img/pcAI.jpeg" alt="Imagen 2" />
            </div>
            <div class="carousel-item">
                <img src="img/perfil.webp" alt="Imagen 3" />
            </div>
            <div class="carousel-item">
                <img src="img/Herramientas-Digitales.png" alt="Imagen 5" />
            </div>
            <div class="carousel-item">
                <img src="img/herramienta.jpg" alt="Imagen 6" />
            </div>
        </div>
        <button class="carousel-button prev" aria-label="Anterior">&lt;</button>
        <button class="carousel-button next" aria-label="Siguiente">&gt;</button>
        <div class="carousel-indicators"></div>
    </div>
</section>
      <section>
    <h2>Incorporación digital en el día a día.</h2>
    <div class="contaC">
       
        <div class="column">
            <img src="img/INTELIGENCIA-ARTIFICIAL.jpg" alt="Inteligencia Artificial" class="image">
            <h2>Inteligencia Artificial</h2>
            <p>La inteligencia artificial (IA) es la capacidad de una máquina para realizar tareas que normalmente requieren inteligencia humana, como el aprendizaje, la resolución de problemas y la toma de decisiones.
            El 80% de las empresas están implementando IA en sus operaciones.
            </p>
        </div>
        <div class="column">
            <img src="img/renovables.jpg" alt="Energías Renovables" class="image">
            <h2>Energías Renovables</h2>
            <p>Las energías renovables son fuentes de energía que se renuevan de forma natural, como la energía solar, la energía eólica, la energía hidroeléctrica y la energía geotérmica. 
                El 50% de la electricidad global provendrá de fuentes renovables para 2030. </p>
        </div>
        <div class="column">
            <img src="img/BIOTECNOLOGIA.png" alt="Biotecnología" class="image">
            <h2>Biotecnología</h2>
            <p>La biotecnología es la aplicación de principios científicos y tecnológicos a organismos vivos, sistemas vivos o sus derivados para la creación de productos y procesos para usos específicos.
                 Se espera que la medicina personalizada crezca un 25% en los próximos 5 años.</p>
        </div>
     
    </div>

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
        <div class="accordion">
  <div class="accordion-item">
    <button class="accordion-button">
      <span>Destacados.</span>
      <i class="arrow"></i>
    </button>
    <div class="accordion-content">
      <div class="accordion-body">
        <p><strong>Anakin:</strong>  Todo en uno, imprescindible.</p>
        <p><strong>Visbug:</strong>  Extensión de Crome, para modificar cualquier web.</p>
        <p><strong>Noise:</strong>  Crea videos, con música de otra plataforma.</p>
        <p><strong>Issuu:</strong>  Crea tu propio libro.</p>
        <p><strong>Rezi.AI:</strong> Crea tu cv.</p>
        <p><strong>Pfpmaker:</strong>  Foto de perfil, para tu cv.</p>
        <p><strong>Bento:</strong>  Crea tu portfolio.</p>
        <p><strong>Animista:</strong>  Aplica movimiento en tu css.</p>
        <p><strong>Retatube:</strong>  Descarga vídeos, de cualquier plataforma.</p>
        <p><strong>Deepblank:</strong>  Identidad de marca.</p>
        <p><strong> Myinstants:</strong>   Repositorio de sonidos cortos y memes sonoros..</p>
      </div>
    </div>
  </div>
</div>

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
                    <div class=".rotate-scale-up">
                        <img class="jello-horizontal"
                            src="img/p6.jpg"
                            alt="Estrategias de Marketing Digital"
                            class="marketing-image" />
                    </div>
                </div>
            </div>
        </section>


        <section>
            <div class="containera">
                <h2>La Incorporación de la IA</h2>

                <div class="stats">
                    <div class="stat-card">
                        <h3>Crecimiento de la IA</h3>
                        <div class="stat-value">120%</div>
                        <p>Aumento en inversión desde 2020</p>
                    </div>
                    <div class="stat-card">
                        <h3>Aplicaciones Cotidianas</h3>
                        <div class="stat-value">75%</div>
                        <p>De smartphones usan IA</p>
                    </div>
                    <div class="stat-card">
                        <h3>Previsión para 2030</h3>
                        <div class="stat-value">$15.7T</div>
                        <p>Impacto económico global estimado</p>
                    </div>
                </div>

                <h2>Crecimiento de la Inversión en IA</h2>
                <div class="graph">
                    <div class="bar-chart">
                        <div class="bar" style="height: 25%"></div>
                        <div class="bar" style="height: 40%"></div>
                        <div class="bar" style="height: 55%"></div>
                        <div class="bar" style="height: 70%"></div>
                        <div class="bar" style="height: 85%"></div>
                    </div>
                    <div class="bar-chart" style="height: auto">
                        <div class="bar-label">2020<br>$50B</div>
                        <div class="bar-label">2021<br>$65B</div>
                        <div class="bar-label">2022<br>$80B</div>
                        <div class="bar-label">2023<br>$95B</div>
                        <div class="bar-label">2024<br>$110B</div>
                    </div>
                </div>

                <div class="footera">
                    <p>Fuentes: Informes de industria, estudios de mercado, y proyecciones económicas.</p>
                    <p>Nota: Los datos presentados son aproximaciones y pueden variar según la fuente.</p>
                </div>
            </div>
        </section>
        <section id="playlists">
            <h2>Nuestros Destacados</h2>
            <div class="playlist-container">
                <a href="tecnologia.php#generacion-img" target="_blank"><div class="playlist">Audiovisuales</div></a>
            
                <a href="tecnologia.php#recursos" target="_blank"><div class="playlist">Recursos</div></a>
                <a href="tecnologia.php#contenido" target="_blank"><div class="playlist">Crear contenido</div></a>
        </section>
        <section class="modern-section">
            <h2 class="section-title">Explora el Futuro de la Tecnología</h2>
            <div class="image-block">
                <h3 class="block-title">Marketing impulsado por IA</h3>
                <img class="puff-in-center"   src="img/Leonardo_Lightning_XL_una_mujer_diseadora_Web_DoubleExposure_3.jpg" alt="Innovación que Impulsa el Futuro">

                <p class="block-description">Análisis predictivo de tendencias y comportamiento del consumidor.</p>
            </div>
            <div class="image-block">
                <h3 class="block-title">Diseño y Funcionalidad </h3>
                <img class="roll-in-left" src="img/cerebro.jpg" alt="Diseño y Funcionalidad sin Compromisos">

                <p class="block-description">Sumérgete en productos que redefinen el estilo y maximizan el rendimiento.</p>
            </div>
            <div class="image-block">
                <h3 class="block-title">La mejor música por bpm</h3>
                <img class="puff-in-center" src="img/BPM.png" alt="Tecnología para una Vida Inteligente">

                <p class="block-description">Trabaja eficazmente al ritmo de la música.</p>
            </div>
            <div class="image-block">
                <h3 class="block-title">Marketing de realidad aumentada (RA) y virtual (RV)</h3>
                <img class="roll-in-left" src="img/chica2.jpg" alt="Tecnología para una Vida Inteligente">

                <p class="block-description">Integración con IoT para marketing en tiempo real</p>
            </div>
        </section>
        <section id="home" class="hero">
            <h2>Conquista el Mundo Digital</h2>
            <p>Descubre. Investiga. Aprende.</p>
        </section>

        <section id="trending">
            <div class="music-grid">
                <div class="music-item">Música para motivarte</div>
                <div class="music-item">Alimentos Funcionales</div>
                <div class="music-item">La generación Z.</div>
                <div class="music-item">Del Laboratorio a la Mesa</div>
            </div>
        </section>
        <div class="contento">
            <div class="columna left">
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
            <div class="columna right">
                <div class="text-entry">
                    <img id="imagen1" src="img/chulilla.jpg" alt="" />
                </div>
            </div>
        </div>

      
        <section class="formulario">
        <div class="form-container">
        <h2>Nuestros Servicios.</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" pattern="[0-9]{9}" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" min="18" max="120" required>
            </div>
            <div class="form-group">
                <label for="ocupacion">Servicios</label>
                <select id="ocupacion" name="ocupacion" required>
                    <option value="">Seleccione una opción</option>
                    <option value="marketing">Marketing</option>
                    <option value="imagen">Imágenes</option>
                    <option value="video">Videos</option>
                    <option value="podcats">Podcats</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="terminos" name="terminos" required>
                <label for="terminos">Acepto los términos y condiciones</label>
            </div>
            <button type="submit">Enviar</button>
        </form>
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