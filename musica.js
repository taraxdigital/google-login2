//creo que estas claves eran para loguearse con google
const CLIENT_ID = "50f02085a2684d309a7d8616453a0784";
const CLIENT_SECRET = "73222ab24f704a2b998498e685876dbb";

const API_URL_TEMAS = "http://localhost/google-login/prueba/temas.php";
const API_URL_CARPETAS = "http://localhost/google-login/prueba/carpetas.php";

let accessToken = null;
let customFolders = [];
let listaTemas = [];
let temasBuscados = [];
let currentTrackToMove = null;
let player = null;

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
  //actualizar el número de temas de cada folder
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
///////////
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
      <div>
        <button onclick="event.stopPropagation(); togglePlayPause('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
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

function togglePlayPause(trackId, previewUrl) {
  if (currentlyPlayingTrackId === trackId) {
    // Si la canción ya está sonando, pausamos
    if (player) {
      player.pause();
      currentlyPlayingTrackId = null;
      document.getElementById(`playPauseIcon-${trackId}`).innerText =
        "play_arrow"; // Cambiar icono a play
    }
  } else {
    // Si hay otra canción sonando, la pausamos
    if (player) {
      player.pause();
      document.getElementById(
        `playPauseIcon-${currentlyPlayingTrackId}`
      ).innerText = "play_arrow"; // Cambiar icono de la canción anterior a play
    }

    // Reproducimos la nueva canción
    player = new Audio(previewUrl);
    player.play();
    currentlyPlayingTrackId = trackId;
    document.getElementById(`playPauseIcon-${trackId}`).innerText = "pause"; // Cambiar icono a pause
  }
}
function moveTrack(trackId) {
  // Lógica para mover la canción a otra carpeta
  alert(`Mover la canción con ID: ${trackId}`);
  // Aquí puedes agregar el código para mover la canción a otra carpeta.
}

// function deleteTrack(trackId) {

//   const songElement = document.querySelector(`.song-item[data-track-id='${trackId}']`);
//   if (songElement) {
//     songElement.remove();
//     alert(`Canción con ID: ${trackId} eliminada.`);
//   }
// }
/////////

///////////////

async function deleteTrack(trackId) {

  tema = listaTemas.find(tema => tema.id == trackId)
  idCarpeta = tema.id_carpeta

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
      // Si la canción estaba reproduciéndose, detenerla
      if (currentlyPlayingTrackId === trackId && player) {
        player.pause();
        currentlyPlayingTrackId = null;
      }

      // Eliminar el elemento del DOM
      songElement.remove();

      // Actualizar el contador de la carpeta
      const folderId = songElement.closest(`[id="custom-folder-${idCarpeta}"]`);
      updateFolderCount(folderId);

      // Mostrar mensaje de éxito
      mostrarNotificacion("Canción eliminada correctamente", "success");
    }
  } catch (error) {
    console.error("Error al eliminar la canción:", error);
    mostrarNotificacion("Error al eliminar la canción", "error");
  }
}

function moveTrack(trackId) {
  // Implementar lógica para mover la canción
  alert(`Mover la canción con ID: ${trackId}`);
}

function showBPM(bpm) {
  alert(`El BPM de esta canción es: ${bpm}`);
}

// Función auxiliar para mostrar notificaciones
function mostrarNotificacion(mensaje, tipo) {
  // Implementar según el sistema de notificaciones que uses
  // Por ejemplo, podrías usar una librería como toastr o una implementación propia
  if (tipo === "error") {
    alert("Error: " + mensaje);
  } else {
    alert(mensaje);
  }
}

function showBPM(bpm) {
  alert(`El BPM de esta canción es: ${bpm}`);
}
// function mostrarTemaUsuario(track){
//   console.log('temausuario', track)
//   const idCarpeta = 'custom-folder-' + track.id_carpeta;
//   console.log('idCarpeta',idCarpeta)
//   const songElement = document.createElement("div");
//   songElement.className = "song-item";
//   songElement.setAttribute("data-track-id", track.id);
//   songElement.innerHTML = `
//     <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
//       <span>${track.titulo} - ${track.artista}</span>
//       <div>
//         <button onclick="event.stopPropagation(); playTrack('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
//           <span class="material-icons playPause">play_arrow</span>
//         </button>
//         <button onclick="event.stopPropagation(); showMoveModal('${track.id}')" style="margin-left: 10px;">
//           <span class="material-icons">play_arrow</span>
//           Mover
//         </button>
//       </div>
//     </div>
//   `;
//   document.getElementById(idCarpeta).appendChild(songElement);
//   updateFolderCount(idCarpeta);

