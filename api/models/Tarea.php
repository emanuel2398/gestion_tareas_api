<?php
namespace Models;

use Exception;

class Tarea
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function deleteTarea($idtarea)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM tarea WHERE idtarea = ?');
            $stmt->execute([$idtarea]);
            $count = $stmt->fetchColumn();
            
            if ($count == 0) throw new Exception('La tarea no existe.', 404);

            $stmt = $this->pdo->prepare('DELETE FROM tarea WHERE idtarea = ?');
            return $stmt->execute([$idtarea]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
    public function updateTareas()
    {
        $stmt = $this->pdo->prepare('UPDATE tarea SET tarea_finalizada = 1 WHERE fecha_hora_modificacion < DATE_SUB(NOW(), INTERVAL 100 DAY)');
        return $stmt->execute();
    }
}
