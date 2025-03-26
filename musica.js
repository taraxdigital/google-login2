
const CLIENT_ID = "9581c45310fa4db3b34f244a447f28b0";
const CLIENT_SECRET = "b8ad9e41a8bc46dc968c7b479d9c36a5";

// Actualizar las URLs para que coincidan con la estructura de carpetas actual
const API_URL_TEMAS = "http://localhost/google-login2/prueba/temas.php";
const API_URL_CARPETAS = "http://localhost/google-login2/prueba/carpetas.php";

let accessToken = null;
let customFolders = [];
let listaTemas = [];
let temasBuscados = [];
let currentTrackToMove = null;
let player = null;
let currentlyPlayingTrackId = null;

// Inicializar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function() {
    loadCustomFolders();
    // Inicializar el gestor de modales
    ModalManager.init();
});

function loadCustomFolders() {
<<<<<<< Updated upstream
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
=======
    const saved = localStorage.getItem('customFolders');
    if (saved) {
        customFolders = JSON.parse(saved);
        customFolders.forEach(folder => createCustomFolderElement(folder));
    }
}

function saveCustomFoldersToStorage() {
    localStorage.setItem('customFolders', JSON.stringify(customFolders));
}

async function getSpotifyToken() {
    try {
        const response = await fetch('https://accounts.spotify.com/api/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': 'Basic ' + btoa(CLIENT_ID + ':' + CLIENT_SECRET)
            },
            body: 'grant_type=client_credentials'
        });
        if (!response.ok) throw new Error('Failed to get token');
        const data = await response.json();
        accessToken = data.access_token;
    } catch (error) {
        console.error('Error getting token:', error);
        alert('Error connecting to Spotify. Please try again.');
    }
}

async function searchSongs() {
    try {
        if (!accessToken) await getSpotifyToken();
        
        const searchTerm = encodeURIComponent(document.getElementById('searchInput').value);
        if (!searchTerm) {
            alert('Please enter a search term');
            return;
        }
        
        const searchType = document.getElementById('searchType').value;
        let endpoint = '';
        
        switch(searchType) {
            case 'track':
                endpoint = `search?q=${searchTerm}&type=track&limit=50`;
                break;
            case 'artist':
                endpoint = `search?q=artist:${searchTerm}&type=track&limit=50`;
                break;
            case 'genre':
                endpoint = `search?q=genre:${searchTerm}&type=track&limit=50`;
                break;
            case 'year':
                endpoint = `search?q=year:${searchTerm}&type=track&limit=50`;
                break;
        }
        
        const response = await fetch(`https://api.spotify.com/v1/${endpoint}`, {
            headers: {
                'Authorization': `Bearer ${accessToken}`
            }
        });
        
        if (!response.ok) throw new Error('Search failed');
        const data = await response.json();
        
        if (!data.tracks || !data.tracks.items.length) {
            alert('No songs found');
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
                console.error('Error getting audio features:', error);
            }
        }
    } catch (error) {
        console.error('Search error:', error);
        alert('Error searching songs. Please try again.');
    }
}

function clearFolders() {
    const folders = document.querySelectorAll('.song-list');
    folders.forEach(folder => folder.innerHTML = '');
}

function showMoveModal(trackId) {
    currentTrackToMove = trackId;
    const modal = document.getElementById('moveSongModal');
    const backdrop = document.getElementById('modalBackdrop');
    const folderList = document.getElementById('folderList');
    
    folderList.innerHTML = '';
    customFolders.forEach(folder => {
        const div = document.createElement('div');
        div.className = 'folder-option';
        div.textContent = folder.name;
        div.onclick = () => moveTrackToFolder(folder.id);
        folderList.appendChild(div);
>>>>>>> Stashed changes
    });
}

// ... existing code ...

function moveTrackToFolder(folderId) {
<<<<<<< Updated upstream
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
=======
    if (!currentTrackToMove) return;
    
    const folder = customFolders.find(f => f.id === folderId);
    if (!folder) return;
    
    if (!folder.songs.includes(currentTrackToMove)) {
        folder.songs.push(currentTrackToMove);
        
        const originalSong = document.querySelector(`[data-track-id="${currentTrackToMove}"]`);
        if (originalSong) {
            const clonedSong = originalSong.cloneNode(true);
            document.getElementById(`custom-folder-${folderId}`).appendChild(clonedSong);
            saveCustomFoldersToStorage();
        }
>>>>>>> Stashed changes
    }
    updateFolderCount(`custom-folder-${folderId}`);
  }
  closeMoveModal();
}

<<<<<<< Updated upstream
// ... existing code ...

// Corregir la función togglePlayPause para usar AudioPlayer
function togglePlayPause(trackId, previewUrl) {
  AudioPlayer.toggle(trackId, previewUrl);
}

// Corregir la función deleteFolder que tenía un error de sintaxis
function deleteFolder(folderId) {
  console.log("idCarpeta", folderId);
  if (confirm("¿Estás seguro de que quieres eliminar esta carpeta?")) {
    const folderElement = document.getElementById(
      `folder-container-${folderId}`
    );
    if (folderElement) {
      folderElement.remove();
      eliminarCarpetabd(folderId);
    }
    customFolders = customFolders.filter((f) => f.id !== folderId);
  }
}

// Corregir las funciones de modal para que coincidan con el HTML
function openModal(modalId) {
  document.getElementById(modalId).style.display = 'block';
  document.getElementById('modalBackdrop').style.display = 'block';
}

