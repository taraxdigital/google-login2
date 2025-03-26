<?php
include_once 'config.php';
include_once("vistas/header.php");
include_once("vistas/header2.php");
<<<<<<< HEAD
require_once 'data/usuariobd.php';
=======


>>>>>>> parent of 36ba184 (miercoles)
?>
<<<<<<< Updated upstream
<link rel="stylesheet" href="music.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container">
<button id="loginBtn" class="login-btn" onclick="openModal()">
        ⚙️ Login
=======
<section id="home" class="hero">
  <h1>Éxitos musicales</h1>

</section>
<div class="bodyMus">
  
<div class="containerMus">
  <div class="headerMus">
    <div class="header-left">
      <svg class="logo" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8"/>
        <path d="M35 35 L35 65 L70 50 Z" fill="currentColor"/>
      </svg>
      <h1>BPM Music Sorter</h1>
    </div>
    <button onclick="createCustomFolder()">
      <span class="material-icons">create_new_folder</span>
      Crear Nueva Carpeta
>>>>>>> Stashed changes
    </button>

    <!-- Modal de Login -->
    <div id="loginModal" class="modalLogin">
        <div class="modal-content-login">
            <span class="modal-close-login" onclick="closeModal()">&times;</span>
            
            <div id="emailError" class="error-message"></div>
            <div id="message" class="error-message"></div>

            <form id="loginForm" onsubmit="login(event)">
                <h2 class="btn-login">Iniciar Sesión</h2>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="tu-email@ejemplo.com"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        placeholder="Contraseña"
                        required
                    >
                    <div id="passwordError" class="error-message"></div>
                </div>
                <button type="submit" class="login-submit">Iniciar Sesión</button>
                
                <div class="switch-form">
                    <a href="#" onclick="showRegistro()">¿No tienes cuenta? Regístrate</a>
                    <br>
                    <a href="#" onclick="showRecuperacion()">Olvidé mi contraseña</a>
                </div>
            </form>

            <div id="registroForm" style="display:none;">
                <h2 class="btn-login">Registro</h2>
                <div class="form-group">
                    <label for="registroNombre">Nombre</label>
                    <input 
                        type="text" 
                        id="registroNombre" 
                        name="registroNombre" 
                        placeholder="Tu nombre"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="registroEmail">Email</label>
                    <input 
                        type="email" 
                        id="registroEmail" 
                        name="registroEmail" 
                        placeholder="tu-email@ejemplo.com"
                        required
                    >
                </div>
                <div class="form-group">
                    <label for="registroPassword">Contraseña</label>
                    <input 
                        type="password" 
                        id="registroPassword" 
                        name="registroPassword" 
                        placeholder="Contraseña"
                        required
                    >
                </div>
                <button class="login-submit" onclick="registro()">Registrarse</button>
                
                <div class="switch-form">
                    <a href="#" onclick="showLogin()">¿Ya tienes cuenta? Iniciar Sesión</a>
                </div>
            </div>

            <div id="recuperacionForm" style="display:none;">
                <h2 class="btn-login" >Recuperar Contraseña</h2>
                <div class="form-group">
                    <label for="recuperacionEmail">Email</label>
                    <input 
                        type="email" 
                        id="recuperacionEmail" 
                        name="recuperacionEmail" 
                        placeholder="tu-email@ejemplo.com"
                        required
                    >
                </div>
                <button class="login-submit" onclick="recuperarContrasena()">Recuperar Contraseña</button>
                
                <div class="switch-form">
                    <a href="#" onclick="showLogin()">Volver a Iniciar Sesión</a>
                </div>
            </div>
        </div>
    </div>
    



<<<<<<< Updated upstream
  <div class="main-content">
    
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

    <div class="folders-grid" id="bpm-folders">
      <div class="folder">
        <h3 onclick="toggleFolder('85-105')">
          <span class="material-icons">folder</span>
          <div class="bpm-icon">Slow</div>
          85-105 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-85-105"></div>
      </div>

      <div class="folder">
        <h3 onclick="toggleFolder('105-120')">
          <span class="material-icons">folder</span>
          <div class="bpm-icon">Medium</div>
          105-120 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-105-120"></div>
      </div>

      <div class="folder">
        <h3 onclick="toggleFolder('120-135')">
          <span class="material-icons">folder</span>
          <div class="bpm-icon">Fast</div>
          120-135 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-120-135"></div>
      </div>

      <div class="folder">
        <h3 onclick="toggleFolder('135-148')">
          <span class="material-icons">folder</span>
          <div class="bpm-icon">Very Fast</div>
          135-148 BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-135-148"></div>
      </div>

      <div class="folder">
        <h3 onclick="toggleFolder('148-plus')">
          <span class="material-icons">folder</span>
          <div class="bpm-icon">Extreme</div>
          148+ BPM
          <span class="song-count">0 songs</span>
        </h3>
        <div class="song-list" id="folder-148-plus"></div>
      </div>

      <div id="custom-folders"></div>
    </div>
