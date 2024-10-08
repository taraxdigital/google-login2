<div class="logo-container">
        <img class="logo" src="img/BLANCO.png" alt="Logo de la empresa" />
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
        <!-- <i class="fa-solid fa-bars"></i> -->
      </div>
    </header>