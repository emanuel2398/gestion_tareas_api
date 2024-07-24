<?php
namespace Controllers;

use Config\Database;
use Exception;
use Models\Usuario;

class UsuarioController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function getUsuarios()
    {
        $usuario = new Usuario($this->db);
        $usuarios = $usuario->getActiveUsers();

        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }

    public function desactivaUsuario()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
    
            if (!isset($input['idusuario'])) {
                throw new Exception('Parámetro idusuario faltante.', 400);
            }
    
            $usuario = new Usuario($this->db);
    
            if ($usuario->deactivateUser($input['idusuario'])) {
                header('Content-Type: application/json');
                echo json_encode(['mensaje' => 'Usuario desactivado con éxito.']);
            } else {
                throw new Exception('Error al desactivar el usuario.', 500);
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            header('Content-Type: application/json');
            echo json_encode(['mensaje' => $e->getMessage()]);
        }
    }
    
}
