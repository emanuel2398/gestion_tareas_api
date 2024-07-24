<?php
namespace Controllers;

use Config\Database;
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
        $usuarioModel = new Usuario($this->db);
        $usuarios = $usuarioModel->getActiveUsers();

        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }

    public function desactivaUsuario()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['idusuario'])) {
            $usuarioModel = new Usuario($this->db);
            if ($usuarioModel->deactivateUser($input['idusuario'])) {
                header('Content-Type: application/json');
                echo json_encode(['message' => 'Usuario desactivado con éxito.']);
            } else {
                http_response_code(500);
                echo json_encode(['message' => 'Error al desactivar el usuario.']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Parámetro idusuario faltante.']);
        }
    }
}