function closeModal(modalId) {
  if (modalId) {
    document.getElementById(modalId).style.display = 'none';
  } else {
    // Si no se proporciona un ID, cerrar todos los modales
    document.querySelectorAll('.modales').forEach(modal => {
      modal.style.display = 'none';
    });
  }
  document.getElementById('modalBackdrop').style.display = 'none';
  
  // Limpiar el input del nombre de carpeta si es el modal de carpeta personalizada
  if (modalId === 'customFolderModal' || !modalId) {
    document.getElementById('folderNameInput').value = '';
  }
}

function showRecoveryModal() {
  closeModal('loginModal');
  openModal('recoveryModal');
}

function showRegisterModal() {
  closeModal('loginModal');
  openModal('registerModal');
}

// Asegurarse de que el evento de cierre de ventana esté correctamente configurado
window.addEventListener("beforeunload", function() {
  AudioPlayer.cleanup();
});

// Inicializar la tabla de DJs cuando se cargue la página
document.addEventListener('DOMContentLoaded', function() {
  llenarTabla();
  
  // Configurar el botón para mostrar/ocultar DJs
  document.getElementById("btnDJs")?.addEventListener("click", function() {
    const container = document.getElementById("djs-container");
    if (container.style.display === "none" || container.style.display === "") {
      container.style.display = "block";
      llenarTabla();
    } else {
      container.style.display = "none";
    }
  });
});function moveTrackToFolder(folderId) {
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
      if (targetFolder) {
        targetFolder.appendChild(clonedSong);
        
        // Fix: We need to select all buttons and assign proper event handlers
        const buttons = clonedSong.querySelectorAll("button");
        if (buttons.length >= 3) { // Assuming we have play, BPM, move and delete buttons
          // Move button (third button)
          buttons[2].onclick = (event) => {
            event.stopPropagation();
            showMoveModal(currentTrackToMove);
          };
          
          // Delete button (fourth button)
          buttons[3].onclick = (event) => {
            event.stopPropagation();
            deleteTrack(currentTrackToMove);
          };
        }
        
        // Find the track in temasBuscados
        const tema = temasBuscados.find(
          (item) => item.id_spotify === currentTrackToMove
        );
        
        if (tema) {
          guardarDatosBd(tema, folderId);
        } else {
          console.error("Track not found in temasBuscados:", currentTrackToMove);
        }
        
        updateFolderCount(`custom-folder-${folderId}`);
      } else {
        console.error("Target folder not found:", `custom-folder-${folderId}`);
      }
    }
  }
  closeMoveModal();
}

function guardarTemaUsuario() {
  // Guarda cada tema del usuario en su carpeta correspondiente
  if (!customFolders || !listaTemas) {
    console.error("customFolders or listaTemas is not initialized");
    return;
  }
  
  customFolders.forEach((folder) => {
    if (folder && folder.id) {
      const temasEnCarpeta = listaTemas.filter(tema => tema.id_carpeta === folder.id);
      
      if (temasEnCarpeta.length > 0) {
        folder.songs = folder.songs || [];
        
        temasEnCarpeta.forEach((tema) => {
          if (!folder.songs.includes(tema.id)) {
            folder.songs.push(tema.id);
            mostrarTemaUsuario(tema);
          }
        });
      }
    }
  });
}

function mostrarTemaUsuario(track) {
  if (!track || !track.id_carpeta) {
    console.error("Invalid track data:", track);
    return;
  }
  
  const idCarpeta = "custom-folder-" + track.id_carpeta;
  const targetFolder = document.getElementById(idCarpeta);
  
  if (!targetFolder) {
    console.error("Target folder element not found:", idCarpeta);
    return;
  }

  const songElement = document.createElement("div");
  songElement.className = "song-item";
  songElement.setAttribute("data-track-id", track.id);

  // Use AudioPlayer for consistent audio playback
  songElement.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
      <span>${track.titulo || 'Unknown'} - ${track.artista || 'Unknown'}</span>
      <div>
        <button onclick="event.stopPropagation(); AudioPlayer.toggle('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
          <span class="material-icons playPause" id="playPauseIcon-${track.id}">play_arrow</span>
        </button>
        <button onclick="event.stopPropagation(); showBPM('${track.tempo}')" style="margin-left: 10px;">
          <span class="material-icons">info</span>
          BPM
        </button>
        <button onclick="event.stopPropagation(); showMoveModal('${track.id}')" style="margin-left: 10px;">
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

  targetFolder.appendChild(songElement);
  updateFolderCount(idCarpeta);
}

// Single source of truth for audio playback
const AudioPlayer = {
  player: null,
  currentTrackId: null,

  play(trackId, previewUrl) {
    if (!previewUrl) {
      alert("No hay vista previa disponible para esta canción");
      return;
    }

    if (this.player) {
      this.player.pause();
      this.updateIcon(this.currentTrackId, false);
    }

    this.player = new Audio(previewUrl);
    this.player.play();
    this.currentTrackId = trackId;
    this.updateIcon(trackId, true);
    
    // Add ended event to reset icon when playback completes
    this.player.addEventListener('ended', () => {
      this.updateIcon(this.currentTrackId, false);
      this.currentTrackId = null;
    });
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

      // Try to parse as JSON, but handle text responses too
      const text = await response.text();
      try {
        return JSON.parse(text);
      } catch (e) {
        console.warn("Response is not valid JSON:", text);
        return { message: text };
      }
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
    const backdrop = document.getElementById('modalBackdrop');
    if (backdrop) {
      backdrop.addEventListener('click', () => {
        document.querySelectorAll('.modales').forEach(modal => {
          this.hide(modal.id);
        });
      });
    }

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

// Initialize ModalManager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  ModalManager.init();
  
  // Use AudioPlayer for all audio playback
  window.togglePlayPause = (trackId, previewUrl) => {
    AudioPlayer.toggle(trackId, previewUrl);
  };
  
  // Clean up audio when page unloads
  window.addEventListener('beforeunload', () => {
    AudioPlayer.cleanup();
  });
});





