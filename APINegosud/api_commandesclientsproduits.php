<?php
header("Content-Type: application/json");
require_once "functions_commandesclientsproduits.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($requestMethod) {
    case 'GET':
        if ($id) getCommandeProduitById($id); else getAllCommandesProduits();
        break;
    case 'POST':
        addCommandeProduit();
        break;
    case 'PUT':
        if ($id) updateCommandeProduit($id);
        break;
    case 'DELETE':
        if ($id) deleteCommandeProduit($id);
        break;
    default:
        echo json_encode(["message" => "Méthode non supportée"]);
    }
?>