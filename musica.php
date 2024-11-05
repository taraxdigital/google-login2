
<?php
include_once 'config.php';
include_once("vistas/header.php");

include_once("vistas/header2.php");

?>
<link rel="stylesheet" href="music.css">
<div class="container">
  <div class="top-bar">
    <button id="loginBtn" class="login-btn" onclick="showLoginModal()">
      ⚙️ Login
    </button>
  </div>



  <div class="main-content">
    <!-- /// -->
     <!-- Modal de login (oculto por defecto) -->


<!-- Nuevo contenido para la identificación de canciones y análisis de BPM -->
<!-- <div class="audio-player">
    <div class="song-info">
        <div class="song-title">Nombre de la canción</div>
        <div class="artist-name">Nombre del artista</div>
    </div>
    <div class="controls">
        <button class="btn" id="prevBtn"><i class="fas fa-step-backward"></i></button>
        <button class="btn" id="playBtn"><i class="fas fa-play"></i></button>
        <button class="btn" id="nextBtn"><i class="fas fa-step-forward"></i></button>
    </div>
    <div class="progress-bar">
        <div class="progress" id="progress"></div>
    </div>
    <button onclick="startListening()">Identificar Canción</button>
    <div id="songInfo"></div>
    <div id="resultadoBPM"></div>
</div> -->
     <!--  -->
    <div class="header">
      <div class="header-left">
        <svg class="logo" viewBox="0 0 100 100">
          <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8"/>
          <path d="M35 35 L35 65 L70 50 Z" fill="currentColor"/>
        </svg>
        <h1>BPM Music Sorter</h1>
      </div>
      <div class="header-right">
        <button onclick="createCustomFolder()">
          <span class="material-icons">create_new_folder</span>
          Crear Nueva Carpeta
        </button>
      </div>
    </div>

    <div class="search-container">
      <div class="filter-container">
        <select id="searchType" class="filter-select">
          <option value="track">Nombre de canción</option>
          <option value="artist">Artista</option>
          <option value="genre">Género</option>
          <option value="year">Año</option>
        </select>
        <input type="text" class="search-input" placeholder="Buscar canciones..." id="searchInput">
      </div>
      <button onclick="searchSongs()">
        <span class="material-icons">search</span>
        Buscar
      </button>
    </div>

    <div class="folders-grid">
      <div class="folder">
        <h3>
          <div class="bpm-icon">85</div>
          85-105 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-85-105"></div>
      </div>

      <div class="folder">
        <h3>
          <div class="bpm-icon">105</div>
          105-120 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-105-120"></div>
      </div>

      <div class="folder">
        <h3>
          <div class="bpm-icon">120</div>
          120-135 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-120-135"></div>
      </div>

      <div class="folder">
        <h3>
          <div class="bpm-icon">135</div>
          135-148 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-135-148"></div>
      </div>

      <div class="folder">
        <h3>
          <div class="bpm-icon">148</div>
          148+ BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-148-plus"></div>
      </div>

      <div id="custom-folders"></div>
    </div>
  </div>
</div>

<div class="modal-backdrop" id="modalBackdrop"></div>
<div class="custom-folder-modal" id="customFolderModal">
  <h3>Crear Nueva Carpeta</h3>
  <input type="text" id="folderNameInput" placeholder="Nombre de la carpeta">
  <div class="modal-buttons">
    <button onclick="saveCustomFolder()">
      <span class="material-icons">save</span>
      Guardar
    </button>
    <button class="btn-cancel" onclick="closeModal()">
      <span class="material-icons">close</span>
      Cancelar
    </button>
  </div>
</div>

<div class="login-modal" id="loginModal">
  <h3>Login</h3>
  <form id="loginForm" onsubmit="handleLogin(event)">
    <input type="email" id="emailInput" placeholder="Email" required>
    <input type="password" id="passwordInput" placeholder="Password" required>
    <div class="modal-buttons">
      <button type="submit">
        <span class="material-icons">login</span>
        Login
      </button>
      <button type="button" class="btn-cancel" onclick="closeLoginModal()">
        <span class="material-icons">close</span>
        Cancelar
      </button>
    </div>
  </form>
</div>

<div class="move-song-modal" id="moveSongModal">
  <h3>Mover canción a carpeta</h3>
  <div class="folder-list" id="folderList"></div>
  <button onclick="closeMoveModal()">Cancelar</button>