=======
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
>>>>>>> Stashed changes
  </div>
</div>

<div id="notificaciones-container"></div>

<div class="modal-backdrop" id="modalBackdrop"></div>
<div class="custom-folder-modal modales" id="customFolderModal">
  <h3>Crear Nueva Carpeta</h3>
  <input type="text" id="folderNameInput" placeholder="Nombre de la carpeta">
<<<<<<< Updated upstream
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

<div class="move-song-modal modales" id="moveSongModal">
=======
  <button onclick="saveCustomFolder()">Guardar</button>
  <button onclick="closeModal()">Cancelar</button>
</div>

<div class="move-song-modal" id="moveSongModal">
>>>>>>> Stashed changes
  <h3>Mover canción a carpeta</h3>
  <div class="folder-list" id="folderList"></div>
  <button class="buttonMus" onclick="closeMoveModal()">Cancelar</button>
</div>
</div>



<!-- /////nueva abajo -->
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
    <section>
    <h2><a class="texto" href="https://www.youtube.com/watch?v=MYZbapwyYdI&ab_channel=%F0%9D%90%8Cusicfor%F0%9D%90%92pinning%E3%83%84" target="_blank">Mixmeister</a></h2>
        <p>Mixmeister es un software diseñado para crear mezclas de música de forma sencilla y efectiva, ideal para sesiones de ejercicio o actividades físicas.</p>
        <div class="imagenes">
            <img src="img/mm.png" alt="Imagen izquierda">
            <img src="img/Mixmeister.png" alt="Imagen derecha">
        </div>
    </section>
<!-- articulo -->
<section class="article-section">
  <h2 class="article-title">Principales características de la música electrónica</h2>
  <img  src  ="img2/music.jpg" alt="Imagen del artículo" class="article-image">
  <p class="article-text"></p>
  <div class="imagen-container">
        <img class="nuevo" src="img/b.png" alt="Descripción de la imagen">
    </div>
    <p>
    Tal como la conocemos hoy, es el resultado de décadas de experimentación, innovación tecnológica y evolución cultural. Sus raíces se remontan a finales del siglo XIX con la invención del fonógrafo y los primeros experimentos con sonido grabado. Sin embargo, no fue hasta mediados del siglo XX cuando la electrónica comenzó a jugar un papel fundamental en la creación musical.

Los pioneros y los primeros experimentos.
        <br>
        <br>
        Década de los 60: La música electrónica comienza a fusionarse con el pop y el rock, dando lugar a nuevos sonidos y experimentando con estructuras musicales no convencionales. Artistas como The Beatles y The Velvet Underground pioneran en esta fusión.
Década de los 70: La música electrónica se consolida como género independiente, con subgéneros como el krautrock y la música ambiental. Artistas como Kraftwerk y Pink Floyd exploran las posibilidades expresivas de los sintetizadores.
Década de los 80: El synth-pop y la música dance dominan la escena, popularizados por bandas como Depeche Mode y New Order. La invención de MIDI revoluciona la producción musical electrónica.
Década de los 90: Surge el fenómeno del rave y la EDM, con subgéneros como el house, techno y trance. Artistas como Daft Punk y The Prodigy se convierten en iconos de la escena.
Siglo XXI: La música electrónica se democratiza gracias a la tecnología, dando lugar a una gran diversidad de subgéneros y facilitando la creación musical. <br>.
    </p>
    <div class="imagen-container">
        <img class="nuevo" src="img/ba.png" alt="Descripción de la imagen">
    </div>
  <ul class="article-list">
    <li><span class="article-list-item">Sonidos Sintetizados:</span> La base de la música electrónica son los sonidos creados a través de sintetizadores y software musical.</li>
    <li><span class="article-list-item">Ritmos Electrónicos:</span> Los ritmos son generalmente mecánicos y repetitivos, aunque pueden variar según el subgénero.</li>
    <li><span class="article-list-item">Producción Digital:</span> La producción musical se realiza principalmente a través de computadoras, utilizando programas de secuenciamiento y mezcla.</li>
    <li><span class="article-list-item">Diversidad de Subgéneros:</span> Desde el house y el techno hasta el trance y el EDM, la música electrónica ofrece una amplia gama de estilos para todos los gustos.</li>
  </ul>
  <h2 class="article-title">Historia y Evolución</h2>
  <p class="article-text">La música electrónica tiene una rica historia y evolución:</p>
  <ul class="article-list">https://github.com/TU_USUARIO/bpm-music-sorterhttps://github.com/TU_USUARIO/bpm-music-sorterconst CLIENT_ID = "9581c45310fa4db3b34f244a447f28b0";
