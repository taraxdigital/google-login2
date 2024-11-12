const video = document.getElementById('myVideo');

video.addEventListener('play', () => {
    video.style.width = '640px'; // Ajusta el ancho según tus preferencias
    video.style.height = 'auto'; // Mantiene la proporción del video
});

video.addEventListener('pause', () => {
    video.style.width = '320px';
    video.style.height = '240px';
});