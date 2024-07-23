<?php
// api/usuarios/desactivausuario.php

require_once __DIR__ . '/../../config/database.php';

// Verifica que la solicitud sea PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Lee el contenido de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Verifica que el parámetro 'idusuario' esté presente
    if (isset($input['idusuario'])) {
        $idusuario = $input['idusuario'];

        // Prepara y ejecuta la consulta
        $stmt = $pdo->prepare('UPDATE usuario SET activo = 0 WHERE idusuario = ?');
        if ($stmt->execute([$idusuario])) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Usuario desactivado con éxito.']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Error al desactivar el usuario.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Parametro idusuario faltante.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido.']);
}
?>
