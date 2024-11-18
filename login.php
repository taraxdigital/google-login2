<?php
header('Content-Type: application/json');

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'tu_usuario';
$db_pass = 'tu_contraseña';
$db_name = 'sistema_login';

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

///////////////

header('Content-Type: application/json');

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'tu_usuario';
$db_pass = 'tu_contraseña';
$db_name = 'sistema_login';

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
$nombre = $conn->real_escape_string($input['nombre']);
$email = $conn->real_escape_string($input['email']);
$password = $input['password'];

// Validaciones
function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarContraseña($password) {
    return strlen($password) >= 8;
}

if (!validarEmail($email)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Email inválido'
    ]);
    exit;
}

if (!validarContraseña($password)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Contraseña debe teneral menos 8 caracteres'
    ]);
    exit;
}

// Verificar si el email ya existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode([
        'success' => false, 
        'message' => 'El email ya está registrado'
    ]);
    exit;
}

// Hash de contraseña
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Insertar nuevo usuario
$stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password_hash, fecha_registro) VALUES (?, ?, ?, NOW())");
$stmt->bind_param("sss", $nombre, $email, $password_hash);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true, 
        'message' => 'Registro exitoso'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Error al registrar usuario'
    ]);
}

$stmt->close();
$conn->close();
/////////////recuperación de contraseña abajo
<?php
header('Content-Type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'tu_usuario';
$db_pass = 'tu_contraseña';
$db_name = 'sistema_login';

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

// Verificar si el email existe
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'success' => false, 
        'message' => 'Email no registrado'
    ]);
    exit;
}

// Generar token de recuperación
$token = bin2hex(random_bytes(32));
$expiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Guardar token en base de datos
$stmt = $conn->prepare("UPDATE usuarios SET token_recuperacion = ?, token_expiracion = ? WHERE email = ?");
$stmt->bind_param("sss", $token, $expiracion, $email);
$stmt->execute();

// Enviar email de recuperación
$mail = new PHPMailer(true);

try {
    // Configuración del servidor
    $mail->isSMTP();
    $mail->Host       = 'smtp.ejemplo.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu_email@ejemplo.com';
    $mail->Password   = 'tu_contraseña';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Configurar email
    $mail->setFrom('recuperacion@ejemplo.com', 'Sistema de Recuperación');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de Contraseña';
    $mail->Body    = "
        <h2>Recuperación de Contraseña</h2>
        <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
        <a href='https://tudominio.com/reset-password.php?token={$token}'>
            Restablecer Contraseña
        </a>
        <p>Este enlace expirará en 1 hora.</p>
    ";

    $mail->send();
    
    echo json_encode([
        'success' => true, 
        'message' => 'Enlace de recuperación enviado'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'message' => "Error al enviar email: {$mail->ErrorInfo}"
    ]);
}

$stmt->close();
$conn->close();
//////////////////reseteo //////////////////////abajo
<?php
// reset-password.php
$token = $_GET['token'] ?? null;

if (!$token) {
    die("Token no proporcionado");
}

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'tu_usuario';
$db_pass = 'tu_contraseña';
$db_name = 'sistema_login';

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


 
    function resetPassword() {
        const token = document.getElementById('token').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const messageDiv = document.getElementById('message');

        if (newPassword !== confirmPassword) {
            messageDiv.innerHTML = '<p style="color:red;">Las contraseñas no coinciden</p>';
            return false;
        }

        if (newPassword.length < 8) {
            messageDiv.innerHTML = '<p style="color:red;">La contraseña debe tener al menos 8 caracteres</p>';
            return false;
        }

        fetch('procesar-reset.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ 
                token: token, 
                newPassword: newPassword 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageDiv.innerHTML = '<p style="color:green;">Contraseña restablecida exitosamente</p>';
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 2000);
            } else {
                messageDiv.innerHTML = `<p style="color:red;">${data.message}</p>`;
            }
        })
        .catch(error => {
            messageDiv.innerHTML = '<p style="color:red;">Error de conexión</p>';
        });

        return false;
    }
 ////////////////procesamiento de reseteo///////////

header('Content-Type: application/json');

// Configuración de base de datos
$db_host = 'localhost';
$db_user = 'tu_usuario';
$db_pass = 'tu_contraseña';
$db_name = 'sistema_login';

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