// }
function createSongElement(track) {
  const div = document.createElement("div");
  div.className = "song-item";
  div.setAttribute("data-track-id", track.id);
  div.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
      <span>${track.name} - ${track.artists[0].name}</span>
      <div>
        <button onclick="event.stopPropagation(); togglePlayPause('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
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
}
// function createSongElement(track) {
//   const div = document.createElement("div");
//   div.className = "song-item";
//   div.setAttribute("data-track-id", track.id);
//   div.innerHTML = `
//     <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
//       <span>${track.name} - ${track.artists[0].name}</span>
//       <div>
//         <button onclick="event.stopPropagation(); togglePlayPause('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
//           <span class="material-icons playPause" id="playPauseIcon-${track.id}">play_arrow</span>
//         </button>
//         <button onclick="event.stopPropagation(); showMoveModal('${track.id}')" style="margin-left: 10px;">
//           <span class="material-icons">drive_file_move</span>
//           Mover
//         </button>
//       </div>
//     </div>
//   `;

//   return div;
// }

async function getTrackAudioFeatures(trackId) {
  const response = await fetch(
    `https://api.spotify.com/v1/audio-features/${trackId}`,
    {
      headers: {
        Authorization: `Bearer ${accessToken}`,
      },
    }
  );
  return await response.json();
}

function sortSongByBPM(track, bpm) {
  temasBuscados.push({
    id: 0,
    titulo: track.name,
    artista: track.artists[0].name,
    id_spotify: track.id,
    preview_url: track.preview_url,
    tempo: bpm,
  });

  id_carpeta = 1;
  const songElement = createSongElement(track);
  if (bpm >= 85 && bpm < 105) {
    document.getElementById("folder-85-105").appendChild(songElement);
    updateFolderCount("folder-85-105");
  } else if (bpm >= 105 && bpm < 120) {
    id_carpeta = 2;
    document.getElementById("folder-105-120").appendChild(songElement);
    updateFolderCount("folder-105-120");
  } else if (bpm >= 120 && bpm < 135) {
    id_carpeta = 3;
    document.getElementById("folder-120-135").appendChild(songElement);
    updateFolderCount("folder-120-135");
  } else if (bpm >= 135 && bpm < 148) {
    id_carpeta = 4;
    document.getElementById("folder-135-148").appendChild(songElement);
    updateFolderCount("folder-135-148");
  } else if (bpm >= 148) {
    id_carpeta = 5;
    document.getElementById("folder-148-plus").appendChild(songElement);
    updateFolderCount("folder-148-plus");
  }
}

// guardar temas en bd
function guardarDatosBd(track, id_carpeta) {
  fetch(`${API_URL_TEMAS}?metodo=nuevo`, {
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
  })
    .then((response) => {
      // Primero vemos la respuesta completa como texto
      return response.text().then((text) => {
        console.log("Respuesta del servidor:", text);
        // Si la respuesta no es OK, lanzamos un error
        if (!response.ok) {
          throw new Error(`Error HTTP ${response.status}: ${text}`);
        }
        // Si llegamos aquí, intentamos parsear como JSON
        try {
          return JSON.parse(text);
        } catch (e) {
          throw new Error(`Error al parsear JSON: ${text}`);
        }
      });
    })
    .then((result) => {
      track.id = result.id;
    })
    .catch((error) => {
      console.error("Error completo:", error);
      console.error("Mensaje:", error.message);
    });
}

function updateFolderCount(id, resetear = false) {
  const songList = document.getElementById(id);
  const songCount = songList.closest(".folder").querySelector(".song-count");
  let contador = parseInt(songCount.textContent);
  if (resetear) {
    contador = 0;
  } else {
    contador = contador + 1;
  }
  songCount.textContent = contador + " songs";
}

function createCustomFolder() {
  document.getElementById("modalBackdrop").style.display = "block";
  document.getElementById("customFolderModal").style.display = "block";
}

function closeModal() {
  document.getElementById("modalBackdrop").style.display = "none";
  document.getElementById("customFolderModal").style.display = "none";
  document.getElementById("moveSongModal").style.display = "none";
  document.getElementById("folderNameInput").value = "";
}