// Use AudioPlayer instead of duplicating audio functionality
function togglePlayPause(trackId, previewUrl) {
  AudioPlayer.toggle(trackId, previewUrl);
}

function moveTrack(trackId) {
  // Use the existing showMoveModal function
  showMoveModal(trackId);
}

async function deleteTrack(trackId) {
  // Find the track in listaTemas
  const tema = listaTemas.find(tema => tema.id == trackId);
  if (!tema) {
    console.error("Track not found:", trackId);
    mostrarNotificacion("Error: Canción no encontrada", "error");
    return;
  }
  
  const idCarpeta = tema.id_carpeta;

  try {
    // Mostrar un diálogo de confirmación
    const confirmar = confirm(
      "¿Estás seguro de que deseas eliminar esta canción?"
    );

    if (!confirmar) {
      return;
    }

    // Realizar la petición DELETE al servidor
    const response = await fetch(
      `${API_URL_TEMAS}?metodo=eliminar&id=${trackId}`,
      {
        method: "POST",
      }
    );
    
    // Si la eliminación en el servidor fue exitosa, eliminar de la UI
    const songElement = document.querySelector(
      `.song-item[data-track-id='${trackId}']`
    );
    
    if (songElement) {
      // Si la canción estaba reproduciéndose, detenerla usando AudioPlayer
      if (AudioPlayer.currentTrackId === trackId) {
        AudioPlayer.pause();
      }

      // Eliminar el elemento del DOM
      songElement.remove();

      // Actualizar el contador de la carpeta
      const folderId = songElement.closest(`.song-list`).id;
      if (folderId) {
        updateFolderCount(folderId);
      }

      // Mostrar mensaje de éxito
      mostrarNotificacion("Canción eliminada correctamente", "success");
    }
  } catch (error) {
    console.error("Error al eliminar la canción:", error);
    mostrarNotificacion("Error al eliminar la canción", "error");
  }
}

// Eliminar función duplicada
// function moveTrack(trackId) {
//   // Implementar lógica para mover la canción
//   alert(`Mover la canción con ID: ${trackId}`);
// }

// Función auxiliar para mostrar notificaciones
function mostrarNotificacion(mensaje, tipo) {
  const container = document.getElementById('notificaciones-container');
  
  if (!container) {
    // Fallback a alert si no existe el contenedor
    if (tipo === "error") {
      alert("Error: " + mensaje);
    } else {
      alert(mensaje);
    }
    return;
  }
  
  const notificacion = document.createElement('div');
  notificacion.className = `notificacion ${tipo}`;
  notificacion.textContent = mensaje;
  
  container.appendChild(notificacion);
  
  // Auto-eliminar después de 3 segundos
  setTimeout(() => {
    notificacion.classList.add('fadeOut');
    setTimeout(() => {
      container.removeChild(notificacion);
    }, 500);
  }, 3000);
}

// Eliminar función duplicada
// function showBPM(bpm) {
//   alert(`El BPM de esta canción es: ${bpm}`);
// }

