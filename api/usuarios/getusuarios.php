<?php
// api/usuarios/getusuarios.php

require_once __DIR__ . '/../../config/database.php';

$stmt = $pdo->query('SELECT * FROM usuario WHERE activo = 1');
$usuarios = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($usuarios);