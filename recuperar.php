<?php
/////////////recuperación de contraseña abajo

header('Content-Type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

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