function createSongElement(track) {
  const div = document.createElement("div");
  div.className = "song-item";
  div.setAttribute("data-track-id", track.id);
  div.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
      <span>${track.name} - ${track.artists[0].name}</span>
      <div>
        <button onclick="event.stopPropagation(); AudioPlayer.toggle('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
          <span class="material-icons playPause" id="playPauseIcon-${track.id}">play_arrow</span>
        </button>
        <button onclick="event.stopPropagation(); showBPM('${track.tempo}')" style="margin-left: 10px;">
          <span class="material-icons">info</span>
          BPM
        </button>
        <button onclick="event.stopPropagation(); showMoveModal('${track.id}')" style="margin-left: 10px;">
          <span class="material-icons">drive_file_move</span>
          Mover
        </button>
      </div>
    </div>
  `;
  return div;
}// guardar temas en bd
async function guardarDatosBd(track, id_carpeta) {
  if (!track || !id_carpeta) {
    console.error("Datos inválidos para guardar:", { track, id_carpeta });
    mostrarNotificacion("Error: Datos incompletos para guardar", "error");
    return;
  }

  try {
    const response = await fetch(`${API_URL_TEMAS}?metodo=nuevo`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        titulo: track.titulo,
        artista: track.artista,
        id_spotify: track.id_spotify,
        preview_url: track.preview_url,
        tempo: track.tempo,
        id_carpeta,
      }),
    });

    // Obtener la respuesta como texto primero
    const text = await response.text();
    console.log("Respuesta del servidor:", text);
    
    if (!response.ok) {
      throw new Error(`Error HTTP ${response.status}: ${text}`);
    }
    
    // Intentar parsear como JSON
    let result;
    try {
      result = JSON.parse(text);
    } catch (e) {
      throw new Error(`Error al parsear JSON: ${text}`);
    }
    
    // Actualizar el ID del track y mostrar notificación de éxito
    if (result && result.id) {
      track.id = result.id;
      mostrarNotificacion("Canción guardada correctamente", "success");
      return result;
    } else {
      throw new Error("No se recibió un ID válido del servidor");
    }
  } catch (error) {
    console.error("Error al guardar tema:", error);
    mostrarNotificacion("Error al guardar la canción", "error");
    throw error;
  }
}

function updateFolderCount(id, resetear = false) {
  const songList = document.getElementById(id);
  if (!songList) {
    console.error("No se encontró el elemento con ID:", id);
    return;
  }
  
  const folderElement = songList.closest(".folder");
  if (!folderElement) {
    console.error("No se encontró el contenedor de carpeta para:", id);
    return;
  }
  
  const songCount = folderElement.querySelector(".song-count");
  if (!songCount) {
    console.error("No se encontró el contador de canciones para:", id);
    return;
  }
  
  // Extraer solo el número del texto actual
  const currentText = songCount.textContent;
  let contador = 0;
  
  try {
    contador = parseInt(currentText) || 0;
  } catch (e) {
    // Si hay error al parsear, asumimos 0
    contador = 0;
  }
  
  if (resetear) {
    contador = 0;
  } else {
    contador = contador + 1;
  }
  
  songCount.textContent = contador + " songs";
}

function createCustomFolder() {
  ModalManager.show("customFolderModal");
}

function closeModal() {
  ModalManager.hide("customFolderModal");
  ModalManager.hide("moveSongModal");
  document.getElementById("folderNameInput").value = "";
}

async function saveCustomFolder() {
  const folderNameInput = document.getElementById("folderNameInput");
  if (!folderNameInput) {
    console.error("No se encontró el elemento de entrada para el nombre de la carpeta");
    return;
  }
  
  const folderName = folderNameInput.value.trim();
  if (!folderName) {
    mostrarNotificacion("Por favor ingrese un nombre para la carpeta", "error");
    return;
  }
  
  const fecha = new Date(Date.now());
  const fechaFormateada = fecha.toISOString().slice(0, 10);
  
  const folder = {
    fecha: fechaFormateada,
    name: folderName,
    songs: [],
  };

  try {
    const response = await fetch(`${API_URL_CARPETAS}?metodo=nuevo`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ 
        name: folder.name, 
        fecha: folder.fecha 
      }),
    });
    
    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(`Error HTTP ${response.status}: ${errorText}`);
    }
    
    const result = await response.json();
    
    if (result && result.id) {
      folder.id = result.id;
      customFolders.push(folder);
      createCustomFolderElement(folder);
      closeModal();
      folderNameInput.value = "";
      mostrarNotificacion("Carpeta creada correctamente", "success");
    } else {
      if (result && result.id && !parseInt(result.id)) {
        const erroresApi = Object.values(result.id);
        mostrarNotificacion(`Error: ${erroresApi.join(", ")}`, "error");
      } else {
        throw new Error("No se recibió un ID válido del servidor");
      }
    }
  } catch (error) {
    console.error("Error al crear carpeta:", error);
    mostrarNotificacion("Error al crear la carpeta", "error");
  }
}

async function eliminarCarpetabd(id) {
  if (!id) {
    console.error("ID de carpeta inválido");
    return;
  }
  
  try {
    const response = await fetch(`${API_URL_CARPETAS}?metodo=eliminar&id=${id}`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    });
    
    if (!response.ok) {
      const errorText = await response.text();
      throw new Error(`Error HTTP ${response.status}: ${errorText}`);
    }
    
    const result = await response.json();
    
    if (result && result.success) {
      mostrarNotificacion("Carpeta eliminada correctamente", "success");
    } else {
      if (result && result.id && !parseInt(result.id)) {
        const erroresApi = Object.values(result.id);
        mostrarNotificacion(`Error: ${erroresApi.join(", ")}`, "error");
      } else {
        console.warn("Respuesta inesperada al eliminar carpeta:", result);
      }
    }
  } catch (error) {
    console.error("Error al eliminar carpeta:", error);
    mostrarNotificacion("Error al eliminar la carpeta", "error");
  }
}function createCustomFolderElement(folder) {
  if (!folder || !folder.id || !folder.name) {
    console.error("Invalid folder data:", folder);
    return;
  }

  const div = document.createElement("div");
  div.className = "folder";
  div.id = `folder-container-${folder.id}`;
  div.innerHTML = `
    <h3 onclick="toggleFolder(${folder.id})">
      <span class="material-icons">folder</span>
      ${folder.name}
      <button class="delete-folder" onclick="event.stopPropagation(); deleteFolder(${folder.id})">
        <span class="material-icons">delete</span>
      </button>
      <span class="song-count">0 songs</span>
    </h3>
    <div class="song-list" id="custom-folder-${folder.id}" style="display: none;"></div>
  `;
  
  const customFoldersContainer = document.getElementById("custom-folders");
  if (customFoldersContainer) {
    customFoldersContainer.appendChild(div);
  } else {
    console.error("Custom folders container not found");
  }
}

function toggleFolder(folderId) {
  const folderContent = document.getElementById(`custom-folder-${folderId}`);
  if (!folderContent) {
    console.error("Folder content not found:", folderId);
    return;
  }
  
  if (folderContent.style.display === "none") {
    folderContent.style.display = "block";
  } else {
    folderContent.style.display = "none";
  }
}

function deleteFolder(folderId) {
  console.log("idCarpeta", folderId);
  if (confirm("¿Estás seguro de que quieres eliminar esta carpeta?")) {
    const folderElement = document.getElementById(
      `folder-container-${folderId}`
    );
    
    if (folderElement) {
      // Check if folder has songs
      const songList = document.getElementById(`custom-folder-${folderId}`);
      if (songList && songList.children.length > 0) {
        if (!confirm("Esta carpeta contiene canciones. ¿Estás seguro de eliminarla?")) {
          return;
        }
        
        // Stop any playing songs from this folder
        if (AudioPlayer.currentTrackId) {
          const songInFolder = songList.querySelector(`[data-track-id="${AudioPlayer.currentTrackId}"]`);
          if (songInFolder) {
            AudioPlayer.pause();
          }
        }
      }
      
      // Remove from DOM and database
  folderElement.remove();
eliminarCarpetabd(folderId);

// Update customFolders array
customFolders = customFolders.filter((f) => f.id !== folderId);

mostrarNotificacion("Carpeta eliminada correctamente", "success");
// Use AudioPlayer instead of duplicating audio functionality
function togglePlayPause(trackId, previewUrl) {
  AudioPlayer.toggle(trackId, previewUrl);
}


function cleanupAudio() {
  AudioPlayer.cleanup();
}

// Keep this event listener
window.addEventListener("beforeunload", cleanupAudio);

// Initialize AudioPlayer and ModalManager when the page loads
document.addEventListener('DOMContentLoaded', function() {
  ModalManager.init();
});// Initialize ModalManager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  ModalManager.init();
  
  // Use AudioPlayer for all audio playback
  window.togglePlayPause = (trackId, previewUrl) => {
    AudioPlayer.toggle(trackId, previewUrl);
  };
  
  // Clean up audio when page unloads
  window.addEventListener('beforeunload', () => {
    AudioPlayer.cleanup();
  });
});

// Remove the duplicate ModalManager declaration here
// const ModalManager = {...}

// Use AudioPlayer instead of duplicating audio functionality
function togglePlayPause(trackId, previewUrl) {
  AudioPlayer.toggle(trackId, previewUrl);
}// Initialize AudioPlayer and ModalManager when the page loads
document.addEventListener('DOMContentLoaded', function() {
  ModalManager.init();
  
  // Use AudioPlayer for all audio playback
  window.togglePlayPause = (trackId, previewUrl) => {
    AudioPlayer.toggle(trackId, previewUrl);
  };
  
  // Clean up audio when page unloads
  window.addEventListener('beforeunload', () => {
    AudioPlayer.cleanup();
  });
  
  // Initialize table
  llenarTabla();
});


// Top 10 DJs más conocidos
const djsData = [
  {
    nombre: "David Guetta",
    genero_musical: "House",
    tema_mas_conocido: "Titanium",
    año_de_lanzamiento: 2000,
    biografia:
      "Uno de los DJs más populares del mundo, con sets energéticos y hits comerciales",
    imagen: "img2/guetta.jpg",
  },
  {
    nombre: "Tiësto",
    genero_musical: "Trance/EDM",
    tema_mas_conocido: "Red Lights",
    año_de_lanzamiento: 1990,
    biografia:
      "Leyenda del trance, sigue siendo una figura influyente en la escena electrónica",
    imagen: "img2/tiesto.jpg",
  },
  {
    nombre: "Martin Garrix",
    genero_musical: "EDM",
    tema_mas_conocido: "Animals",
    año_de_lanzamiento: 2012,
    biografia:
      "Joven prodigio que ha revolucionado la escena EDM con su sonido característico",
    imagen: "img2/martin.jpg",
  },
  {
    nombre: "Hardwell",
    genero_musical: "Big Room",
    tema_mas_conocido: "Spaceman",
    año_de_lanzamiento: 2009,
    biografia:
      "Pionero del sonido big room, ha tenido un gran impacto en la escena",
    imagen: "img2/hardwell.jpg",
  },
  {
    nombre: "Armin van Buuren",
    genero_musical: "Trance",
    tema_mas_conocido: "This Is What It Feels Like",
    año_de_lanzamiento: 1995,
    biografia:
      "Un clásico de Tomorrowland, siempre presente con su sonido trance melódico",
    imagen: "img2/armin.jpg",
  },
  {
    nombre: "Dimitri Vegas & Like Mike",
    genero_musical: "Electro House",
    tema_mas_conocido: "The Hum",
    año_de_lanzamiento: 2005,
    biografia:
      "Dúo belga conocido por sus sets llenos de energía y producciones pegadizas",
    imagen: "img2/dimitri.jpg",
  },
  {
    nombre: "Marshmello",
    genero_musical: "Future Bass",
    tema_mas_conocido: "Alone",
    año_de_lanzamiento: 2016,
    biografia: "DJ enmascarado conocido por su sonido distintivo y energético",
    imagen: "img2/marsmello.jpeg",
  },
  {
    nombre: "Afrojack",
    genero_musical: "Electro House",
    tema_mas_conocido: "Take Over Control",
    año_de_lanzamiento: 2007,
    biografia:
      "Productor holandés conocido por sus colaboraciones y remixes de alto perfil",
    imagen: "img2/afrojack.jpg",
  },
  {
    nombre: "Alesso",
    genero_musical: "Electro House",
    tema_mas_conocido: "Heroes",
    año_de_lanzamiento: 2010,
    biografia: "DJ sueco conocido por sus colaboraciones con grandes artistas",
    imagen: "img2/alesso.jpg",
  },
  {
    nombre: "Carl Cox",
    genero_musical: "Techno",
    tema_mas_conocido: "I Want You (Forever)",
    año_de_lanzamiento: 1980,
    biografia:
      "Ícono de la música electrónica, con una carrera que abarca décadas",
    imagen: "img2/carl.png",
  },
=======
function createSongElement(track) {
    const div = document.createElement('div');
    div.className = 'song-item';
    div.setAttribute('data-track-id', track.id);
    div.innerHTML = `
        <span>${track.name} - ${track.artists[0].name}</span>
        <button onclick="showMoveModal('${track.id}')">
            <span class="material-icons">drive_file_move</span>
            Mover
        </button>
    `;
    return div;
}

async function getTrackAudioFeatures(trackId) {
    const response = await fetch(`https://api.spotify.com/v1/audio-features/${trackId}`, {
        headers: {
            'Authorization': `Bearer ${accessToken}`
        }
    });
    return await response.json();
}

