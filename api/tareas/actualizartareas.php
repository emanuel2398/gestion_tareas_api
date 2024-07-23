<?php
// api/tareas/actualizartareas.php

require_once __DIR__.'../../config/database.php';

$stmt = $pdo->prepare('UPDATE tarea SET tarea_finalizada = 1 WHERE fecha_hora_modificacion < DATE_SUB(NOW(), INTERVAL 100 DAY)');
$stmt->execute();

header('Content-Type: application/json');
echo json_encode(['message' => 'Tareas actualizadas con éxito.']);
