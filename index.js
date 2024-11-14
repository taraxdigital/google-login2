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

  // imagen 3
  // Función para manejar la carga de imágenes SI QUITO ESTO EL DESPLEGABLE NO SE ABRE-//////////////
  const TERCERA_manejadorImagenes = {
    init: function () {
      // Seleccionar todas las imágenes con la clase TERCERA_imagen
      const imagenes = document.querySelectorAll(".TERCERA_imagen");

      // Añadir event listeners a cada imagen
      imagenes.forEach((imagen) => {
        imagen.addEventListener("load", this.imagenCargada);
        imagen.addEventListener("error", this.errorCargaImagen);

        // Añadir lazy loading
        if ("loading" in HTMLImageElement.prototype) {
          imagen.loading = "lazy";
        }
      });

      // Inicializar observador de intersección para lazy loading en navegadores que no lo soportan nativamente
      this.initLazyLoading();
    },

    imagenCargada: function (event) {
      const imagen = event.target;
      imagen.classList.add("TERCERA_imagen_cargada");

      // Aplicar animación de fade in
      imagen.style.opacity = "0";
      setTimeout(() => {
        imagen.style.transition = "opacity 0.3s ease-in";
        imagen.style.opacity = "1";
      }, 50);
    },

    errorCargaImagen: function (event) {
      const imagen = event.target;
      imagen.classList.add("TERCERA_imagen_error");

      // Reemplazar con imagen de error por defecto
      imagen.src = "/ruta/a/imagen-error.svg";
      console.error("Error al cargar la imagen:", imagen.dataset.originalSrc);
    },

    initLazyLoading: function () {
      if ("IntersectionObserver" in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const img = entry.target;
              this.cargarImagen(img);
              observer.unobserve(img);
            }
          });
        });

        document
          .querySelectorAll(".TERCERA_imagen[data-src]")
          .forEach((img) => {
            imageObserver.observe(img);
          });
      }
    },

    cargarImagen: function (imagen) {
      if (imagen.dataset.src) {
        imagen.src = imagen.dataset.src;
        delete imagen.dataset.src;
      }
    },

    // Función para redimensionar imágenes si es necesario
    redimensionarImagen: function (imagen) {
      const maxWidth = imagen.dataset.resizeWidth || 537; // Ancho máximo de la imagen

      if (imagen.naturalWidth > maxWidth) {
        const aspect = imagen.naturalHeight / imagen.naturalWidth;
        imagen.style.width = `${maxWidth}px`;
        imagen.style.height = `${Math.round(maxWidth * aspect)}px`;
      }
    },

    // Función para manejar las formas y colores de la imagen
    aplicarForma: function (imagen) {
      if (imagen.dataset.shape) {
        const shape = imagen.dataset.shape;
        const colors = imagen.dataset.shapeColors?.split(";") || [];

        // Aplicar forma y colores según los datos del atributo
        imagen.style.clipPath = this.obtenerForma(shape);
        if (colors[0]) {
          imagen.style.backgroundColor = colors[0];
        }
      }
    },

    obtenerForma: function (shape) {
      const formas = {
        pattern_point:
          "polygon(0% 0%, 100% 0%, 100% 75%, 75% 75%, 75% 100%, 50% 75%, 0% 75%)",
        // Añadir más formas según sea necesario
      };
      return formas[shape] || "";
    },
  };

  TERCERA_manejadorImagenes.init();

  // Manejar cambios de tamaño de ventana
  window.addEventListener("resize", () => {
    const imagenes = document.querySelectorAll(".TERCERA_imagen");
    imagenes.forEach((imagen) => {
      TERCERA_manejadorImagenes.redimensionarImagen(imagen);
    });
  });

  const styleSheet = document.createElement("style");
  // styleSheet.textContent = estilos;
  document.head.appendChild(styleSheet);

  document.querySelectorAll(".accordion-button").forEach((button) => {
    button.addEventListener("click", () => {
      button.classList.toggle("active");
    });
  });

  ///carrusel
  // Inicializar el carrusel cuando el DOM esté cargado

  const carouselElement = document.querySelector(".carousel");
 
  // Seleccionar los elementos necesarios
  const carousel = document.querySelector(".carousel-inner");
  const items = document.querySelectorAll(".carousel-item");
  const prevButton = document.querySelector(".carousel-button.prev");
  const nextButton = document.querySelector(".carousel-button.next");

  // Variables de control
  let currentIndex = 0;
  const totalItems = items.length;

  // Función para mostrar el siguiente slide
  function showNextSlide() {
    currentIndex = (currentIndex + 1) % totalItems;
    updateCarousel();
  }

  // Función para mostrar el slide anterior
  function showPrevSlide() {
    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
    updateCarousel();
  }

  // Función para actualizar la posición del carrusel
  function updateCarousel() {
    const offset = -currentIndex * 100;
    carousel.style.transform = `translateX(${offset}%)`;
  }

  // Añadir event listeners a los botones
  nextButton.addEventListener("click", showNextSlide);
  prevButton.addEventListener("click", showPrevSlide);

  // Inicializar el carrusel
  updateCarousel();

  // Añade esto si quieres que el carrusel se mueva automáticamente
  function startAutoplay(interval = 3000) {
    setInterval(showNextSlide, interval);
  }

  // Llama a esta función para iniciar el autoplay
  // startAutoplay();

  // Añade esto si quieres permitir la navegación con las flechas del teclado
  document.addEventListener("keydown", (e) => {
    if (e.key === "ArrowLeft") {
      showPrevSlide();
    } else if (e.key === "ArrowRight") {
      showNextSlide();
    }
  });

 });

