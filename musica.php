<?php
include_once 'config.php';
include_once("vistas/header.php");

include_once("vistas/header2.php");

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

<!--galeria  -->
<section class="sietem pt80 pb128" data-snippet="sietem" data-name="Festival de Imágenes">
        <div class="sietem-conta">
            <h2 class="sietem-title">Festival de Tomorrowland </h2>
            <div class="sietem-gallery">
                <img src="img2/logoTom.jpg"  alt="Festival 1"class="sietem-img" onclick="openModal(this.src)">
                <img src="img2/tomorrowland.jpg" alt="Festival 2" class="sietem-img" onclick="openModal(this.src)">
                <img src="img2/matt.jpg" alt="Festival 3" class="sietem-img" onclick="openModal(this.src)">
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
      <th>Año de Nacimiento</th>
      <th>Género Musical</th>
      <th>Tema Más Conocido</th>
      <th>Año de Lanzamiento</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Astrix</td>
      <td>1975</td>
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