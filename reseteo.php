<?php

//////////////////reseteo //////////////////////abajo

// reset-password.php
$token = $_GET['token'] ?? null;

if (!$token) {
    die("Token no proporcionado");
}

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'cancion';

// Conectar a la base de datos
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar token
$stmt = $conn->prepare("SELECT id, email FROM usuarios WHERE token_recuperacion = ? AND token_expiracion > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Token inválido o expirado");
}

$usuario = $result->fetch_assoc();

////////////////procesamiento de reseteo///////////

header('Content-Type: application/json');

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'cancion';

// Conectar a la base de datos
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die(json_encode([
        'success' => false, 
        'message' => 'Error de conexión a la base de datos'
    ]));
}

// Recibir datos
$input = json_decode(file_get_contents('php://input'), true);
$token = $conn->real_escape_string($input['token']);
$newPassword = $input['newPassword'];

// Validar contraseña
if (strlen($newPassword) < 8) {
    echo json_encode([
        'success' => false, 
        'message' => 'La contraseña debe tener al menos 8 caracteres'
    ]);
    exit;
}

// Verificar token
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_recuperacion = ? AND token_expiracion > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'success' => false, 
        'message' => 'Token inválido o expirado'
    ]);
    exit;
}

// Hash de nueva contraseña
$password_hash = password_hash($newPassword, PASSWORD_BCRYPT);

// Actualizar contraseña y limpiar token
$stmt = $conn->prepare("UPDATE usuarios SET password_hash = ?, token_recuperacion = NULL, token_expiracion = NULL WHERE token_recuperacion = ?");
$stmt->bind_param("ss", $password_hash, $token);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true, 
        'message' => 'Contraseña restablecida exitosamente'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Error al restablecer contraseña'
    ]);
}

$stmt->close();
$conn->close();