function saveCustomFolder() {
  const folderName = document.getElementById("folderNameInput").value;
  const fecha = new Date(Date.now());
  const fechaFormateada = fecha.toISOString().slice(0, 10);
  if (folderName.trim()) {
    const folder = {
      fecha: fechaFormateada,
      name: folderName,
      songs: [],
    };

    const name = folder.name;
    const fecha = folder.fecha;
    console.log(folder);
    fetch(`${API_URL_CARPETAS}?metodo=nuevo`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name, fecha }),
    })
      .then((response) => response.json())
      .then((result) => {
        folder.id = result.id;
        customFolders.push(folder);
        createCustomFolderElement(folder);
        closeModal();
        document.getElementById("folderNameInput").value = "";
        if (!parseInt(result["id"])) {
          erroresApi = Object.values(result["id"]);
        }
      })
      .catch((error) => {
        console.log("Error: ", JSON.stringify(error));
      });
  }
}

function eliminarCarpetabd(id) {
  fetch(`${API_URL_CARPETAS}?metodo=eliminar&id=${id}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((result) => {
      console.log(result);
      if (!parseInt(result["id"])) {
        erroresApi = Object.values(result["id"]);
      }
    })
    .catch((error) => {
      console.log("Error: ", JSON.stringify(error));
    });
}

function createCustomFolderElement(folder) {
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
  document.getElementById("custom-folders").appendChild(div);
}

function toggleFolder(folderId) {
  const folderContent = document.getElementById(`custom-folder-${folderId}`);
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
      folderElement.remove();

      eliminarCarpetabd(folderId);
    }
    customFolders = customFolders.filter((f) => f.id !== folderId);
    //saveCustomFoldersToStorage();
  }
}
///////////////////////////////login abajo

let isLoggedIn = false;
let currentUser = null;

function showLoginModal() {
  document.getElementById("loginModal").style.display = "block";
  document.getElementById("modalBackdrop").style.display = "block";
}

function closeLoginModal() {
  document.getElementById("loginModal").style.display = "none";
  document.getElementById("modalBackdrop").style.display = "none";
  document.getElementById("loginForm").reset();
}

async function handleLogin(event) {
  event.preventDefault();
  const email = document.getElementById("emailInput").value;
  const password = document.getElementById("passwordInput").value;
  try {
    const user = {
      email: email,
      name: email.split("@")[0],
    };
    isLoggedIn = true;
    currentUser = user;
    const loginBtn = document.getElementById("loginBtn");
    loginBtn.innerHTML = `
      <span class="material-icons">account_circle</span>
      ${user.name}
    `;
    loginBtn.onclick = handleLogout;
    closeLoginModal();
    localStorage.setItem("user", JSON.stringify(user));
  } catch (error) {
    console.error("Login error:", error);
    alert("Error logging in. Please try again.");
  }
}

function handleLogout() {
  isLoggedIn = false;
  currentUser = null;
  const loginBtn = document.getElementById("loginBtn");
  loginBtn.innerHTML = `
    <span class="material-icons">account_circle</span>
    Login
  `;
  loginBtn.onclick = showLoginModal;
  localStorage.removeItem("user");
}

window.onload = async () => {
  await getSpotifyToken();
  loadCustomFolders();
  const savedUser = localStorage.getItem("user");
  if (savedUser) {
    currentUser = JSON.parse(savedUser);
    isLoggedIn = true;
    const loginBtn = document.getElementById("loginBtn");
    loginBtn.innerHTML = `
      <span class="material-icons">account_circle</span>
      ${currentUser.name}
    `;
    loginBtn.onclick = handleLogout;
  }
};

document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    closeModal();
  }
});

document.getElementById("modalBackdrop").addEventListener("click", closeModal);

document
  .getElementById("customFolderModal")
  .addEventListener("click", function (e) {
    e.stopPropagation();
  });

document
  .getElementById("moveSongModal")
  .addEventListener("click", function (e) {
    e.stopPropagation();
  });
///          abajo  boton pausa//
let play = null;
let currentlyPlayingTrackId = null;

//Está duplicada la función
// function createSongElement(track) {
//   const div = document.createElement("div");
//   div.className = "song-item";
//   div.setAttribute("data-track-id", track.id);
//   div.innerHTML = `
//     <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
//       <span>${track.name} - ${track.artists[0].name}</span>
//       <div>
//         <button onclick="event.stopPropagation(); togglePlayPause('${track.id}', '${track.preview_url}')" style="margin-right: 10px;">
//           <span class="material-icons" id="playPauseIcon-${track.id}">play_arrow</span>
//         </button>
//         <button onclick="event.stopPropagation(); showMoveModal('${track.id}')" style="margin-left: 10px;">
//           <span class="material-icons">drive_file_move</span>
//           Mover
//         </button>
//       </div>
//     </div>
//   `;
//   return div;
// }

function togglePlayPause(trackId, previewUrl) {
  if (currentlyPlayingTrackId === trackId && player && !player.paused) {
    pauseTrack();
  } else {
    playTrack(trackId, previewUrl);
  }
}
///////////////////////////funcion playTrack

function playTrack(trackId, previewUrl) {
  if (player) {
    player.pause();
  }
  if (previewUrl) {
    player = new Audio(previewUrl);
    player.play();
    currentlyPlayingTrackId = trackId;
    updatePlayPauseIcon(trackId, true);
  } else {
    alert("Lo siento, no hay una vista previa disponible para esta canción.");
  }
}

function pauseTrack() {
  if (player) {
    player.pause();
    updatePlayPauseIcon(currentlyPlayingTrackId, false);
    currentlyPlayingTrackId = null;
  }
}

function updatePlayPauseIcon(trackId, isPlaying) {
  const iconos = document.querySelectorAll(".material-icons.playPause");
  iconos.forEach((icono) => {
    icono.textContent = "play_arrow";
  });
  const icon = document.getElementById(`playPauseIcon-${trackId}`);
  if (icon) {
    icon.textContent = isPlaying ? "pause" : "play_arrow";
  }
}

// Asegúrate de que esta función se llame cuando se cambie de página o se cierre la aplicación
function cleanupAudio() {
  if (player) {
    player.pause();
    player = null;
  }
  currentlyPlayingTrackId = null;
}

// Añade este evento al final del archivo
window.addEventListener("beforeunload", cleanupAudio);
/**
 * abajo añadir carpetas creadas
 */
//

// Asegúrate de llamar a esta función cuando la página se cargue
//window.addEventListener("load", loadCustomFolders);
////////////////////////////////////////////////////////////////login abajo  /////////////////////

/////////////////////////////////////////////
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
function showLoginModal() {
  document.getElementById("loginModal").style.display = "block";
}

function closeLoginModal() {
  document.getElementById("loginModal").style.display = "none";
}


document
  .getElementById("loginForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    const message = document.getElementById("message");

    // Limpiar mensajes de error
    emailError.textContent = "";
    passwordError.textContent = "";
    message.textContent = "";

    //Validar formato de email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      emailError.textContent = "Formato de email no válido.";
      return;
    }

    // Enviar datos al servidor
    fetch("login.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email, password }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          message.textContent = "Login exitoso. Redirigiendo...";
          // Redirigir a otra página o hacer algo más
          setTimeout(() => {
            window.location.href = "dashboard.html"; // Cambia a tu página de destino
          }, 2000);
        } else {
          message.textContent = data.message;
        }
      })
      .catch((error) => {
        message.textContent = "Error en la conexión.";
      });
  });



