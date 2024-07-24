<?php
namespace Controllers;

use Config\Database;
use Exception;
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
        try {
            $input = json_decode(file_get_contents('php://input'), true);

            if (!isset($input['idtarea'])) {
                throw new Exception('Parámetro idtarea faltante.', 400);
            }
            $tarea = new Tarea($this->db);
            if ($tarea->deleteTarea($input['idtarea'])) {
                header('Content-Type: application/json');
                echo json_encode(['mensaje' => 'Tarea eliminada con éxito.']);
            } else {
                throw new Exception('Error al eliminar la tarea.', 500);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            header('Content-Type: application/json');
            echo json_encode(['mensaje' => $e->getMessage()]);
        }
    }


    public function actualizarTareas()
    {
        try {
            $tareas = new Tarea($this->db);
            if ($tareas->updateTareas()) {
                header('Content-Type: application/json');
                echo json_encode(['mensaje' => 'Tareas actualizadas con éxito.']);
            } else {
                throw new Exception('Error al actualizar las tareas.', 500);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            header('Content-Type: application/json');
            echo json_encode(['mensaje' => $e->getMessage()]);
        }
    }
}
