<?php
header("Content-Type: application/json");
require_once "functions_cepages.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        $response = getCepages($pdo);
        break;
    case 'POST':
        $response = addCepage($pdo, $input);
        break;
    case 'PUT':
        $response = updateCepage($pdo, $input);
        break;
    case 'DELETE':
        $response = deleteCepage($pdo, $input);
        break;
    default:
        $response = ["success" => false, "message" => "Méthode non autorisée"];
}

echo json_encode($response);
?>