// Cerrar el modal al hacer clic fuera de él
window.onclick = function (event) {
  const modal = document.getElementById("loginModal");
  if (event.target === modal) {
    closeLoginModal();
  }
};
////////////////////////////login nuevo de claude dia lunes 18 noviembre- abajo//////////
function openModal() {
  document.getElementById('loginModal').style.display = 'flex';
  showLogin(); // Por defecto muestra login
}

function closeModal() {
  document.getElementById('loginModal').style.display = 'none';
  limpiarFormularios();
}

function limpiarFormularios() {
  document.getElementById('errorContainer').textContent = '';
  document.getElementById('errorContainer').style.display = 'none';
  document.querySelectorAll('input').forEach(input => input.value = '');
}

// Funciones para cambiar entre formularios
function showLogin() {
  document.getElementById('loginForm').style.display = 'block';
  document.getElementById('registroForm').style.display = 'none';
  document.getElementById('recuperacionForm').style.display = 'none';
}

function showRegistro() {
  document.getElementById('loginForm').style.display = 'none';
  document.getElementById('registroForm').style.display = 'block';
  document.getElementById('recuperacionForm').style.display = 'none';
}

function showRecuperacion() {
  document.getElementById('loginForm').style.display = 'none';
  document.getElementById('registroForm').style.display = 'none';
  document.getElementById('recuperacionForm').style.display = 'block';
}

