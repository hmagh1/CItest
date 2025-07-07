<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\UserController;

header('Content-Type: application/json');

$controller = new UserController();
$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

parse_str(file_get_contents("php://input"), $putData);

if ($path === '/users' && $method === 'GET') {
    echo $controller->getAllUsers();
} elseif (preg_match('#^/users/(\d+)$#', $path, $matches)) {
    $id = (int)$matches[1];
    if ($method === 'GET') {
        echo $controller->getUser($id);
    } elseif ($method === 'PUT') {
        echo $controller->updateUser($id, $putData['name'], $putData['email']);
    } elseif ($method === 'DELETE') {
        echo $controller->deleteUser($id);
    }
} elseif ($path === '/users' && $method === 'POST') {
    echo $controller->createUser($_POST['name'], $_POST['email']);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route not found"]);
}
