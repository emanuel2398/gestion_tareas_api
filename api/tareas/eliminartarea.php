<?php
// api/tareas/eliminartarea.php

require_once __DIR__ . '/../../config/database.php';

// Verifica que la solicitud sea DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Lee el contenido de la solicitud
    $input = json_decode(file_get_contents('php://input'), true);

    // Verifica que el parámetro 'idtarea' esté presente
    if (isset($input['idtarea'])) {
        $idtarea = $input['idtarea'];

        // Prepara y ejecuta la consulta
        $stmt = $pdo->prepare('DELETE FROM tarea WHERE idtarea = ?');
        if ($stmt->execute([$idtarea])) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Tarea eliminada con éxito.']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Error al eliminar la tarea.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Parámetro idtarea faltante.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido.']);
}
?>
