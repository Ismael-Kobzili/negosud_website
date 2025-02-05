<?php
header("Content-Type: application/json");
require_once "functions_clients.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        $response = getClients($pdo);
        break;
    case 'POST':
        $response = addClient($pdo, $input);
        break;
    case 'PUT':
        $response = updateClient($pdo, $input);
        break;
    case 'DELETE':
        $response = deleteClient($pdo, $input);
        break;
    default:
        $response = ["success" => false, "message" => "Méthode non autorisée"];
}

echo json_encode($response);
?>