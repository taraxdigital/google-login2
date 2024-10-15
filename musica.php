<?php
include_once 'config.php';
include_once("vistas/header.php");
echo '<img class="header-image" src="img/dj.png" alt="Imagen principal" />';
include_once("vistas/header2.php");

// Tus credenciales de Spotify (asegúrate de que estas constantes estén definidas en config.php)
$client_id = ID_CLIENTE;
$client_secret = SECRETO_CLIENTE;

// Función para obtener el token de acceso
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
function getPlaylistTracks($playlist_id, $access_token, $limit = 20)
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
$playlist_id = '37i9dQZF1DX4dyzvuaRJ0n';

// Obtener las pistas de la playlist
$results = getPlaylistTracks($playlist_id, $access_token);

// Mostrar resultados
if (isset($results['items'])) {
    echo "<h2>Top éxitos de música electrónica en Spotify</h2>";
    echo "<div class='track-grid'>";
    foreach ($results['items'] as $index => $item) {
        if ($index >= 20) break; // Limita a 20 pistas (4x5 grid)
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

include_once("vistas/footer.php");
?>