function sortSongByBPM(track, bpm) {
    const songElement = createSongElement(track);
    
    if (bpm >= 85 && bpm < 105) {
        document.getElementById('folder-85-105').appendChild(songElement);
        updateFolderCount('folder-85-105');
    } else if (bpm >= 105 && bpm < 120) {
        document.getElementById('folder-105-120').appendChild(songElement);
        updateFolderCount('folder-105-120');
    } else if (bpm >= 120 && bpm < 135) {
        document.getElementById('folder-120-135').appendChild(songElement);
        updateFolderCount('folder-120-135');
    } else if (bpm >= 135 && bpm < 148) {
        document.getElementById('folder-135-148').appendChild(songElement);
        updateFolderCount('folder-135-148');
    } else if (bpm >= 148) {
        document.getElementById('folder-148-plus').appendChild(songElement);
        updateFolderCount('folder-148-plus');
    }
}

function createCustomFolder() {
    document.getElementById('modalBackdrop').style.display = 'block';
    document.getElementById('customFolderModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modalBackdrop').style.display = 'none';
    document.getElementById('customFolderModal').style.display = 'none';
}

function saveCustomFolder() {
    const folderName = document.getElementById('folderNameInput').value;
    if (folderName.trim()) {
        const folder = {
            id: Date.now(),
            name: folderName,
            songs: []
        };
        customFolders.push(folder);
        createCustomFolderElement(folder);
        saveCustomFoldersToStorage();
        closeModal();
        document.getElementById('folderNameInput').value = '';
    }
}

