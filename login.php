<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {
    require __DIR__ . '/conexion.php';

    $correo = filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL);
    $clave = $_POST['contrasena'] ?? '';

    if (!$correo || $clave === '') {
        header('Location: index.php?error=credenciales');
        exit;
    }

    $stmt = $conexion->prepare('SELECT id, nombre, correo, contrasena FROM usuarios WHERE correo = ? LIMIT 1');

    if (!$stmt) {
        throw new Exception('No se pudo preparar la consulta.');
    }

    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $stmt->bind_result($id, $nombre, $correoGuardado, $hash);

    if ($stmt->fetch() && password_verify($clave, $hash)) {
        $stmt->close();
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $id;
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_correo'] = $correoGuardado;
        header('Location: dashboard.php');
        exit;
    }

    $stmt->close();
    header('Location: index.php?error=credenciales');
    exit;
} catch (Throwable $error) {
    error_log('Error en login.php: ' . $error->getMessage());
    header('Location: index.php?error=servidor');
    exit;
}
?>