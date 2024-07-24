<?php
namespace Models;

class Tarea
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function deleteTask($idtarea)
    {
        $stmt = $this->pdo->prepare('DELETE FROM tarea WHERE idtarea = ?');
        return $stmt->execute([$idtarea]);
    }

    public function updateTasks()
    {
        $stmt = $this->pdo->prepare('UPDATE tarea SET tarea_finalizada = 1 WHERE fecha_hora_modificacion < DATE_SUB(NOW(), INTERVAL 100 DAY)');
        return $stmt->execute();
    }
}