function createCustomFolderElement(folder) {
    const div = document.createElement('div');
    div.className = 'folder';
    div.innerHTML = `
        <h3><span class="material-icons">folder</span> ${folder.name}</h3>
        <div class="song-list" id="custom-folder-${folder.id}"></div>
    `;
    document.getElementById('custom-folders').appendChild(div);
}

window.onload = async () => {
    await getSpotifyToken();
    loadCustomFolders();
};
 
 
 // Top 10 DJs más conocidos
   const djsData = [
    {
        nombre: "David Guetta",
        genero_musical: "House",
        tema_mas_conocido: "Titanium",
        año_de_lanzamiento: 2000,
        biografia: "Uno de los DJs más populares del mundo, con sets energéticos y hits comerciales",
        imagen: "img2/guetta.jpg"
    },
    {
        nombre: "Tiësto",
        genero_musical: "Trance/EDM",
        tema_mas_conocido: "Red Lights",
        año_de_lanzamiento: 1990,
        biografia: "Leyenda del trance, sigue siendo una figura influyente en la escena electrónica",
        imagen: "img2/tiesto.jpg"
    },
    {
        nombre: "Martin Garrix",
        genero_musical: "EDM",
        tema_mas_conocido: "Animals",
        año_de_lanzamiento: 2012,
        biografia: "Joven prodigio que ha revolucionado la escena EDM con su sonido característico",
        imagen: "img2/martin.jpg"
    },
    {
        nombre: "Hardwell",
        genero_musical: "Big Room",
        tema_mas_conocido: "Spaceman",
        año_de_lanzamiento: 2009,
        biografia: "Pionero del sonido big room, ha tenido un gran impacto en la escena",
        imagen: "img2/hardwell.jpg"
    },
    {
        nombre: "Armin van Buuren",
        genero_musical: "Trance",
        tema_mas_conocido: "This Is What It Feels Like",
        año_de_lanzamiento: 1995,
        biografia: "Un clásico de Tomorrowland, siempre presente con su sonido trance melódico",
        imagen: "img2/armin.jpg"
    },
    {
        nombre: "Dimitri Vegas & Like Mike",
        genero_musical: "Electro House",
        tema_mas_conocido: "The Hum",
        año_de_lanzamiento: 2005,
        biografia: "Dúo belga conocido por sus sets llenos de energía y producciones pegadizas",
        imagen: "img2/dimitri.jpg"
    },
    {
        nombre: "Marshmello",
        genero_musical: "Future Bass",
        tema_mas_conocido: "Alone",
        año_de_lanzamiento: 2016,
        biografia: "DJ enmascarado conocido por su sonido distintivo y energético",
        imagen: "img2/marsmello.jpeg"
    },
    {
        nombre: "Afrojack",
        genero_musical: "Electro House",
        tema_mas_conocido: "Take Over Control",
        año_de_lanzamiento: 2007,
        biografia: "Productor holandés conocido por sus colaboraciones y remixes de alto perfil",
        imagen: "img2/afrojack.jpg"
    },
    {
        nombre: "Alesso",
        genero_musical: "Electro House",
        tema_mas_conocido: "Heroes",
        año_de_lanzamiento: 2010,
        biografia: "DJ sueco conocido por sus colaboraciones con grandes artistas",
        imagen: "img2/alesso.jpg"
    },
    {
        nombre: "Carl Cox",
        genero_musical: "Techno",
        tema_mas_conocido: "I Want You (Forever)",
        año_de_lanzamiento: 1980,
        biografia: "Ícono de la música electrónica, con una carrera que abarca décadas",
        imagen: "img2/carl.png"
    }
>>>>>>> Stashed changes
];

