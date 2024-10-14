<?php
include_once("vistas/header.php");
include_once 'config.php';


include 'config.php';

// Tus credenciales de Spotify
$client_id = ID_CLIENTE;
$client_secret = SECRETO_CLIENTE;

// Función para obtener el token de acceso
function getAccessToken($client_id, $client_secret) {
    //Inicia una nueva sesión cURL. cURL es una librería que permite hacer peticiones HTTP desde PHP.
    $ch = curl_init();
    //Establece la URL a la que se hará la petición. En este caso, es el endpoint de Spotify para obtener tokens de acceso.
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
    //Configura cURL para que devuelva el resultado de la transferencia como string en lugar de imprimirlo directamente
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //Configura la petición para que sea un POST HTTP
    curl_setopt($ch, CURLOPT_POST, 1);
    //Establece los campos que se enviarán en la petición POST. Aquí se especifica que se está usando el flujo de autenticación "client credentials"
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    /**
     * Configura los headers de la petición HTTP.
    *  Crea un header de autorización usando el esquema "Basic Auth".
    *  Combina el client_id y el client_secret, los codifica en base64, y los añade al header de autorización.
     */
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
    ]);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true)['access_token'];
}

// Función para buscar pistas
function searchTracks($query, $access_token) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=' . urlencode($query) . '&type=track');
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

// Buscar pistas
$search_query = 'The Beatles';
$results = searchTracks($search_query, $access_token);

// Mostrar resultados
if (isset($results['tracks']['items'])) {
    foreach ($results['tracks']['items'] as $track) {
        echo "Nombre de la pista: " . $track['name'] . "<br>";
        echo "Artista: " . $track['artists'][0]['name'] . "<br>";
        echo "Álbum: " . $track['album']['name'] . "<br>";
        //echo "URL de Spotify: " . $track['external_urls']['spotify'] . "<br><br>";
        echo "<a href=". $track['external_urls']['spotify'] .">". $track['name'] ."</a><br><br>";

        if (!empty($track['album']['images'])) {
            echo "Imagen del álbum: " . $track['album']['images'][0]['url'] . "<br>";
            echo "<img src=". $track['album']['images'][0]['url'] ." width='300px'><br>";
        } else {
            echo "No hay imagen disponible para este álbum.<br>";
        }
        
        echo "\n";
    }
} else {
    echo "No se encontraron resultados.";
}
?>
<img class="header-image" src="img/dj.png" alt="Imagen principal" />
<?php
include_once("vistas/header2.php");

 include 'api.php'; 
 ?>
    <main>
      <div class="container">
       

      <div id="list">
        <h1>Lista dj</h1>
      </div>
  







      </div>



    </main>
    

    <?php
include_once("vistas/footer.php");
?>