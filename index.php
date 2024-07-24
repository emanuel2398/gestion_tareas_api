<?php
require_once __DIR__ . '/api/config/Database.php';
require_once __DIR__ . '/api/config/Routes.php';
require_once __DIR__ . '/api/config/Request.php';
require_once __DIR__ . '/api/controllers/UsuarioController.php';
require_once __DIR__ . '/api/controllers/TareaController.php';
require_once __DIR__ . '/vendor/autoload.php';

// Crear instancia del enrutador
$router = new Config\Routes();

// Definir rutas
$router->get('/usuarios/getusuarios', [new Controllers\UsuarioController(), 'getUsuarios']);
$router->put('/usuarios/desactivarusuario', [new Controllers\UsuarioController(), 'desactivaUsuario']);
$router->delete('/tareas/eliminartarea', [new Controllers\TareaController(), 'eliminarTarea']);
$router->post('/tareas/actualizartareas', [new Controllers\TareaController(), 'actualizarTareas']);

// Resolver la solicitud
$router->resolve();