//  sonido del boton

function playSound() {
  var audio = document.getElementById("sonido");
  audio.play();
}

// ++section
// Progress bars animation
function animateProgressBars() {
  const progressBars = document.querySelectorAll('.progress-bar');
  progressBars.forEach(bar => {
    const target = bar.getAttribute('data-progress');
    bar.style.width = target + '%';
  });
}

// Quotes rotation
const quotes = [
  {text: "El éxito no es final, el fracaso no es fatal: es el coraje para continuar lo que cuenta.", author: "Winston Churchill"},
  {text: "El único modo de hacer un gran trabajo es amar lo que haces.", author: "Steve Jobs"},
  {text: "Todo lo que puedas imaginar es real.", author: "Pablo Picasso"},
  {text: "La mejor manera de predecir el futuro es crearlo.", author: "Peter Drucker"}
];

let currentQuote = 0;
function rotateQuotes() {
  const quoteText = document.getElementById('quote-text');
  const quoteAuthor = document.getElementById('quote-author');
  
  currentQuote = (currentQuote + 1) % quotes.length;
  
  quoteText.style.opacity = 0;
  quoteAuthor.style.opacity = 0;
  
  setTimeout(() => {
    quoteText.textContent = quotes[currentQuote].text;
    quoteAuthor.textContent = "- " + quotes[currentQuote].author;
    quoteText.style.opacity = 1;
    quoteAuthor.style.opacity = 1;
  }, 500);
}

document.addEventListener('DOMContentLoaded', () => {
  animateProgressBars();
  setInterval(rotateQuotes, 5000);
  

  
   // Animate progress bars on scroll
   const observer = new IntersectionObserver((entries) => {
     entries.forEach(entry => {
       if (entry.isIntersecting) {
         animateProgressBars();
       }
     });
   });
   
   observer.observe(document.querySelector('.growth-section'));
 });



 
