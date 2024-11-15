<?php
require_once __DIR__ . '/../src/config/db.php'; 
require_once __DIR__ . '/../src/controllers/ProfessorController.php';
require_once __DIR__ . '/../src/controllers/AlunoController.php';
require_once __DIR__ . '/../src/Router.php';

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    http_response_code(200);
    exit();
}


header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$professorController = new ProfessorController($pdo);
$alunoController = new AlunoController($pdo);

$router->add("POST", '/registrar', [$professorController, 'create']);
$router->add("POST", '/login', [$professorController, 'login']);
$router->add("PUT", '/atualizar', [$professorController, 'update']);   
$router->add("DELETE", '/deletar', [$professorController, 'delete']); 
$router->add("POST", '/usuario', [$professorController, 'findById']);
$router->add('POST', '/existente', [$professorController,'usuarioJaExiste']);



$router->add("PUT", '/aluno/notas', [$alunoController, 'updateNotas']);

$router->add("POST", '/registro', [$alunoController, 'create']);
$router->add("PUT", '/aluno/atualizar', [$alunoController, 'update']);

$router->add("DELETE", '/aluno/deletar', [$alunoController, 'delete']);
$router->add("POST", '/aluno', [$alunoController, 'getAllByUserId']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", trim($requestedPath, "/"));

if (count($pathItems) >= 1) {
    $requestedPath = "/" . $pathItems[0];
    if (count($pathItems) > 1) {
        $requestedPath .= "/" . $pathItems[1]; 
    }
} else {
    $requestedPath = "/"; 
}

$router->dispatch($requestedPath);