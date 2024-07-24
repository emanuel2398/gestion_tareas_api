<?php
namespace Models;

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getActiveUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM usuario WHERE activo = 1');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deactivateUser($idusuario)
    {
        $stmt = $this->pdo->prepare('UPDATE usuario SET activo = 0 WHERE idusuario = ?');
        return $stmt->execute([$idusuario]);
    }
}
