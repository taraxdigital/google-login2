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



 
