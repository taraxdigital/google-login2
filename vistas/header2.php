<div class="logo-container">
        <img class="logo" src="img/ok.png" alt="Logo de la empresa" />
      </div>
      <button id="abrir" class="abrir-menu"><i class="bi bi-list"></i></button>
      <nav class="nav" id="nav">
        <button class="cerrar-menu" id="cerrar"><i class="bi bi-x"></i></button>
        <ul class="nav-list">
          <li><a href="index.php" onclick="seleccionar()">Inicio</a></li>
          <li>
            <a href="musica.php" target="_blank" onclick="seleccionar()"
              >Música</a
            >
          </li>
          <li>
            <a href="alimentacion.php" onclick="seleccionar()">Alimentación</a>
          </li>
          <li><a href="tecnologia.php" onclick="seleccionar()">Tecnología</a></li>
        </ul>
      </nav>
      <div class="nav-responsive" onclick="mostrarOcultarMenu()">

      <div class="login-container">
            <span id="userInfo"></span>
            <button id="loginButton">Login</button>
        </div>
        <div id="loginForm">
        <input type="text" id="username" placeholder="Usuario">
        <input type="password" id="password" placeholder="Contraseña">
        <button onclick="login()">Entrar</button>
    </div>
        <!-- <i class="fa-solid fa-bars"></i> -->
      </div>
    </header>
    <section>
            <div class="modal-social-links">
                <ul class="footer-section-socialmedia">
                    <!--
   -->
                    <li id="fb" class="footer-section-socialmedia-entry">
                        <a href="https://www.facebook.com" target="_blank"><i
                                class="fa-brands fa-facebook"
                                title="face"
                                aria-hidden="true"></i>
                        </a>
                    </li>
                    <!--
   -->
                    <li id="sp" class="footer-section-socialmedia-entry">
                        <a href="https://open.spotify.com" target="_blank"><i
                                class="fa-brands fa-spotify"
                                title="spotify"
                                aria-hidden="true"></i>
                        </a>
                    </li>
                    <!--
   -->
                    <li id="tw" class="footer-section-socialmedia-entry">
                        <a href="https://github.com" target="_blank"><i
                                class="fa-brands fa-github"
                                title="github"
                                aria-hidden="true"></i>
                        </a>
                    </li>
                    <!--
   -->
                    <li id="ins" class="footer-section-socialmedia-entry">
                        <a
                            href="https://www.instagram.com"
                            target="_blank"
                            style="border-radius: 0"><i class="fa-brands fa-square-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </section>