// Función para llenar la tabla con los datos
function llenarTabla() {
  const tbody = document.getElementById("djs-tbody");
  tbody.innerHTML = ""; // Limpiar la tabla primero

  djsData.forEach((dj) => {
    const row = document.createElement("tr");
    row.innerHTML = `
            <td>${dj.nombre}</td>
            <td>${dj.genero_musical}</td>
            <td>${dj.tema_mas_conocido || "-"}</td>
            <td>${dj.año_de_lanzamiento}</td>
            <td>${dj.biografia}</td>
            <td><img src="${dj.imagen}" alt="${
      dj.nombre
    }" class="dj-image"></td>
        `;
    tbody.appendChild(row);
  });
}

// Evento para mostrar/ocultar la tabla
document.getElementById("btnDJs").addEventListener("click", function () {
  const container = document.getElementById("djs-container");
  if (container.style.display === "none" || container.style.display === "") {
    container.style.display = "block";
    llenarTabla(); // Llenar la tabla cuando se muestra
  } else {
    container.style.display = "none";
  }
});

// Llenar la tabla inicialmente
llenarTabla();

// imágenes galería///
function openModal(src) {
  var modal = document.getElementById("sietemModal");
  var modalImg = document.getElementById("sietemModalImg");
  var captionText = document.getElementById("sietemCaption");

  modal.style.display = "block";
  modalImg.src = src;
  captionText.innerHTML = src.split("/").pop();
}

// boton login abajo-//////////////


////////////////////////////////
function openModal(modalId) {
  document.getElementById(modalId).style.display = 'flex';
}

<<<<<<< Updated upstream
function closeModal(modalId) {
  document.getElementById(modalId).style.display = 'none';
}

function showRecoveryModal() {
  closeModal('loginModal');
  openModal('recoveryModal');
}

function showRegisterModal() {
  closeModal('loginModal');
  openModal('registerModal');
}
// /////////////////////////////
// function openModal() {
//   document.getElementById('loginModal').style.display = 'block';
// }

// function closeModal(modalId) {
//   document.getElementById(modalId).style.display = 'none';
// }

// function showRecoveryModal() {
//   document.getElementById('loginModal').style.display = 'none';
//   document.getElementById('recoveryModal').style.display = 'block';
// }

// function showRegisterModal() {
//   document.getElementById('loginModal').style.display = 'none';
//   document.getElementById('registerModal').style.display = 'block';
// }

// Cerrar modales al hacer clic fuera de ellos
window.onclick = function(event) {
  let modals = document.getElementsByClassName('modal');
  for(let modal of modals) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
}

// Ocultar mensajes después de 3 segundos
document.addEventListener('DOMContentLoaded', function() {
  let mensaje = document.querySelector('.mensaje');
  if(mensaje) {
      setTimeout(function() {
          mensaje.style.display = 'none';
      }, 3000);
  }
});

// function showLoginModal() {
//   document.getElementById("loginModal").style.display = "block";
// }

// function closeLoginModal() {
//   document.getElementById("loginModal").style.display = "none";
// }


// document
//   .getElementById("loginForm")
//   .addEventListener("submit", function (event) {
//     event.preventDefault();

//     const email = document.getElementById("email").value;
//     const password = document.getElementById("password").value;
//     const emailError = document.getElementById("emailError");
//     const passwordError = document.getElementById("passwordError");
//     const message = document.getElementById("message");

//     // Limpiar mensajes de error
//     emailError.textContent = "";
//     passwordError.textContent = "";
//     message.textContent = "";

//     //Validar formato de email
//     const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//     if (!emailPattern.test(email)) {
//       emailError.textContent = "Formato de email no válido.";
//       return;
//     }

//     // Enviar datos al servidor
//     fetch("login.php", {
//       method: "POST",
//       headers: {
//         "Content-Type": "application/json",
//       },
//       body: JSON.stringify({ email, password }),
//     })
//       .then((response) => response.json())
//       .then((data) => {
//         if (data.success) {
//           message.textContent = "Login exitoso. Redirigiendo...";
//           // Redirigir a otra página o hacer algo más
//           setTimeout(() => {
//             window.location.href = "dashboard.html"; // Cambia a tu página de destino
//           }, 2000);
//         } else {
//           message.textContent = data.message;
//         }
//       })
//       .catch((error) => {
//         message.textContent = "Error en la conexión.";
//       });
//   });



// // Cerrar el modal al hacer clic fuera de él
// window.onclick = function (event) {
//   const modal = document.getElementById("loginModal");
//   if (event.target === modal) {
//     closeLoginModal();
//   }
// };
////////////////////////////login nuevo de claude dia lunes 18 noviembre- abajo//////////
// function openModal() {
//   document.getElementById('loginModal').style.display = 'flex';
//   showLogin(); // Por defecto muestra login
// }

// function closeModal() {
//   document.getElementById('loginModal').style.display = 'none';
//   limpiarFormularios();
// }

// function limpiarFormularios() {
//   document.getElementById('errorContainer').textContent = '';
//   document.getElementById('errorContainer').style.display = 'none';
//   document.querySelectorAll('input').forEach(input => input.value = '');
// }

// // Funciones para cambiar entre formularios
// function showLogin() {
//   document.getElementById('loginForm').style.display = 'block';
//   document.getElementById('registroForm').style.display = 'none';
//   document.getElementById('recuperacionForm').style.display = 'none';
// }

