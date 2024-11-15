<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

// Conectar a la base de datos
$mysqli = new mysqli('localhost', 'root', '', 'cancion');

if ($mysqli->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

// Verificar si el email existe
$stmt = $mysqli->prepare('SELECT password_hash FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'Email no encontrado.']);
    exit;
}

$stmt->bind_result($password_hash);
$stmt->fetch();
$stmt->close();

// Verificar la contraseña
if (password_verify($password, $password_hash)) {
    // Iniciar sesión
    session_start();
    $_SESSION['email'] = $email;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta.']);
}

$mysqli->close();
?>