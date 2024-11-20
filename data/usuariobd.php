<?php
// data/usuariobd.php

class UsuarioBD {
    private $conexion;
    
    public function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=localhost;dbname=cancion', 'root', '');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    public function login($email, $password) {
        try {
            // Verificar si el usuario existe y no está bloqueado
            $stmt = $this->conexion->prepare('SELECT id, email, password_hash, intentos_fallidos, bloqueado_hasta, activo FROM usuarios WHERE email = ?');
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                return ['success' => false, 'message' => 'Credenciales inválidas'];
            }

            // Verificar si la cuenta está activa
            if (!$usuario['activo']) {
                return ['success' => false, 'message' => 'La cuenta no está activa'];
            }

            // Verificar si la cuenta está bloqueada
            if ($usuario['bloqueado_hasta'] !== null && new DateTime($usuario['bloqueado_hasta']) > new DateTime()) {
                return ['success' => false, 'message' => 'La cuenta está temporalmente bloqueada'];
            }

            // Verificar la contraseña
            if (password_verify($password, $usuario['password_hash'])) {
                // Resetear intentos fallidos
                $stmt = $this->conexion->prepare('UPDATE usuarios SET intentos_fallidos = 0, ultimo_login = CURRENT_TIMESTAMP WHERE id = ?');
                $stmt->execute([$usuario['id']]);

                // Crear sesión
                $sessionId = bin2hex(random_bytes(32));
                $stmt = $this->conexion->prepare('INSERT INTO sesiones (id, usuario_id, ip_address, user_agent) VALUES (?, ?, ?, ?)');
                $stmt->execute([
                    $sessionId,
                    $usuario['id'],
                    $_SERVER['REMOTE_ADDR'],
                    $_SERVER['HTTP_USER_AGENT']
                ]);

                return [
                    'success' => true,
                    'message' => 'Login exitoso',
                    'usuario_id' => $usuario['id'],
                    'session_id' => $sessionId
                ];
            } else {
                // Incrementar intentos fallidos
                $intentos = $usuario['intentos_fallidos'] + 1;
                $bloqueado_hasta = null;

                if ($intentos >= 5) {
                    $bloqueado_hasta = (new DateTime())->modify('+30 minutes')->format('Y-m-d H:i:s');
                    $intentos = 0;
                }

                $stmt = $this->conexion->prepare('UPDATE usuarios SET intentos_fallidos = ?, bloqueado_hasta = ? WHERE id = ?');
                $stmt->execute([$intentos, $bloqueado_hasta, $usuario['id']]);

                return ['success' => false, 'message' => 'Credenciales inválidas'];
            }
        } catch(PDOException $e) {
            return ['success' => false, 'message' => 'Error en el servidor'];
        }
    }

    public function registro($email, $password) {
        try {
            // Verificar si el email ya existe
            $stmt = $this->conexion->prepare('SELECT id FROM usuarios WHERE email = ?');
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                return ['success' => false, 'message' => 'El email ya está registrado'];
            }

            // Crear el hash de la contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar nuevo usuario
            $stmt = $this->conexion->prepare('INSERT INTO usuarios (email, password_hash, activo) VALUES (?, ?, 1)');
            $stmt->execute([$email, $password_hash]);

            return ['success' => true, 'message' => 'Usuario registrado exitosamente'];
        } catch(PDOException $e) {
            return ['success' => false, 'message' => 'Error en el servidor'];
        }
    }

    public function recuperarPassword($email) {
        try {
            $stmt = $this->conexion->prepare('SELECT id, email FROM usuarios WHERE email = ?');
            $stmt->execute([$email]);
            
            if ($usuario = $stmt->fetch()) {
                // Generar token de recuperación
                $token = bin2hex(random_bytes(32));
                $expiracion = (new DateTime())->modify('+1 hour')->format('Y-m-d H:i:s');

                $stmt = $this->conexion->prepare('UPDATE usuarios SET token_recuperacion = ?, token_expiracion = ? WHERE id = ?');
                $stmt->execute([$token, $expiracion, $usuario['id']]);

                // Aquí deberías agregar la lógica para enviar el email
                // Por ahora solo retornamos éxito
                return ['success' => true, 'message' => 'Se ha enviado un enlace de recuperación a tu email'];
            }

            return ['success' => false, 'message' => 'Email no encontrado'];
        } catch(PDOException $e) {
            return ['success' => false, 'message' => 'Error en el servidor'];
        }
    }

    public function cerrarSesion($sessionId) {
        try {
            $stmt = $this->conexion->prepare('DELETE FROM sesiones WHERE id = ?');
            $stmt->execute([$sessionId]);
            return ['success' => true];
        } catch(PDOException $e) {
            return ['success' => false, 'message' => 'Error al cerrar sesión'];
        }
    }
}