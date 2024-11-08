<?php
require_once '../banco/db.php';
require_once '../controller/alunoController.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new UserController($pdo);

$router->add('GET', '/aluno', [$controller, 'list']);
$router->add('GET', '/aluno/{id}', [$controller, 'getById']);
$router->add('POST', '/aluno', [$controller, 'create']);
$router->add('DELETE', '/aluno/{id}', [$controller, 'delete']);
$router->add('PUT', '/aluno/{id}', [$controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);