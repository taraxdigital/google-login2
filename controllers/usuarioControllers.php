<?php

session_start();

include_once '../data/usuariobd.php';

$usuarioBD = new UsuarioBD();

function redirigirConMensaje($url, $success, $mensaje){
    // Almacena el resultado en la sesión
    $_SESSION['success'] = $success;
    $_SESSION['message'] = $mensaje;

    // Realiza la redirección
    header("Location: $url");
    exit();
}

// Registro de usuario
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['registro'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $resultado = $usuarioBD->registro($email, $password);

    redirigirConMensaje('../index.php', $resultado['success'] ? 'success' : 'error', $resultado['message']);
}

// Inicio de sesión
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $resultado = $usuarioBD->login($email, $password);

    if($resultado['success']){
        $_SESSION['usuario_id'] = $resultado['usuario_id'];
        $_SESSION['session_id'] = $resultado['session_id'];
    }
    redirigirConMensaje('../index.php', $resultado['success'] ? 'success' : 'error', $resultado['message']);
}

// Recuperación de contraseña
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['recuperar'])){
    $email = $_POST['email'];

    $resultado = $usuarioBD->recuperarPassword($email);
    redirigirConMensaje('../index.php', $resultado['success'] ? 'success' : 'error', $resultado['message']);
}

// data/usuariobd.php

class UsuarioBD {
    public function login($email, $password) {
        // Lógica de autenticación
        // Devuelve un array con 'success' y 'message'
        return ['success' => true, 'usuario_id' => 1, 'session_id' => session_id(), 'message' => 'Login exitoso'];
    }

    public function registro($email, $password) {
        // Lógica de registro
        // Devuelve un array con 'success' y 'message'
        return ['success' => true, 'message' => 'Registro exitoso'];
    }

    public function recuperarPassword($email) {
        // Lógica de recuperación de contraseña
        // Devuelve un array con 'success' y 'message'
        return ['success' => true, 'message' => 'Correo de recuperación enviado'];
    }

    public function cerrarSesion($session_id) {
        // Lógica para cerrar sesión
    }
}
