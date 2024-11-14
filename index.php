<?php
include_once("vistas/header.php");
?>

<?php
include_once("vistas/header2.php");
?>
<canvas id="particleCanvas"></canvas>
<main>
    <!-- Contenido principal -->
    <div class="container">

 
<!-- nuevo inicio -->
<div style="background: linear-gradient(135deg, #1a0f2e, #2d3748, #1e3a8a); padding: 3rem 0; text-align: center; position: relative; overflow: hidden;">
    <!-- Efecto de partículas digitales en el fondo -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: radial-gradient(circle, #ffffff 1px, transparent 2px); background-size: 20px 20px;"></div>
    
<h1 style="font-size: 3.8rem; margin-bottom: 1.5rem; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
        La Revolución Digital <br>
        <span style="color: #60a5fa;">en tu Mano</span>
        <div class="imagen-container">
        <img class="nuevo" src="img/selec.png" alt="Descripción de la imagen">
    </div>
    </h1>
    
    <p style="font-size: 1.4rem; color: #e2e8f0; max-width: 800px; margin: 0 auto 2rem; line-height: 1.6;">
        Descubre las últimas innovaciones en IA y mantente a la vanguardia del futuro tecnológico
    </p>
    
    <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
       
    
    </div>
</div>

     
        <section class="primero">
        <audio controls>
    <source src="img2/Gabry.MP3" type="audio/mpeg">
    Tu navegador no soporta el elemento de audio.
</audio>

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
            <div class="carousel-item ">
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
        <button class="carousel-button prev">&lt;</button>
          <button class="carousel-button next">&gt;</button>
        </div>
      </section>
    <h2>Incorporación digital en el día a día.</h2>
    <div class="contaC">
    <div class="columns-container">
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
                El 50% de la electricidad global provendrá de fuentes renovables para 2030.</p>
        </div>
        <div class="column">
            <img src="img/BIOTECNOLOGIA.png" alt="Biotecnología" class="image">
            <h2>Biotecnología</h2>
            <p>La biotecnología es la aplicación de principios científicos y tecnológicos a organismos vivos, sistemas vivos o sus derivados para la creación de productos y procesos para usos específicos.
                 Se espera que la medicina personalizada crezca un 25% en los próximos 5 años.</p>
        </div>
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
  <button class="accordion-button" onclick="playSound()">
  <span>Recursos destacados.</span>
  <i class="arrow"></i>
  <audio src="img2/vine.mp3" type="audio/mp3" id="sonido"></audio>
</button>
    <div class="accordion-content">
      <div class="accordion-body">
        <p><strong>Anakin:</strong>  Todo en uno, imprescindible.</p>
        <p><strong>Visbug:</strong>  Extensión de Crome, para modificar cualquier web.</p>
        <p><strong>Pika art:</strong>  Movimiento de imágenes increíbles.</p>
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
<!--  -->
<div class="vitamina">
<h2>Gente Vitamina</h2>
<p class="vtmn">Te ayudan a crecer.</p>
</div>
<div class="container__cards">


<div class="cardo">
    <div class="cover">
        <img src="img/p1.png" alt="">
        <div class="img__back"></div>
    </div>
    <div class="description">
        <h2>Midudev.</h2>
        <p>Aprende a diseñar tu web</p>
        <input type="button" value=" Desarrollador">
    </div>
</div>

<div class="cardo">
    <div class="cover">
        <img src="img/ruva.png" alt="">
        <div class="img__back"></div>
    </div>
    <div class="description">
        <h2>Ruva.</h2>
        <p>Ponla bonita.</p>
        <input type="button" value="Diseño gráfico">
    </div>
</div>

<div class="cardo">
    <div class="cover">
        <img src="img/p3.png" alt="">
        <div class="img__back"></div>
    </div>
    <div class="description">
        <h2>Romu.</h2>
        <p>Posiciónala.</p>
        <input type="button" value="Seo">
    </div>
</div>

</div>
<!-- podscat -->
<section>
      <section class="podcast-section">
  <div class="podcast-container">
    <h2 class="podcast-title">Podcast: Líderes Digitales</h2>
    
    <div class="podcast-grid">
      <div class="podcast-episode">
        <div class="episode-number">Episodio #01</div>
        <h3 class="episode-title">Mindset del Emprendedor Digital</h3>
        <p class="episode-description">Descubre las claves mentales que todo emprendedor necesita para triunfar en la era digital.</p>
        <a href="https://music.youtube.com"target="_blank" class="listen-button">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
            <path d="M8 5v14l11-7z"/>
          </svg>
          Escuchar Ahora
        </a>
      </div>
      
      <div class="podcast-episode">
        <div class="episode-number">Episodio #02</div>
        <h3 class="episode-title">Liderazgo en Equipos Remotos</h3>
        <p class="episode-description">Estrategias efectivas para liderar equipos distribuidos y mantener la productividad.</p>
        <a href="https://music.youtube.com/playlist?list=PLHsD7EzzS60O-9fCb9JwJoRxrnL5x8lI2"target="_blank" class="listen-button">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
            <path d="M8 5v14l11-7z"/>
          </svg>
          Escuchar Ahora
        </a>
      </div>
      
      <div class="podcast-episode">
        <div class="episode-number">Episodio #03</div>
        <h3 class="episode-title">Innovación y Tecnología</h3>
        <p class="episode-description">Cómo mantenerte a la vanguardia de las tendencias tecnológicas en tu negocio.</p>
        <a href="https://music.youtube.com/podcast/cKYCTdD2hQ8"target="_blank" class="listen-button">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
            <path d="M8 5v14l11-7z"/>
          </svg>
          Escuchar Ahora
        </a>
      </div>
    </div>
    <div class="platform-links">
      <a href="https://www.spotify.com/"target="_blank" class="platform-button spotify">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
          <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
        </svg>
        Spotify
      </a>
      <a href="https://podcasts.apple.com"target="_blank" class="platform-button apple">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
          <path d="M7.078 23.55c-.473-.316-.893-.703-1.244-1.15-.383-.463-.738-.95-1.064-1.454-.766-1.12-1.365-2.345-1.78-3.636-.5-1.502-.743-2.94-.743-4.347 0-1.57.34-2.94 1.002-4.09.49-.9 1.22-1.653 2.1-2.182.85-.53 1.84-.82 2.84-.84.35 0 .73.05 1.13.15.29.08.64.21 1.07.37.55.21.85.34.95.37.32.12.59.17.8.17.16 0 .39-.05.645-.13.145-.05.42-.14.81-.31.386-.14.692-.26.935-.35.37-.11.728-.21 1.05-.26.39-.06.777-.08 1.148-.05.71.05 1.36.2 1.94.42 1.02.41 1.843 1.05 2.457 1.96-.26.16-.5.346-.725.55-.487.43-.9.94-1.23 1.505-.43.77-.65 1.64-.644 2.52.015 1.083.29 2.035.84 2.86.387.6.904 1.114 1.534 1.536.31.21.582.355.84.45-.12.375-.252.74-.405 1.1-.347.807-.76 1.58-1.25 2.31-.432.63-.772 1.1-1.03 1.41-.402.48-.79.84-1.18 1.097-.43.285-.935.436-1.452.436-.35.015-.7-.03-1.034-.127-.29-.095-.576-.202-.856-.323-.293-.134-.596-.248-.905-.34-.38-.1-.77-.148-1.164-.147-.4 0-.79.05-1.16.145-.31.088-.61.196-.907.325-.42.175-.695.29-.855.34-.324.096-.656.154-.99.175-.52 0-1.004-.15-1.486-.45zm6.854-18.46c-.68.34-1.326.484-1.973.436-.1-.646 0-1.31.27-2.037.24-.62.56-1.18 1-1.68.46-.52 1.01-.95 1.63-1.26.66-.34 1.29-.52 1.89-.55.08.68 0 1.35-.25 2.07-.228.64-.568 1.23-1 1.76-.435.52-.975.95-1.586 1.26z"/>
        </svg>
        Apple Podcasts
      </a>
      <a href="https://music.youtube.com/" target="_blank "class="platform-button google">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
          <path d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.6 0 12 0zm0 2c5.5 0 10 4.5 10 10s-4.5 10-10 10S2 17.5 2 12 6.5 2 12 2zm-2 14.5v-9l6 4.5-6 4.5z"/>
        </svg>
        Google Podcasts
      </a>
    </div>
  </div>
</section>
 <!--  -->

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
                    <div class="rotate-scale-up">
    <img src="img/p6.jpg"
         alt="Estrategias de Marketing Digital"
         class="marketing-image jello-horizontal" />
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
        <!-- libros -->
        <section class="books-section">
  <div class="books-container">
    <h2 class="books-title">Biblioteca del Líder Digital</h2>
    
    <div class="books-grid">
      <div class="book-card">
        <div class="book-cover">📱</div>
        <div class="book-info">
          <div class="book-rating">
            ⭐⭐⭐⭐⭐
          </div>
          <h3>El Método Lean Startup</h3>
          <p>Guía práctica para lanzar y desarrollar tu startup.</p>
          <a href="https://www.amazon.com/Deep-Work-Focused-Success-Distracted/dp/1455586692"target="_blank" class="book-link">
            Ver en Amazon
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>

      <div class="book-card">
        <div class="book-cover">📚</div>
        <div class="book-info">
          <div class="book-rating">
            ⭐⭐⭐⭐⭐
          </div>
          <h3>Estrategias de Marketing Digital</h3>
          <p> Considerado una biblia para los emprendedores y profesionales del marketing digita.</p>
          <a href="https://www.amazon.com/metodo-Lean-Startup-Eric-Ries/dp/9584260928"target="_blank" class="book-link">
            Ver en Amazon
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>

      <div class="book-card">
        <div class="book-cover">🎇​</div>
        <div class="book-info">
          <div class="book-rating">
            ⭐⭐⭐⭐⭐
          </div>
          <h3>Stars Imperium. (Spanish Edition)</h3>
          <p>Deja volar tu imaginación, en un viaje a través de una vasta galaxia.</p>
          <a href="https://www.amazon.com/Stars-Imperium-Spanish-Daniel-Perandr%C3%A9s-ebook/dp/B0C6L43SDD/ref=sr_1_1?crid=3ARQX7O04KH4U&dib=eyJ2IjoiMSJ9.yZOAcmGnW0vPggSq0GLEfg.VsNXjhgtN7S_h3Xc-HNPvrKSucRhGyH9a32NC2TvFIg&dib_tag=se&keywords=daniel+arias+perandres&qid=1730289365&s=digital-text&sprefix=daniel+arias+perandres%2Cdigital-text%2C148&sr=1-1" target="_blank" class="book-link">
            Ver en Amazon
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
              <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
          </a>
        </div>
      </div>

    
    </div>
  </div>
</section>

         <!--  -->
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
                <h3 class="block-title">Marketing DigitalA</h3>

                <a href="https://vilmanunez.com/" target="_blank"><img class="puff-in-center" src="img/p4.jpg" alt="Texto alternativo" width="300" height="200"></a>
                <img class="puff-in-center"   src="img/Leonardo_Lightning_XL_una_mujer_diseadora_Web_DoubleExposure_3.jpg" alt="Innovación que Impulsa el Futuro" width="300" height="200">

                <p class="block-description">Análisis predictivo de tendencias y comportamiento del consumidor.</p>
            </div>
            <div class="image-block">
                <h3 class="block-title">Diseño y Funcionalidad </h3>
                
                <a href="https://www.youtube.com/@alejavirivera" target="_blank"><img class="roll-in-left" src="img/alejavi.jpg" alt="Texto alternativo" width="300" height="200"></a>

                <img class="roll-in-left" src="img/cerebro.jpg" alt="Diseño y Funcionalidad sin Compromisos" width="300" height="200">

                <p class="block-description">Sumérgete en productos que redefinen el estilo y maximizan el rendimiento.</p>
            </div>
            <div class="image-block">
                <h3 class="block-title">Productividad eficaz.</h3>
                <a href="https://seosve.com/" target="_blank"><img class="puff-in-center" src="img/noe.png" alt="Texto alternativo" width="300" height="200"></a>
                <img class="puff-in-center" src="img/tengrai_.png" alt="Tecnología para una Vida Inteligente">

                <p class="block-description">Trabaja eficazmente y aprovecha los últimos recursos.</p>
            </div>
            <div class="image-block">
                <h3 class="block-title">Marketing con IA y tecnología</h3>
                <a href="https://www.youtube.com/@jasp" target="_blank"><img class="roll-in-left" src="img/raul.jpg" alt="Texto alternativo" width="300" height="200"></a>
                <img class="roll-in-left" src="img/MVL.png" alt="Tecnología para una Vida Inteligente" width="300" height="200">

                <p class="block-description">Integración de marketing en tiempo real</p>
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
<!--  -->
  
<!-- ++ -->
 
<section class="growth-section">
  <div class="growth-container">
    <h2 class="growth-title">Transforma tu Mentalidad</h2>
    
    <div class="growth-grid">
      <div class="growth-card">
        <div class="growth-icon">🎯</div>
        <h3>Establece Metas</h3>
        <p>Aprende a definir objetivos claros y alcanzables</p>
        <div class="growth-progress">
          <div class="progress-bar" data-progress="90"></div>
        </div>
      </div>
      
      <div class="growth-card">
        <div class="growth-icon">💪</div>
        <h3>Desarrolla Disciplina</h3>
        <p>Construye hábitos poderosos día a día</p>
        <div class="growth-progress">
          <div class="progress-bar" data-progress="75"></div>
        </div>
      </div>
      
      <div class="growth-card">
        <div class="growth-icon">🧠</div>
        <h3>Mentalidad de Crecimiento</h3>
        <p>Transforma los obstáculos en oportunidades</p>
        <div class="growth-progress">
          <div class="progress-bar" data-progress="85"></div>
        </div>
      </div>
    </div>

    <div class="daily-quote">
      <p class="quote-text" id="quote-text">"El éxito no es final, el fracaso no es fatal: es el coraje para continuar lo que cuenta."</p>
      <p class="quote-author" id="quote-author">- Winston Churchill</p>
    </div>
  </div>
</section>
 <!-- ++ -->

      </section>
     
      <!--  -->
        <section class="formulario">
        <div class="form-container">
        <h2>Nuestros Servicios.</h2>
        <form action="form-handler.php" method="POST">
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
        </section>
    </div>
    </div>
    <!-- </section>///////////
  
      -->
        <section id="events">
            <h2>Próximos Eventos</h2>
            <div class="event-list">
                <div class="event">Tecnología talent - 15 Oct</div>
                <div class="event">Festival Benicasim - 22 Oct</div>
                <div class="event">Visita Bodega - 3 Nov</div>
            </div>
        </section>
        <section class="tech-transition-section-bold">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    
    <div class="neon-container">
        <img class="neon-image" src="img/caballo.png" alt="Imagen principal de un caballo en estilo minimalista con efectos de neón" width="400" height="400" />
    </div>
</section>
        
   
</main>
<script src="index.js"></script>
<?php

include_once("vistas/footer.php");
?>