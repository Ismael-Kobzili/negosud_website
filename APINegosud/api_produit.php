<?php
header("Content-Type: application/json");
require_once "functions_produits.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        $response = getProduits($pdo);
        break;
    case 'POST':
        $response = addProduits($pdo, $input);
        break;
    case 'PUT':
        $response = updateProduits($pdo, $input);
        break;
    case 'DELETE':
        $response = deleteProduits($pdo, $input);
        break;
    default:
        $response = ["success" => false, "message" => "Méthode non autorisée"];
}

echo json_encode($response);
?>
