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

document.querySelector('.open-modal').addEventListener('click', function() {
  document.querySelector('.modal').style.display = 'block';
});

////
// Código JavaScript para agregar interactividad a la sección Coze (opcional)
// Puedes utilizar este espacio para agregar funcionalidad adicional a la sección Coze, como animaciones o eventos de clic.

// Ejemplo de código JavaScript para mostrar un mensaje al hacer clic en la imagen
const cozeImage = document.querySelector('.coze-image');
cozeImage.addEventListener('click', () => {
    alert('¡Has hecho clic en la imagen de Coze!');
});
///////////
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM cargado");
});

////////////
window.addEventListener('DOMContentLoaded', (event) => {
    const data = [
        { id: 1, name: "David Guetta", bestTrack: "Titanium", releaseYear: 2011 },
        { id: 2, name: "Martin Garrix", bestTrack: "Animals", releaseYear: 2013 },
        { id: 3, name: "Calvin Harris", bestTrack: "One Kiss", releaseYear: 2018 },
        { id: 4, name: "Marshmello", bestTrack: "Happier", releaseYear: 2018 },
        { id: 5, name: "The Chainsmokers", bestTrack: "Closer", releaseYear: 2016 },
        { id: 6, name: "Tiësto", bestTrack: "The Business", releaseYear: 2020 },
        { id: 7, name: "Diplo", bestTrack: "Lean On", releaseYear: 2015 },
        { id: 8, name: "Skrillex", bestTrack: "Where Are Ü Now", releaseYear: 2015 },
        { id: 9, name: "Zedd", bestTrack: "The Middle", releaseYear: 2018 },
        { id: 10, name: "Kygo", bestTrack: "It Ain't Me", releaseYear: 2017 },
        { id: 11, name: "Armin van Buuren", bestTrack: "This Is What It Feels Like", releaseYear: 2013 },
        { id: 12, name: "Steve Aoki", bestTrack: "Just Hold On", releaseYear: 2016 },
        { id: 13, name: "Avicii", bestTrack: "Wake Me Up", releaseYear: 2013 },
        { id: 14, name: "Hardwell", bestTrack: "Spaceman", releaseYear: 2012 },
        { id: 15, name: "Afrojack", bestTrack: "Take Over Control", releaseYear: 2010 },
        { id: 16, name: "Deadmau5", bestTrack: "Ghosts 'n' Stuff", releaseYear: 2009 },
        { id: 17, name: "Don Diablo", bestTrack: "On My Mind", releaseYear: 2019 },
        { id: 18, name: "Oliver Heldens", bestTrack: "Gecko (Overdrive)", releaseYear: 2013 },
        { id: 19, name: "Alan Walker", bestTrack: "Faded", releaseYear: 2015 },
        { id: 20, name: "Alesso", bestTrack: "Heroes", releaseYear: 2014 }
    ];

    const listContainer = document.getElementById('list');

    data.forEach(item => {
        const listItem = document.createElement('div');
        listItem.classList.add('item');
        listItem.textContent = item.name;

        listItem.addEventListener('click', () => {
            showDetails(item);
        });

        listContainer.appendChild(listItem);
    });

    function showDetails(item) {
        // Aquí puedes mostrar los demás datos del elemento seleccionado, como el mejor track y el año de lanzamiento.
        console.log(item);
    }
});
document.getElementById("parallax").style.backgroundImage =
  "url('img/2(1).png')";

window.addEventListener("scroll", function () {
  let parallax = document.getElementById("parallax");
  let scrolPosition = window.scrollY;

  parallax.style.backgroundPositionY = scrolPosition * 0.7 + "px";
});


// imagen 3
// Función para manejar la carga de imágenes
const TERCERA_manejadorImagenes = {
    init: function() {
        // Seleccionar todas las imágenes con la clase TERCERA_imagen
        const imagenes = document.querySelectorAll('.TERCERA_imagen');
        
        // Añadir event listeners a cada imagen
        imagenes.forEach(imagen => {
            imagen.addEventListener('load', this.imagenCargada);
            imagen.addEventListener('error', this.errorCargaImagen);
            
            // Añadir lazy loading
            if ('loading' in HTMLImageElement.prototype) {
                imagen.loading = 'lazy';
            }
        });

        // Inicializar observador de intersección para lazy loading en navegadores que no lo soportan nativamente
        this.initLazyLoading();
    },

    imagenCargada: function(event) {
        const imagen = event.target;
        imagen.classList.add('TERCERA_imagen_cargada');
        
        // Aplicar animación de fade in
        imagen.style.opacity = '0';
        setTimeout(() => {
            imagen.style.transition = 'opacity 0.3s ease-in';
            imagen.style.opacity = '1';
        }, 50);
    },

    errorCargaImagen: function(event) {
        const imagen = event.target;
        imagen.classList.add('TERCERA_imagen_error');
        
        // Reemplazar con imagen de error por defecto
        imagen.src = '/ruta/a/imagen-error.svg';
        console.error('Error al cargar la imagen:', imagen.dataset.originalSrc);
    },

    initLazyLoading: function() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        this.cargarImagen(img);
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('.TERCERA_imagen[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    },

    cargarImagen: function(imagen) {
        if (imagen.dataset.src) {
            imagen.src = imagen.dataset.src;
            delete imagen.dataset.src;
        }
    },

    // Función para redimensionar imágenes si es necesario
    redimensionarImagen: function(imagen) {
        const maxWidth = imagen.dataset.resizeWidth || 537; // Ancho máximo de la imagen
        
        if (imagen.naturalWidth > maxWidth) {
            const aspect = imagen.naturalHeight / imagen.naturalWidth;
            imagen.style.width = `${maxWidth}px`;
            imagen.style.height = `${Math.round(maxWidth * aspect)}px`;
        }
    },

    // Función para manejar las formas y colores de la imagen
    aplicarForma: function(imagen) {
        if (imagen.dataset.shape) {
            const shape = imagen.dataset.shape;
            const colors = imagen.dataset.shapeColors?.split(';') || [];
            
            // Aplicar forma y colores según los datos del atributo
            imagen.style.clipPath = this.obtenerForma(shape);
            if (colors[0]) {
                imagen.style.backgroundColor = colors[0];
            }
        }
    },

    obtenerForma: function(shape) {
        const formas = {
            'pattern_point': 'polygon(0% 0%, 100% 0%, 100% 75%, 75% 75%, 75% 100%, 50% 75%, 0% 75%)',
            // Añadir más formas según sea necesario
        };
        return formas[shape] || '';
    }
};

// Inicializar cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
    TERCERA_manejadorImagenes.init();
});

// Manejar cambios de tamaño de ventana
window.addEventListener('resize', () => {
    const imagenes = document.querySelectorAll('.TERCERA_imagen');
    imagenes.forEach(imagen => {
        TERCERA_manejadorImagenes.redimensionarImagen(imagen);
    });
});

// Añadir estilos CSS dinámicamente
const estilos = `
    .TERCERA_imagen {
        opacity: 0;
        transition: opacity 0.3s ease-in;
    }
    
    .TERCERA_imagen_cargada {
        opacity: 1;
    }
    
    .TERCERA_imagen_error {
        border: 1px solid #ff0000;
        background-color: #ffeeee;
    }
    
    .TERCERA_imagen_personalizada {
        position: relative;
        overflow: hidden;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = estilos;
document.head.appendChild(styleSheet);