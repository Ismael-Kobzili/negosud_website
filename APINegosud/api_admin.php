<?php
header("Content-Type: application/json");
require_once "functions_admin.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($method) {
    case 'GET':
        $response = getAdmins($pdo);
        break;
    case 'POST':
        $response = addAdmin($pdo, $input);
        break;
    case 'PUT':
        $response = updateAdmin($pdo, $input);
        break;
    case 'DELETE':
        $response = deleteAdmin($pdo, $input);
        break;
    default:
    $response = ["success" => false, "message" => "Méthode non autorisée"];
}


echo json_encode($response);
?>