// Validaciones
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

function validatePassword(password) {
  return password.length >= 8;
}


function mostrarError(mensaje, isSuccess = false) {
  const errorContainer = document.getElementById('errorContainer');
  errorContainer.textContent = mensaje;
  errorContainer.style.display = 'block';
  errorContainer.style.color = isSuccess ? '#4CAF50' : '#ff0000';
  if (isSuccess) {
      setTimeout(() => {
          errorContainer.style.display = 'none';
      }, 1000);
  } else {
      setTimeout(() => {
          errorContainer.style.display = 'none';
      }, 3000);
  }
}


// Funciones de autenticación
async function login(event) {
  event.preventDefault(); // Prevenir el comportamiento por defecto
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value.trim();
   // Validar campos vacíos
   if (!email || !password) {
    mostrarError('Por favor, complete todos los campos');
    return;
   }

  if (!validateEmail(email)) {
      mostrarError('Email inválido');
      return;
  }

  if (!validatePassword(password)) {
      mostrarError('Contraseña debe tener al menos 8 caracteres');
      return;
  }

  try {
      const response = await fetch('login.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
                'Accept': 'application/json'
          },
          body: JSON.stringify({ email, password }),
           credentials: 'same-origin'
      });
      if (!response.ok) {
        throw new Error('Error en la conexión');
    }

      const data = await response.json();

      if (data.success) {
        localStorage.setItem('userName', data.nombre);
        mostrarError('Login exitoso',true);
        setTimeout(() => {
            window.location.href = 'dashboard.php';
        }, 1000);
        
       
      } else {
          mostrarError(data.message || 'Error en el inicio de sesión');
      }
  } catch (error) {
    console.error('Error:', error);
    mostrarError('Error de conexión al servidor');
  }
}

async function registro() {
  const nombre = document.getElementById('registroNombre').value;
  const email = document.getElementById('registroEmail').value;
  const password = document.getElementById('registroPassword').value;

  if (nombre.trim() === '') {
      mostrarError('Nombre es requerido');
      return;
  }

  if (!validateEmail(email)) {
      mostrarError('Email inválido');
      return;
  }

  if (!validatePassword(password)) {
      mostrarError('Contraseña debe tener al menos 8 caracteres');
      return;
  }

  try {
      const response = await fetch('registro.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ nombre, email, password })
      });

      const data = await response.json();

      if (data.success) {
          mostrarError('Registro exitoso. Inicia sesión.');
          showLogin();
      } else {
          mostrarError(data.message);
      }
  } catch (error) {
      mostrarError('Error de conexión');
  }
}

async function recuperarContrasena() {
  const email = document.getElementById('recuperacionEmail').value;

  if (!validateEmail(email)) {
      mostrarError('Email inválido');
      return;
  }

  try {
      const response = await fetch('recuperar.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ email })
      });

      const data = await response.json();

      if (data.success) {
          mostrarError('Se ha enviado un enlace de recuperación a tu correo');
      } else {
          mostrarError(data.message);
      }
  } catch (error) {
      mostrarError('Error de conexión');
  }
}
/////////////////////////////////////////////reset password
function resetPassword() {
  const token = document.getElementById('token').value;
  const newPassword = document.getElementById('newPassword').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  const messageDiv = document.getElementById('message');

  if (newPassword !== confirmPassword) {
      messageDiv.innerHTML = '<p style="color:red;">Las contraseñas no coinciden</p>';
      return false;
  }

  if (newPassword.length < 8) {
      messageDiv.innerHTML = '<p style="color:red;">La contraseña debe tener al menos 8 caracteres</p>';
      return false;
  }

  fetch('procesar-reset.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json'
      },
      body: JSON.stringify({ 
          token: token, 
          newPassword: newPassword 
      })
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          messageDiv.innerHTML = '<p style="color:green;">Contraseña restablecida exitosamente</p>';
          setTimeout(() => {
              window.location.href = 'login.html';
          }, 2000);
      } else {
          messageDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
      }
  })
  .catch(error => {
      messageDiv.innerHTML = '<p style="color:red;">Error de conexión</p>';
  });

  return false;
}