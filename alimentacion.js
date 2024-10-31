
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
