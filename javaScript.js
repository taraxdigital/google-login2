// Agregar funcionalidad a los botones del menú
const buttons = document.querySelectorAll('.btn');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        // Agregar lógica para cada botón aquí
        console.log(`Botón ${button.textContent} clickeado`);
    });
});

const nav = document.querySelector("#nav");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");

abrir.addEventListener("click", () => {
    nav.classList.add("visible");
})

cerrar.addEventListener("click", () => {
    nav.classList.remove("visible");
})
function seleccionar() {
    // Implementa la lógica del menú aquí
}

function mostrarOcultarMenu() {
    // Implementa la lógica del menú aquí
}

// Nuevas funciones para el login
const loginButton = document.getElementById('loginButton');
const loginForm = document.getElementById('loginForm');
const userInfo = document.getElementById('userInfo');

loginButton.addEventListener('click', () => {
    loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
});

function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // En un caso real, aquí se verificarían las credenciales con el servidor
    // Para este ejemplo, simplemente guardamos el nombre de usuario
    localStorage.setItem('user', username);

    updateUserInfo();
    loginForm.style.display = 'none';
}

function updateUserInfo() {
    const user = localStorage.getItem('user');
    if (user) {
        userInfo.textContent = `Bienvenido, ${user}`;
        loginButton.textContent = 'Logout';
        loginButton.onclick = logout;
    } else {
        userInfo.textContent = '';
        loginButton.textContent = 'Login';
        loginButton.onclick = () => {
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
        };
    }
}

function logout() {
    localStorage.removeItem('user');
    updateUserInfo();
}

// Actualizar la información del usuario al cargar la página
updateUserInfo();
document.addEventListener("DOMContentLoaded", function () {
    const textEntries = document.querySelectorAll(".text-entry");
  
    const options = {
      root: null,
      rootMargin: "0px",
      threshold: 0.1,
    };
  
    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    }, options);
  
    textEntries.forEach((entry) => {
      observer.observe(entry);
    });
  });
  // Estado del reproductor
let isPlaying = false;
let volume = 1.0;
let currentTime = 0;

// Elementos del DOM
const videoPlayer = document.getElementById('videoPlayer');
const playPauseBtn = document.getElementById('playPauseBtn');
const volumeSlider = document.getElementById('volumeSlider');
const progressBar = document.getElementById('progressBar');
const currentTimeDisplay = document.getElementById('currentTime');
const durationDisplay = document.getElementById('duration');

// Función para reproducir o pausar el video
function togglePlayPause() {
    if (videoPlayer.paused) {
        videoPlayer.play();
        playPauseBtn.textContent = 'Pausar';
        isPlaying = true;
    } else {
        videoPlayer.pause();
        playPauseBtn.textContent = 'Reproducir';
        isPlaying = false;
    }
}

// Función para actualizar el volumen
function updateVolume() {
    volume = volumeSlider.value;
    videoPlayer.volume = volume;
}

// Función para actualizar la barra de progreso
function updateProgressBar() {
    const progress = (videoPlayer.currentTime / videoPlayer.duration) * 100;
    progressBar.style.width = `${progress}%`;
    currentTimeDisplay.textContent = formatTime(videoPlayer.currentTime);
}

// Función para formatear el tiempo en minutos:segundos
function formatTime(timeInSeconds) {
    const minutes = Math.floor(timeInSeconds / 60);
    const seconds = Math.floor(timeInSeconds % 60);
    return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
}

// Función para saltar a una posición en el video
function seek(event) {
    const seekPosition = (event.offsetX / event.target.clientWidth) * videoPlayer.duration;
    videoPlayer.currentTime = seekPosition;
}

// Event Listeners
playPauseBtn.addEventListener('click', togglePlayPause);
volumeSlider.addEventListener('input', updateVolume);
videoPlayer.addEventListener('timeupdate', updateProgressBar);
progressBar.parentElement.addEventListener('click', seek);

// Inicializar la duración del video cuando los metadatos estén cargados
videoPlayer.addEventListener('loadedmetadata', () => {
    durationDisplay.textContent = formatTime(videoPlayer.duration);
});

// Actualizar el botón de reproducción cuando el video termine
videoPlayer.addEventListener('ended', () => {
    playPauseBtn.textContent = 'Reproducir';
    isPlaying = false;
});