const CLIENT_SECRET = "b8ad9e41a8bc46dc968c7b479d9c36a5";

const API_URL_TEMAS = "http://localhost/google-login/prueba/temas.php";
const API_URL_CARPETAS = "http://localhost/google-login/prueba/carpetas.php";

let accessToken = null;
let customFolders = [];
let listaTemas = [];
let temasBuscados = [];
let currentTrackToMove = null;

// Consolidated AudioPlayer object
const AudioPlayer = {
  player: null,
  currentTrackId: null,

  play(trackId, previewUrl) {
    if (!previewUrl) {
      alert("No preview available for this track");
      return;
    }

    if (this.player) {
      this.player.pause();
    }

    this.player = new Audio(previewUrl);
    this.player.play();
    this.currentTrackId = trackId;
    this.updateIcon(trackId, true);
  },

  pause() {
    if (this.player) {
      this.player.pause();
      this.updateIcon(this.currentTrackId, false);
      this.currentTrackId = null;
    }
  },

  toggle(trackId, previewUrl) {
    if (this.currentTrackId === trackId && this.player && !this.player.paused) {
      this.pause();
    } else {
      this.play(trackId, previewUrl);
    }
  },

  updateIcon(trackId, isPlaying) {
    const icon = document.getElementById(`playPauseIcon-${trackId}`);
    if (icon) {
      icon.textContent = isPlaying ? "pause" : "play_arrow";
    }
  },

  cleanup() {
    if (this.player) {
      this.player.pause();
      this.player = null;
    }
    this.currentTrackId = null;
  }
};

// API Client for better error handling
class APIClient {
  static async request(url, options = {}) {
    try {
      const response = await fetch(url, {
        ...options,
        headers: {
          'Content-Type': 'application/json',
          ...options.headers
        }
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error('API Error:', error);
      throw error;
    }
  }

  static async saveSong(track, folderId) {
    return this.request(`${API_URL_TEMAS}?metodo=nuevo`, {
      method: 'POST',
      body: JSON.stringify({
        titulo: track.titulo,
        artista: track.artista,
        id_spotify: track.id_spotify,
        preview_url: track.preview_url,
        tempo: track.tempo,
        id_carpeta: folderId
      })
    });
  }
}

// Modal Manager for better modal handling
const ModalManager = {
  show(modalId) {
    const modal = document.getElementById(modalId);
    const backdrop = document.getElementById('modalBackdrop');
    if (modal && backdrop) {
      modal.style.display = 'block';
      backdrop.style.display = 'block';
    }
  },

  hide(modalId) {
    const modal = document.getElementById(modalId);
    const backdrop = document.getElementById('modalBackdrop');
    if (modal && backdrop) {
      modal.style.display = 'none';
      backdrop.style.display = 'none';
    }
  },

  init() {
    // Close modals when clicking outside
    document.getElementById('modalBackdrop')?.addEventListener('click', () => {
      document.querySelectorAll('.modales').forEach(modal => {
        this.hide(modal.id);
      });
    });

    // Close modals with escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        document.querySelectorAll('.modales').forEach(modal => {
          this.hide(modal.id);
        });
      }
    });
  }
};

