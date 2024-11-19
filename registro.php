<?php
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

// Recibir datos del formulario
$input = json_decode(file_get_contents('php://input'), true);
$email = $conn->real_escape_string($input['email']);
$password = $input['password'];

// Consulta preparada para prevenir inyección SQL
$stmt = $conn->prepare("SELECT id, password_hash FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'success' => false, 
        'message' => 'Usuario no encontrado'
    ]);
    exit;
}

$usuario = $result->fetch_assoc();

// Verificar contraseña
if (password_verify($password, $usuario['password_hash'])) {
    // Iniciar sesión
    session_start();
    $_SESSION['user_id'] = $usuario['id'];
    $_SESSION['logged_in'] = true;

    // Generar token de sesión
    $token = bin2hex(random_bytes(16));
    
    // Guardar token en base de datos
    $stmt = $conn->prepare("INSERT INTO sesiones (user_id, token) VALUES (?, ?)");
    $stmt->bind_param("is", $usuario['id'], $token);
    $stmt->execute();

    echo json_encode([
        'success' => true, 
        'message' => 'Inicio de sesión exitoso',
        'token' => $token
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Contraseña incorrecta'
    ]);
}

$stmt->close();
$conn->close();
