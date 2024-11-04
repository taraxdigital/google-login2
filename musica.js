
// ///

const CLIENT_ID = "";
const CLIENT_SECRET = "";

let accessToken = null;
let customFolders = [];
let currentTrackToMove = null;

function loadCustomFolders() {
  const saved = localStorage.getItem("customFolders");
  if (saved) {
    customFolders = JSON.parse(saved);
    customFolders.forEach((folder) => createCustomFolderElement(folder));
  }
}

function saveCustomFoldersToStorage() {
  localStorage.setItem("customFolders", JSON.stringify(customFolders));
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
    console.log(data);
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
    console.log(data);
    if (!data.tracks || !data.tracks.items.length) {
      alert("No songs found");
      return;
    }

    clearFolders();

    for (const track of data.tracks.items) {
      try {
        const audioFeatures = await getTrackAudioFeatures(track.id);
        if (audioFeatures && audioFeatures.tempo) {
          console.log(audioFeatures);
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
  const folders = document.querySelectorAll(".song-list");
  folders.forEach((folder) => (folder.innerHTML = ""));
}

function showMoveModal(trackId) {
  currentTrackToMove = trackId;
  const modal = document.getElementById("moveSongModal");
  const backdrop = document.getElementById("modalBackdrop");
  const folderList = document.getElementById("folderList");

  folderList.innerHTML = "";
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
// ç

// 
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
      moveButton.onclick = () => showMoveModal(currentTrackToMove);

      saveCustomFoldersToStorage();
    }

    updateFolderCount(`custom-folder-${folderId}`);
  }

  closeMoveModal();
}

function createSongElement(track) {
  const div = document.createElement("div");
  div.className = "song-item";
  div.setAttribute("data-track-id", track.id);
  div.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 8px;">
            <span>${track.name} - ${track.artists[0].name}</span>
            <button onclick="event.stopPropagation(); showMoveModal('${track.id}')" style="margin-left: 10px;">
                <span class="material-icons">drive_file_move</span>
                Mover
            </button>
        </div>
    `;
  return div;
}

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
  console.log(track);
  console.log(bpm);
  const songElement = createSongElement(track);

  if (bpm >= 85 && bpm < 105) {
    document.getElementById("folder-85-105").appendChild(songElement);
    updateFolderCount("folder-85-105");
  } else if (bpm >= 105 && bpm < 120) {
    document.getElementById("folder-105-120").appendChild(songElement);
    updateFolderCount("folder-105-120");
  } else if (bpm >= 120 && bpm < 135) {
    document.getElementById("folder-120-135").appendChild(songElement);
    updateFolderCount("folder-120-135");
  } else if (bpm >= 135 && bpm < 148) {
    document.getElementById("folder-135-148").appendChild(songElement);
    updateFolderCount("folder-135-148");
  } else if (bpm >= 148) {
    document.getElementById("folder-148-plus").appendChild(songElement);
    updateFolderCount("folder-148-plus");
  }
}

function updateFolderCount(id) {
    const songList = document.getElementById(id);
    const songCount = songList.closest(".folder").querySelector(".song-count");
    
    // Convertimos el texto a número
    let contador = parseInt(songCount.textContent);
    
    // Incrementamos el contador
    contador = contador + 1;
    
    // Actualizamos el span con el nuevo valor
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
  if (folderName.trim()) {
    const folder = {
      id: Date.now(),
      name: folderName,
      songs: [],
    };
    customFolders.push(folder);
    createCustomFolderElement(folder);
    saveCustomFoldersToStorage();
    closeModal();
    document.getElementById("folderNameInput").value = "";
  }
}

function createCustomFolderElement(folder) {
  const div = document.createElement("div");
  div.className = "folder";
  div.id = `folder-container-${folder.id}`;
  div.innerHTML = `
        <h3>
            <span class="material-icons">folder</span> 
            ${folder.name}
            <button class="delete-folder" onclick="deleteFolder(${folder.id})">
                <span class="material-icons">delete</span>
            </button>
               <span class="song-count">0 songs</span>
        </h3>
     
        <div class="song-list" id="custom-folder-${folder.id}"></div>
    `;
  document.getElementById("custom-folders").appendChild(div);
}

function deleteFolder(folderId) {
  if (confirm("¿Estás seguro de que quieres eliminar esta carpeta?")) {
    const folderElement = document.getElementById(
      `folder-container-${folderId}`
    );
    if (folderElement) {
      folderElement.remove();
    }

    customFolders = customFolders.filter((f) => f.id !== folderId);
    saveCustomFoldersToStorage();
  }
}

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

function closeModal() {
  var modal = document.getElementById("sietemModal");
  modal.style.display = "none";
}

// funcion- registro-