// formulario 
document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('form');
  
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validar el formulario antes de enviar
      if (!validateForm()) {
          return;
      }
      
      // Crear objeto FormData
      const formData = new FormData(form);
      
      // Enviar datos usando fetch
      fetch('form-handler.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              // Mostrar mensaje de éxito
              showMessage(data.message, 'success');
              form.reset();
          } else {
              // Mostrar mensaje de error
              showMessage(data.message, 'error');
          }
      })
      .catch(error => {
          showMessage('Error al enviar el formulario', 'error');
          console.error('Error:', error);
      });
  });
  
  function validateForm() {
      let isValid = true;
      
      // Validar nombre
      const nombre = document.getElementById('nombre');
      if (nombre.value.trim() === '') {
          showError(nombre, 'El nombre es obligatorio');
          isValid = false;
      }
      
      // Validar email
      const email = document.getElementById('email');
      if (!isValidEmail(email.value)) {
          showError(email, 'Email no válido');
          isValid = false;
      }
      
      // Validar teléfono
      const telefono = document.getElementById('telefono');
      if (!telefono.value.match(/^[0-9]{9}$/)) {
          showError(telefono, 'Teléfono debe tener 9 dígitos');
          isValid = false;
      }
      
      // Validar edad
      const edad = document.getElementById('edad');
      if (edad.value < 18 || edad.value > 120) {
          showError(edad, 'La edad debe estar entre 18 y 120 años');
          isValid = false;
      }
      
      // Validar términos
      const terminos = document.getElementById('terminos');
      if (!terminos.checked) {
          showError(terminos, 'Debes aceptar los términos y condiciones');
          isValid = false;
      }
      
      return isValid;
  }
  
  function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }
  
  function showError(input, message) {
      // Eliminar mensaje de error anterior si existe
      const existingError = input.parentElement.querySelector('.error-message');
      if (existingError) {
          existingError.remove();
      }
      
      // Crear y mostrar nuevo mensaje de error
      const errorDiv = document.createElement('div');
      errorDiv.className = 'error-message';
      errorDiv.textContent = message;
      input.parentElement.appendChild(errorDiv);
  }
  
  function showMessage(message, type) {
      // Eliminar mensaje anterior si existe
      const existingMessage = document.querySelector('.message');
      if (existingMessage) {
          existingMessage.remove();
      }
      
      // Crear y mostrar nuevo mensaje
      const messageDiv = document.createElement('div');
      messageDiv.className = `message ${type}-message`;
      messageDiv.textContent = message;
      form.insertBefore(messageDiv, form.firstChild);
      
      // Eliminar mensaje después de 5 segundos
      setTimeout(() => {
          messageDiv.remove();
      }, 5000);
  }
});
// formulario

  const form = document.querySelector('form');
  
  form.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validar el formulario antes de enviar
      if (!validateForm()) {
          return;
      }
      
      // Crear objeto FormData
      const formData = new FormData(form);
      
      // Enviar datos usando fetch
      fetch('form-handler.php', {
          method: 'POST',
          body: formData
      })
      .then(response => {
          // Primero verificamos si la respuesta es OK
          if (!response.ok) {
              throw new Error(`HTTP error! status: ${response.status}`);
          }
          // Intentamos parsear la respuesta como JSON
          return response.text().then(text => {
              try {
                  return JSON.parse(text);
              } catch (e) {
                  console.error('Error parsing JSON:', text);
                  throw new Error('Respuesta del servidor no válida: ' + text);
              }
          });
      })
      .then(data => {
          if (data.success) {
              showMessage(data.message, 'success');
              form.reset();
          } else {
              showMessage(data.message || 'Error en el servidor', 'error');
          }
      })
      .catch(error => {
          showMessage('Error al enviar el formulario: ' + error.message, 'error');
          console.error('Error completo:', error);
      });
  });
  
  function validateForm() {
    let isValid = true;
    
    // Validar nombre
    const nombre = document.getElementById('nombre');
    if (nombre.value.trim() === '') {
        showError(nombre, 'El nombre es obligatorio');
        isValid = false;
    }
    
    // Validar email
    const email = document.getElementById('email');
    if (!isValidEmail(email.value)) {
        showError(email, 'Email no válido');
        isValid = false;
    }
    
    // Validar teléfono
    const telefono = document.getElementById('telefono');
    if (!telefono.value.match(/^[0-9]{9}$/)) {
        showError(telefono, 'Teléfono debe tener 9 dígitos');
        isValid = false;
    }
    
    // Validar edad
    const edad = document.getElementById('edad');
    if (edad.value < 18 || edad.value > 120) {
        showError(edad, 'La edad debe estar entre 18 y 120 años');
        isValid = false;
    }
    
    // Validar términos
    const terminos = document.getElementById('terminos');
    if (!terminos.checked) {
        showError(terminos, 'Debes aceptar los términos y condiciones');
        isValid = false;
    }
    
    return isValid;
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showError(input, message) {
    // Eliminar mensaje de error anterior si existe
    const existingError = input.parentElement.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Crear y mostrar nuevo mensaje de error
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.textContent = message;
    input.parentElement.appendChild(errorDiv);
}

function showMessage(message, type) {
    // Eliminar mensaje anterior si existe
    const existingMessage = document.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Crear y mostrar nuevo mensaje
    const messageDiv = document.createElement('div');
    messageDiv.className = `message ${type}-message`;
    messageDiv.textContent = message;
    form.insertBefore(messageDiv, form.firstChild);
    
    // Eliminar mensaje después de 5 segundos
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}
////////////particulas fondo abajo
const canvas = document.getElementById('particleCanvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const particles = [];
const particleCount = 150;

class Particle {
  constructor() {
    this.x = Math.random() * canvas.width;
    this.y = Math.random() * canvas.height;
    this.size = Math.random() * 3 + 1;
    this.speedX = Math.random() * 3 - 1.5;
    this.speedY = Math.random() * 3 - 1.5;
    this.color = `rgba(255, 255, 255, ${Math.random() * 0.7 + 0.7})`;
  }

  update() {
    this.x += this.speedX;
    this.y += this.speedY;

    if (this.size > 0.2) this.size -= 0.1;

    if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
    if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
  }

  draw() {
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fill();
  }
}

function init() {
  for (let i = 0; i < particleCount; i++) {
    particles.push(new Particle());
  }
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  for (let i = 0; i < particles.length; i++) {
    particles[i].update();
    particles[i].draw();
  }
  requestAnimationFrame(animate);
}

init();
animate();

window.addEventListener('resize', () => {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  init();
});