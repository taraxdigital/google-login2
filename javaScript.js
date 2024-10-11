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
  