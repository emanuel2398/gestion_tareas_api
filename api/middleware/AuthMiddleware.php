<?php
namespace Middleware;

use Dotenv\Dotenv;

class AuthMiddleware
{
    private $validToken;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        $this->validToken = $_ENV['AUTH_TOKEN'];
    }
    public function handle()
    {
        $headers = getallheaders();
        if (isset($headers['Authorization']) && $headers['Authorization'] === $this->validToken) {
            return true;
        }
        http_response_code(401);
        echo json_encode(['mensaje' => 'No autorizado']);
        exit;
    }
}
