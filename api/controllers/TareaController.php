<?php
namespace Controllers;

use Config\Database;
use Models\Tarea;

class TareaController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function eliminarTarea()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['idtarea'])) {
            $tareaModel = new Tarea($this->db);
            if ($tareaModel->deleteTask($input['idtarea'])) {
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
    }

    public function actualizarTareas()
    {
        $tareaModel = new Tarea($this->db);

        if ($tareaModel->updateTasks()) {
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Tareas actualizadas con éxito.']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'Error al actualizar las tareas.']);
        }
    }
}