function loadCustomFolders() {
  // cargar las carpetas del usuario desde la base de datos
  fetch(`${API_URL_CARPETAS}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((result) => {
      folders = result;
      if (folders) {
        console.log(folders);
        customFolders = folders.map((folder) => ({ ...folder, songs: [] }));
        customFolders.forEach((folder) => createCustomFolderElement(folder));
        loadCustomTemas();
      }
    })
    .catch((error) => {
      console.log("Error: ", JSON.stringify(error));
    });
}

//cargar las canciones del usuario desde la base de datos
function loadCustomTemas() {
  fetch(`${API_URL_TEMAS}`, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((result) => {
      listaTemas = result;
      if (listaTemas) {
        //meter cada cancion en su carpeta
        console.log("listaTemas", listaTemas);
        guardarTemaUsuario();
      }
    })
    .catch((error) => {
      console.log("Error: ", JSON.stringify(error));
    });
}

async function getSpotifyToken() {
  try {
    const response = await fetch("https://accounts.spotify.com/api/token", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        Authorization: "Basic " + btoa(CLIENT_ID + ":" + CLIENT_SECRET),
      },
      body: "grant_type=client_credentials",
    });
    if (!response.ok) {
      throw new Error("Failed to get token");
    }
    const data = await response.json();

    accessToken = data.access_token;

    setTimeout(getSpotifyToken, (data.expires_in - 60) * 1000);
  } catch (error) {
    console.error("Error getting token:", error);
    alert("Error conectando con Spotify. Por favor intente nuevamente.");
  }
}

async function searchSongs() {
  try {
    const searchInput = document.getElementById("searchInput");
    if (!searchInput.value.trim()) {
      alert("Por favor ingrese un término de búsqueda");
      return;
    }
    const searchButton = document.querySelector(".search-container button");
    searchButton.disabled = true;
    searchButton.innerHTML =
      '<span class="material-icons">hourglass_empty</span> Buscando...';
    if (!accessToken) await getSpotifyToken();
    const searchTerm = encodeURIComponent(searchInput.value);
    const searchType = document.getElementById("searchType").value;
    let endpoint = "";
    switch (searchType) {
      case "track":
        endpoint = `search?q=${searchTerm}&type=track&limit=20`;
        break;
      case "artist":
        endpoint = `search?q=artist:${searchTerm}&type=track&limit=20`;
        break;
      case "genre":
        endpoint = `search?q=genre:${searchTerm}&type=track&limit=20`;
        break;
      case "year":
        endpoint = `search?q=year:${searchTerm}&type=track&limit=20`;
        break;
    }
    const response = await fetch(`https://api.spotify.com/v1/${endpoint}`, {
      headers: {
        Authorization: `Bearer ${accessToken}`,
      },
    });
    if (!response.ok) throw new Error("Search failed");
    const data = await response.json();

    if (!data.tracks || !data.tracks.items.length) {
      alert("No songs found");
      return;
    }
    clearFolders();
    for (const track of data.tracks.items) {
      try {
        const audioFeatures = await getTrackAudioFeatures(track.id);
        if (audioFeatures && audioFeatures.tempo) {
          sortSongByBPM(track, audioFeatures.tempo);
        }
      } catch (error) {
        console.error("Error getting audio features:", error);
      }
    }
  } catch (error) {
    console.error("Search error:", error);
    alert("Error al buscar canciones. Por favor intente nuevamente.");
  } finally {
    const searchButton = document.querySelector(".search-container button");
    searchButton.disabled = false;
    searchButton.innerHTML =
      '<span class="material-icons">search</span> Buscar';
  }
}

function clearFolders() {
  //vaciar la lista de temas buscados
  temasBuscados.length = 0;
  const folders = document.querySelectorAll(".folder .song-list");
  console.log("folders", folders);
  folders.forEach((folder) => {
    const folderId = folder.id;
    if (!folderId.includes("custom")) {
      updateFolderCount(folderId, true);
      folder.innerHTML = "";
    }
  });
}

function showMoveModal(trackId) {
  currentTrackToMove = trackId;
  const modal = document.getElementById("moveSongModal");
  const backdrop = document.getElementById("modalBackdrop");
  const folderList = document.getElementById("folderList");
  folderList.innerHTML = "";
  console.log("customFolders", customFolders);
  customFolders.forEach((folder) => {
    const div = document.createElement("div");
    div.className = "folder-option";
    div.textContent = folder.name;
    div.onclick = () => moveTrackToFolder(folder.id);
    folderList.appendChild(div);
  });
  modal.style.display = "block";
  backdrop.style.display = "block";
}

function closeMoveModal() {
  document.getElementById("moveSongModal").style.display = "none";
  document.getElementById("modalBackdrop").style.display = "none";
  currentTrackToMove = null;
}

function moveTrackToFolder(folderId) {
  if (!currentTrackToMove) return;
  const folder = customFolders.find((f) => f.id === folderId);
  if (!folder) return;

  if (!folder.songs.includes(currentTrackToMove)) {
    folder.songs.push(currentTrackToMove);
    const originalSong = document.querySelector(
      `[data-track-id="${currentTrackToMove}"]`
    );
    if (originalSong) {
      const clonedSong = originalSong.cloneNode(true);
      const targetFolder = document.getElementById(`custom-folder-${folderId}`);
      targetFolder.appendChild(clonedSong);
      const moveButton = clonedSong.querySelector("button");
      console.log("currentTrack", currentTrackToMove);
      moveButton.onclick = () => showMoveModal(currentTrackToMove);

      //guardar tema en bd
      const tema = temasBuscados.filter(
        (item) => item.id_spotify == currentTrackToMove
      );
      guardarDatosBd(tema[0], folderId);
    }
    updateFolderCount(`custom-folder-${folderId}`);
  }
  closeMoveModal();
}

