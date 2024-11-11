<?php
// Asegurarse de que no se muestren errores en la salida
error_reporting(0);
ini_set('display_errors', 0);

include_once 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $edad = $_POST['edad'] ?? '';
        $servicio = $_POST['ocupacion'] ?? '';
        
        // Validar datos
        if (empty($nombre) || empty($email) || empty($telefono) || empty($edad) || empty($servicio)) {
            throw new Exception('Todos los campos son obligatorios');
        }
        
        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email no válido');
        }
        
        // Crear instancia de PHPMailer
        $mail = new PHPMailer(true);
        
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;  // Cambia esto según tu servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USER; // Tu correo
        $mail->Password   = MAIL_PASS; // Tu contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Configuración del correo
        $mail->setFrom($email, $nombre);
        $mail->addAddress(MAIL_USER); // Correo destino
        $mail->addReplyTo($email, $nombre);
        
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->Subject = "Nuevo formulario de contacto";
        
        // Crear mensaje HTML
        $messageHTML = "
        <h2>Nuevo mensaje del formulario de contacto</h2>
        <p><strong>Nombre:</strong> $nombre</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Teléfono:</strong> $telefono</p>
        <p><strong>Edad:</strong> $edad</p>
        <p><strong>Servicio solicitado:</strong> $servicio</p>
        ";
        
        // Versión texto plano
        $messagePlain = "Nuevo mensaje del formulario de contacto:\n\n";
        $messagePlain .= "Nombre: " . $nombre . "\n";
        $messagePlain .= "Email: " . $email . "\n";
        $messagePlain .= "Teléfono: " . $telefono . "\n";
        $messagePlain .= "Edad: " . $edad . "\n";
        $messagePlain .= "Servicio solicitado: " . $servicio . "\n";
        
        $mail->Body    = $messageHTML;
        $mail->AltBody = $messagePlain;
        
        // Enviar email
        if ($mail->send()) {
            echo json_encode([
                'success' => true, 
                'message' => '¡Mensaje enviado con éxito!'
            ]);
        } else {
            throw new Exception('Error al enviar el mensaje');
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
            'debug' => error_get_last()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}

exit;
?>