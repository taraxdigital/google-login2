<?php
require_once 'config.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Verificar método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
    exit;
}

// Obtener y validar datos de entrada
// $input = json_decode(file_get_contents('php://input'), true);

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Datos incompletos'
    ]);
    exit;
}

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];

// Validar email y contraseña
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Email inválido'
    ]);
    exit;
}

if (strlen($password) < 8) {
    echo json_encode([
        'success' => false,
        'message' => 'La contraseña debe tener al menos 8 caracteres'
    ]);
    exit;
}

try {
    // Buscar usuario por email
    $stmt = $conn->prepare("SELECT id, password_hash, nombre, intentos_fallidos, bloqueado_hasta FROM usuarios WHERE email = ?");
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }
    
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Usuario no encontrado'
        ]);
        exit;
    }

    $usuario = $result->fetch_assoc();

    // Verificar si la cuenta está bloqueada
    if ($usuario['bloqueado_hasta'] !== null && strtotime($usuario['bloqueado_hasta']) > time()) {
        echo json_encode([
            'success' => false,
            'message' => 'Cuenta bloqueada temporalmente. Intente más tarde.'
        ]);
        exit;
    }

    // Verificar contraseña
    if (password_verify($password, $usuario['password_hash'])) {
        // Resetear intentos fallidos
        $stmt = $conn->prepare("UPDATE usuarios SET intentos_fallidos = 0, ultimo_login = NOW() WHERE id = ?");
        $stmt->bind_param("i", $usuario['id']);
        $stmt->execute();

        // Iniciar sesión
        session_start();
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['logged_in'] = true;

        echo json_encode([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'nombre' => $usuario['nombre']
        ]);
    } else {
        // Incrementar intentos fallidos
        $intentos = $usuario['intentos_fallidos'] + 1;
        $bloqueo = null;

        if ($intentos >= 5) {
            $bloqueo = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            $intentos = 0;
        }

        $stmt = $conn->prepare("UPDATE usuarios SET intentos_fallidos = ?, bloqueado_hasta = ? WHERE id = ?");
        $stmt->bind_param("isi", $intentos, $bloqueo, $usuario['id']);
        $stmt->execute();

        echo json_encode([
            'success' => false,
            'message' => $bloqueo ? 'Cuenta bloqueada por múltiples intentos fallidos' : 'Contraseña incorrecta'
        ]);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Error interno del servidor'
    ]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>