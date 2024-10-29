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
];

// Función para llenar la tabla con los datos
function llenarTabla() {
    const tbody = document.getElementById('djs-tbody');
    tbody.innerHTML = ''; // Limpiar la tabla primero

    djsData.forEach(dj => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${dj.nombre}</td>
            <td>${dj.genero_musical}</td>
            <td>${dj.tema_mas_conocido || '-'}</td>
            <td>${dj.año_de_lanzamiento}</td>
            <td>${dj.biografia}</td>
            <td><img src="${dj.imagen}" alt="${dj.nombre}" class="dj-image"></td>
        `;
        tbody.appendChild(row);
    });
}

// Evento para mostrar/ocultar la tabla
document.getElementById('btnDJs').addEventListener('click', function() {
    const container = document.getElementById('djs-container');
    if (container.style.display === 'none' || container.style.display === '') {
        container.style.display = 'block';
        llenarTabla(); // Llenar la tabla cuando se muestra
    } else {
        container.style.display = 'none';
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
    captionText.innerHTML = src.split('/').pop();
}

function closeModal() {
    var modal = document.getElementById("sietemModal");
    modal.style.display = "none";
}