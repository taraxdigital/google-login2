
document.addEventListener("DOMContentLoaded", function () {


document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', () => {
      button.classList.toggle('active');
    });
  });


//ult- alimentación¡¡¡¡PESAS   si lo quito TAMPOCO FUNCIONA EL DESPLEGABLEEEE!!!!!!!!!! DE ALIMENTACION
const modal = document.getElementById('imageModal');
const modalTrigger = document.getElementById('modalTrigger');
const closeButton = document.querySelector('.close-modal');

modalTrigger.addEventListener('click', () => {
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
});

function closeModal() {
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

closeButton.addEventListener('click', closeModal);

modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        closeModal();
    }
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.classList.contains('active')) {
        closeModal();
    }
});

})
/////////imagen spin abajo
// Selecciona la imagen
const spinningImage = document.querySelector('.spin img');

// Crea la animación usando GSAP
gsap.to(spinningImage, {
  rotation: 720, // Rota 720 grados (2 vueltas completas)
  duration: 5, // Duración de la animación en segundos
  repeat: 0, // No repetir la animación
  ease: "linear" // Easing lineal para una rotación suave
});