// function showRegistro() {
//   document.getElementById('loginForm').style.display = 'none';
//   document.getElementById('registroForm').style.display = 'block';
//   document.getElementById('recuperacionForm').style.display = 'none';
// }

// function showRecuperacion() {
//   document.getElementById('loginForm').style.display = 'none';
//   document.getElementById('registroForm').style.display = 'none';
//   document.getElementById('recuperacionForm').style.display = 'block';
// }

// // Validaciones
// function validateEmail(email) {
//   const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//   return re.test(email);
// }

// function validatePassword(password) {
//   return password.length >= 8;
// }


// function mostrarError(mensaje, isSuccess = false) {
//   const errorContainer = document.getElementById('errorContainer');
//   errorContainer.textContent = mensaje;
//   errorContainer.style.display = 'block';
//   errorContainer.style.color = isSuccess ? '#4CAF50' : '#ff0000';
//   if (isSuccess) {
//       setTimeout(() => {
//           errorContainer.style.display = 'none';
//       }, 1000);
//   } else {
//       setTimeout(() => {
//           errorContainer.style.display = 'none';
//       }, 3000);
//   }
// }


// // Funciones de autenticación
// async function login(event) {
//   event.preventDefault(); // Prevenir el comportamiento por defecto
//   const email = document.getElementById('email').value.trim();
//   const password = document.getElementById('password').value.trim();
//    // Validar campos vacíos
//    if (!email || !password) {
//     mostrarError('Por favor, complete todos los campos');
//     return;
//    }

//   if (!validateEmail(email)) {
//       mostrarError('Email inválido');
//       return;
//   }

//   if (!validatePassword(password)) {
//       mostrarError('Contraseña debe tener al menos 8 caracteres');
//       return;
//   }

//   try {
//       const response = await fetch('login.php', {
//           method: 'POST',
//           headers: {
//               'Content-Type': 'application/json',
//                 'Accept': 'application/json'
//           },
//           body: JSON.stringify({ email, password }),
//            credentials: 'same-origin'
//       });
//       if (!response.ok) {
//         throw new Error('Error en la conexión');
//     }

//       const data = await response.json();

//       if (data.success) {
//         localStorage.setItem('userName', data.nombre);
//         mostrarError('Login exitoso',true);
//         setTimeout(() => {
//             window.location.href = 'dashboard.php';
//         }, 1000);
        
       
//       } else {
//           mostrarError(data.message || 'Error en el inicio de sesión');
//       }
//   } catch (error) {
//     console.error('Error:', error);
//     mostrarError('Error de conexión al servidor');
//   }
// }

// async function registro() {
//   const nombre = document.getElementById('registroNombre').value;
//   const email = document.getElementById('registroEmail').value;
//   const password = document.getElementById('registroPassword').value;

//   if (nombre.trim() === '') {
//       mostrarError('Nombre es requerido');
//       return;
//   }

//   if (!validateEmail(email)) {
//       mostrarError('Email inválido');
//       return;
//   }

//   if (!validatePassword(password)) {
//       mostrarError('Contraseña debe tener al menos 8 caracteres');
//       return;
//   }

//   try {
//       const response = await fetch('registro.php', {
//           method: 'POST',
//           headers: {
//               'Content-Type': 'application/json'
//           },
//           body: JSON.stringify({ nombre, email, password })
//       });

//       const data = await response.json();

//       if (data.success) {
//           mostrarError('Registro exitoso. Inicia sesión.');
//           showLogin();
//       } else {
//           mostrarError(data.message);
//       }
//   } catch (error) {
//       mostrarError('Error de conexión');
//   }
// }

// async function recuperarContrasena() {
//   const email = document.getElementById('recuperacionEmail').value;

//   if (!validateEmail(email)) {
//       mostrarError('Email inválido');
//       return;
//   }

//   try {
//       const response = await fetch('recuperar.php', {
//           method: 'POST',
//           headers: {
//               'Content-Type': 'application/json'
//           },
//           body: JSON.stringify({ email })
//       });

//       const data = await response.json();

//       if (data.success) {
//           mostrarError('Se ha enviado un enlace de recuperación a tu correo');
//       } else {
//           mostrarError(data.message);
//       }
//   } catch (error) {
//       mostrarError('Error de conexión');
//   }
// }
// /////////////////////////////////////////////reset password
// function resetPassword() {
//   const token = document.getElementById('token').value;
//   const newPassword = document.getElementById('newPassword').value;
//   const confirmPassword = document.getElementById('confirmPassword').value;
//   const messageDiv = document.getElementById('message');

//   if (newPassword !== confirmPassword) {
//       messageDiv.innerHTML = '<p style="color:red;">Las contraseñas no coinciden</p>';
//       return false;
//   }

//   if (newPassword.length < 8) {
//       messageDiv.innerHTML = '<p style="color:red;">La contraseña debe tener al menos 8 caracteres</p>';
//       return false;
//   }

//   fetch('procesar-reset.php', {
//       method: 'POST',
//       headers: {
//           'Content-Type': 'application/json'
//       },
//       body: JSON.stringify({ 
//           token: token, 
//           newPassword: newPassword 
//       })
//   })
//   .then(response => response.json())
//   .then(data => {
//       if (data.success) {
//           messageDiv.innerHTML = '<p style="color:green;">Contraseña restablecida exitosamente</p>';
//           setTimeout(() => {
//               window.location.href = 'login.html';
//           }, 2000);
//       } else {
//           messageDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
//       }
//   })
//   .catch(error => {
//       messageDiv.innerHTML = '<p style="color:red;">Error de conexión</p>';
//   });

//   return false;
// };
=======
>>>>>>> Stashed changes