function guardarTemaUsuario() {
  //guarda cada tema del usuario en su carpeta correspondiente
  customFolders.forEach((folder) => {
    listaTemas.forEach((tema) => {
      if (tema.id_carpeta === folder.id) {
        folder.songs.push(tema);
        mostrarTemaUsuario(tema);
      }
    });
  });
}

function mostrarTemaUsuario(track) {
  console.log("temausuario", track);
  const idCarpeta = "custom-folder-" + track.id_carpeta;
  console.log("idCarpeta", idCarpeta);

  const songElement = document.createElement("div");
  songElement.className = "song-item";
  songElement.setAttribute("data-track-id", track.id);

  songElement.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
      <span>${track.titulo} - ${track.artista}</span>
      <div class="song-bpm">BPM: ${Math.round(track.tempo || 0)}</div>
      <div>
        <button onclick="event.stopPropagation(); AudioPlayer.toggle('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
          <span class="material-icons playPause" id="playPauseIcon-${track.id}">play_arrow</span>
        </button>
        <button onclick="event.stopPropagation(); showBPM('${track.tempo}')" style="margin-left: 10px;">
          <span class="material-icons">info</span>
          BPM
        </button>
        <button onclick="event.stopPropagation(); moveTrack('${track.id}')" style="margin-left: 10px;">
          <span class="material-icons">move_to_inbox</span>
          Mover
        </button>
        <button onclick="event.stopPropagation(); deleteTrack('${track.id}')" style="margin-left: 10px;">
          <span class="material-icons">delete</span>
          Eliminar
        </button>
      </div>
    </div>
  `;

  document.getElementById(idCarpeta).appendChild(songElement);
  updateFolderCount(idCarpeta);
}

// Improved function to toggle play/pause using AudioPlayer
function togglePlayPause(trackId, previewUrl) {
  AudioPlayer.toggle(trackId, previewUrl);
}

// Improved function to show BPM with category information
function showBPM(bpm) {
  const roundedBpm = Math.round(bpm);
  let category = "";
  
  if (bpm < 85) {
    category = "Tempo lento";
  } else if (bpm >= 85 && bpm < 105) {
    category = "Tempo moderado";
  } else if (bpm >= 105 && bpm < 120) {
    category = "Tempo medio";
  } else if (bpm >= 120 && bpm < 135) {
    category = "Tempo rápido";
  } else if (bpm >= 135 && bpm < 148) {
    category = "Tempo muy rápido";
  } else {
    category = "Tempo extremadamente rápido";
  }
  
  alert(`BPM: ${roundedBpm}\nCategoría: ${category}\n\nBPM (Beats Per Minute) indica el tempo de la canción.`);
}

async function deleteTrack(trackId) {
  tema = listaTemas.find(tema => tema.id == trackId);
  idCarpeta = tema.id_carpeta;

  try {
    // Mostrar un diálogo de confirmación
    const confirmar = confirm(
      "¿Estás seguro de que deseas eliminar esta canción?"
    );

    if (!confirmar) {
      return;
    }

    // Realizar
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
<!-- <section class="sietem pt80 pb128" data-snippet="sietem" data-name="Festival de Imágenes">
        <div class="sietem-conta">
            <h2 class="sietem-title">Festival de Tomorrowland </h2>
            <div class="sietem-gallery">
                <img src="img2/logoTom.jpg"  alt="Festival 1"class="sietem-img" onclick="openModal(this.src)">
                <img  src="img2/tomorrowland.jpg" alt="Festival 2" class="sietem-img" onclick="openModal(this.src)">
                <img  src="img2/matt.jpg" alt="Festival 3" class="sietem-img" onclick="openModal(this.src)">
             
            </div>
        </div>
    </section> -->
    
    <!-- Modal -->
    <div id="sietemModal" class="sietem-modal">
        <span class="sietem-close" onclick="closeModal()">&times;</span>
        <img class="sietem-modal-content" id="sietemModalImg">
     
    </div>
<!--  -->
<section>
<h2>Artistas más reconocidos.</h2>
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