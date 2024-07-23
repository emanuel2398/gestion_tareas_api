<?php
// index.php

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
// Remover el prefijo del directorio de la URI
$request = str_replace('/gestion_tareas_api', '', $request);
switch ($request) {
    case '/usuarios/getusuarios':
        //echo json_encode(['message' => 'hola']);

        require __DIR__ . '/api/usuarios/getusuarios.php';
        break;
    case '/usuarios/desactivausuario':
        if ($method == 'PUT') {
            require __DIR__ . '/api/usuarios/desactivausuario.php';
        }
        break;
    case '/tareas/eliminartarea':
        if ($method == 'DELETE') {
            require __DIR__ . '/api/tareas/eliminartarea.php';
        }
        break;
    case '/tareas/actualizartareas':
        if ($method == 'POST') {
            require __DIR__ . '/api/tareas/actualizartareas.php';
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
        break;
}
