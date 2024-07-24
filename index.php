<?php

use Config\Routes;
use Controllers\TareaController;
use Controllers\UsuarioController;
use Middleware\AuthMiddleware;
require_once __DIR__ . '/vendor/autoload.php';

$authMiddleware = new AuthMiddleware();
$authMiddleware->handle();

$router = new Routes();
$router->get('/usuarios/getusuarios', [new UsuarioController(), 'getUsuarios']);
$router->put('/usuarios/desactivarusuario', [new UsuarioController(), 'desactivaUsuario']);
$router->delete('/tareas/eliminartarea', [new TareaController(), 'eliminarTarea']);
$router->post('/tareas/actualizartareas', [new TareaController(), 'actualizarTareas']);


$router->respuesta();