</div>


<?php

// Tus credenciales de Spotify (asegúrate de que estas constantes estén definidas en config.php)
$client_id = ID_CLIENTE;
$client_secret = SECRETO_CLIENTE;

// Función para obtener el token de acceso
echo '<img class="header-image" src="img/dj.png" alt="Imagen principal" />';
function getAccessToken($client_id, $client_secret)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true)['access_token'];
}

// Función para obtener las pistas de una playlist
function getPlaylistTracks($playlist_id, $access_token, $limit = 24)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/playlists/' . $playlist_id . '/tracks?limit=' . $limit);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $access_token,
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}

// Obtener el token de acceso
$access_token = getAccessToken($client_id, $client_secret);

// ID de la playlist "mint" (una popular playlist de música electrónica)
$playlist_id = '33PyRULhtc4SRrUE1wbbmp';

// Obtener las pistas de la playlist
$results = getPlaylistTracks($playlist_id, $access_token);

// Mostrar resultados
if (isset($results['items'])) {
    echo "<h2>Top éxitos de música electrónica en Spotify</h2>";
    echo "<div class='track-grid'>";
    foreach ($results['items'] as $index => $item) {
        if ($index >= 24) break; // Limita a 20 pistas (4x5 grid)
        $track = $item['track'];
        echo "<div class='track-item'>";
        if (!empty($track['album']['images'])) {
            echo "<img src='" . $track['album']['images'][0]['url'] . "' alt='" . $track['name'] . "' />";
        } else {
            echo "<div class='no-image'>No image available</div>";
        }
        echo "<h3>" . $track['name'] . "</h3>";
        echo "<p>" . implode(', ', array_map(function($artist) { return $artist['name']; }, $track['artists'])) . "</p>";
        echo "<a href='" . $track['external_urls']['spotify'] . "' target='_blank'>Listen on Spotify</a>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "No se encontraron resultados.";
}
?>
<section class="img-music">
<div class="imagen-centrada">
  <img src="img/MUSIC-LIFE-.png" alt="Descripción de la imagen">
</div>
</section>

<!-- ////nueva -->
<div class="container">
        <div class="header">
            <h1>Top 10 DJs Más Influyentes</h1>
            <button id="btnDJs">Mostrar/Ocultar DJs</button>
        </div>

        <div id="djs-container">
            <table id="djs-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Género Musical</th>
                        <th>Tema Más Conocido</th>
                        <th>Año de Lanzamiento</th>
                        <th>Biografía</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody id="djs-tbody"></tbody>
            </table>
        </div>
    </div>
<!-- articulo -->
<section class="article-section">
  <h2 class="article-title">Principales características de la música electrónica</h2>
  <img src="img2/music.jpg" alt="Imagen del artículo" class="article-image">
  <p class="article-text">La música electrónica se caracteriza por:</p>
  <ul class="article-list">
    <li><span class="article-list-item">Sonidos Sintetizados:</span> La base de la música electrónica son los sonidos creados a través de sintetizadores y software musical.</li>
    <li><span class="article-list-item">Ritmos Electrónicos:</span> Los ritmos son generalmente mecánicos y repetitivos, aunque pueden variar según el subgénero.</li>
    <li><span class="article-list-item">Producción Digital:</span> La producción musical se realiza principalmente a través de computadoras, utilizando programas de secuenciamiento y mezcla.</li>
    <li><span class="article-list-item">Diversidad de Subgéneros:</span> Desde el house y el techno hasta el trance y el EDM, la música electrónica ofrece una amplia gama de estilos para todos los gustos.</li>
  </ul>
  <h2 class="article-title">Historia y Evolución</h2>
  <p class="article-text">La música electrónica tiene una rica historia y evolución:</p>
  <ul class="article-list">
    <li><span class="article-list-item">Orígenes:</span> Los primeros experimentos con sonido electrónico se remontan a finales del siglo XIX, pero es en la década de 1950 cuando se desarrollan los primeros sintetizadores.</li>
    <li><span class="article-list-item">Popularización:</span> A partir de los años 60, artistas como Kraftwerk y Tangerine Dream comienzan a explorar las posibilidades de la música electrónica.</li>
    <li><span class="article-list-item">Escena Rave:</span> En los 80 y 90, la escena rave populariza géneros como el house y el techno, llevando la música electrónica a un público masivo.</li>
    <li><span class="article-list-item">Era Digital:</span> Con el avance de la tecnología, la producción de música electrónica se vuelve más accesible y la diversidad de estilos aumenta exponencialmente.</li>
  </ul>
  <h2 class="article-title">Impacto en la Cultura y la Industria Musical</h2>
  <p class="article-text">La música electrónica ha tenido un impacto significativo en la cultura y la industria musical:</p>
  <ul class="article-list">
    <li><span class="article-list-item">Festivales:</span> Eventos multitudinarios que reúnen a millones de personas cada año.</li>
    <li><span class="article-list-item">Industria Musical:</span> La música electrónica es una de las industrias más lucrativas a nivel mundial.</li>
    <li><span class="article-list-item">Influencia Cultural:</span> Ha influenciado otros géneros musicales y la cultura popular en general.</li>
  </ul>
  <h2 class="article-title">Subgéneros Destacados</h2>
  <p class="article-text">Algunos de los subgéneros más destacados de la música electrónica son:</p>
  <ul class="article-list">
    <li><span class="article-list-item">House:</span> Caracterizado por ritmos repetitivos y melodías pegadizas.</li>
    <li><span class="article-list-item">Techno:</span> Sonidos más oscuros y atmosféricos, con énfasis en el ritmo.</li>
    <li><span class="article-list-item">Trance:</span> Melodías envolventes y atmósferas épicas, con tempos rápidos.</li>
    <li><span class="article-list-item">EDM:</span> Música electrónica de baile, con estructuras simples y ritmos pegadizos.</li>
  </ul>
  <!-- <button class="article-button">Lee más</button> -->
</section>
<!--galeria  -->
<section class="sietem pt80 pb128" data-snippet="sietem" data-name="Festival de Imágenes">
        <div class="sietem-conta">
            <h2 class="sietem-title">Festival de Tomorrowland </h2>
            <div class="sietem-gallery">
                <img src="img2/logoTom.jpg"  alt="Festival 1"class="sietem-img" onclick="openModal(this.src)">
                <img  src="img2/tomorrowland.jpg" alt="Festival 2" class="sietem-img" onclick="openModal(this.src)">
                <img  src="img2/matt.jpg" alt="Festival 3" class="sietem-img" onclick="openModal(this.src)">
                <!-- Añade más imágenes según sea necesario -->
            </div>
        </div>
    </section>
    
    <!-- Modal -->
    <div id="sietemModal" class="sietem-modal">
        <span class="sietem-close" onclick="closeModal()">&times;</span>
        <img class="sietem-modal-content" id="sietemModalImg">
     
    </div>
<!--  -->
<section>
<div class="category-section">
<table>
  <thead>
    <tr>
      <th>Artista</th>
      <th class="nacimiento">Año de Nacimiento</th>
      <th>Género Musical</th>
      <th>Tema Más Conocido</th>
      <th>Año de Lanzamiento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Astrix</td>
      <td class="nacimiento">1975</td>
      <td>Psytrance</td>
      <td>"Deep Jungle Walk"</td>
      <td>2002</td>
    </tr>
    <tr>
      <td>Vini Vici</td>
      <td>1989</td>
      <td>Psytrance</td>
      <td>"The Calling"</td>
      <td>2015</td>
    </tr>
    <tr>
      <td>Paul van Dyk</td>
      <td>1971</td>
      <td>Trance</td>
      <td>"For an Angel"</td>
      <td>1994</td>
    </tr>
    <tr>
      <td>Tiësto</td>
      <td>1969</td>
      <td>EDM/Trance</td>
      <td>"Adagio for Strings"</td>
      <td>2005</td>
    </tr>
    <tr>
      <td>Dimitri Vegas</td>
      <td>1982</td>
      <td>EDM</td>
      <td>"Mammoth"</td>
      <td>2013</td>
    </tr>
    <tr>
      <td>Axwell /\ Ingrosso</td>
      <td>1982/1985</td>
      <td>EDM</td>
      <td>"Sun Is Shining"</td>
      <td>2015</td>
    </tr>
    <tr>
      <td>Armin van Buuren</td>
      <td>1976</td>
      <td>Trance</td>
      <td>"This Is What It Feels Like"</td>
      <td>2013</td>
    </tr>
    <tr>
      <td>Ferry Corsten</td>
      <td>1973</td>
      <td>Trance</td>
      <td>"Punk"</td>
      <td>2002</td>
    </tr>
    <tr>
      <td>Above & Beyond</td>
      <td>2000</td>
      <td>Trance</td>
      <td>"Sun & Moon"</td>
      <td>2011</td>
    </tr>
    <tr>
      <td>Gareth Emery</td>
      <td>1980</td>
      <td>Trance</td>
      <td>"Concrete Angel"</td>
      <td>2010</td>
    </tr>
    <tr>
      <td>Infected Mushroom</td>
      <td>1996</td>
      <td>Psytrance</td>
      <td>"Becoming Insane"</td>
      <td>2007</td>
    </tr>
    <tr>
      <td>Shpongle</td>
      <td>1998</td>
      <td>Psytrance</td>
      <td>"Divine Moments of Truth"</td>
      <td>1998</td>
    </tr>
    <tr>
      <td>Markus Schulz</td>
      <td>1975</td>
      <td>Trance</td>
      <td>"The New World"</td>
      <td>2012</td>
    </tr>
    <tr>
      <td>Solarstone</td>
      <td>1970</td>
      <td>Trance</td>
      <td>"Solarcoaster"</td>
      <td>2000</td>
    </tr>
    <tr>
      <td>Cosmic Gate</td>
      <td>1999</td>
      <td>Trance</td>
      <td>"Exploration of Space"</td>
      <td>2001</td>
    </tr>
    <tr>
      <td>Aly & Fila</td>
      <td>1980/1981</td>
      <td>Trance</td>
      <td>"We Control the Sunlight"</td>
      <td>2012</td>
    </tr>
    <tr>
      <td>Emma Hewitt</td>
      <td>1986</td>
      <td>Trance</td>
      <td>"Colours"</td>
      <td>2012</td>
    </tr>
    <tr>
      <td>Orjan Nilsen</td>
      <td>1982</td>
      <td>EDM</td>
      <td>"Between the Rays"</td>
      <td>2013</td>
    </tr>
    <tr>
      <td>John O'Callaghan</td>
      <td>1983</td>
      <td>Trance</td>
      <td>"Big Sky"</td>
      <td>2009</td>
    </tr>
    <tr>
      <td>Signum</td>
      <td>1995</td>
      <td>Trance</td>
      <td>"What Ya Got 4 Me"</td>
      <td>2005</td>
    </tr>
    <tr>
      <td>Gareth Emery</td>
      <td>1980</td>
      <td>Trance</td>
      <td>"U"</td>
      <td>2014</td>
    </tr>
    <tr>
      <td>Alan Walker</td>
      <td>1997</td>
      <td>EDM</td>
      <td>"Faded"</td>
      <td>2015</td>
    </tr>
    <tr>
      <td>Laidback Luke</td>
      <td>1976</td>
      <td>EDM</td>
      <td>"Turbulence"</td>
      <td>2012</td>
    </tr>
    <tr>
      <td>Steve Aoki</td>
      <td>1977</td>
      <td>EDM</td>
      <td>"Boneless"</td>
      <td>2014</td>
    </tr>
    <tr>
      <td>Zedd</td>
      <td>1989</td>
      <td>EDM</td>
      <td>"Clarity"</td>
      <td>2012</td>
    </tr>
    <tr>
      <td>Kaskade</td>
      <td>1971</td>
      <td>EDM</td>
      <td>"I Remember"</td>
      <td>2008</td>
    </tr>
    <tr>
      <td>Deadmau5</td>
      <td>1981</td>
      <td>EDM</td>
      <td>"Ghosts 'n' Stuff"</td>
      <td>2008</td>
    </tr>
    <tr>
      <td>Calvin Harris</td>
      <td>1984</td>
      <td>EDM</td>
      <td>"Summer"</td>
      <td>2014</td>
    </tr>
    <tr>
      <td>David Guetta</td>
      <td>1967</td>
      <td>EDM</td>
      <td>"Titanium"</td>
      <td>2011</td>
    </tr>
    <tr>
      <td>Tiësto</td>
      <td>1969</td>
      <td>EDM/Trance</td>
      <td>"Red Lights"</td>
      <td>2014</td>
    </tr>
  </tbody>
</table>
</div>
</section>
<script src="musica.js"></script>
<?php
include_once("vistas/footer.php");
?>