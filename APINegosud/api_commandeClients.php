<?php
header("Content-Type: application/json");
require_once "functions_commandeClients.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($requestMethod) {
    case 'GET':
        if ($id) getCommandeById($id); 
        else getAllCommandes();
        break;
    case 'POST':
        addCommande();
        break;
    case 'PUT':
        if ($id) updateCommande($id);
        break;
    case 'DELETE':
        if ($id) deleteCommande($id);
        break;
    default:
        return["message" => "Méthode non supportée"];

echo json_encode($response);
    }
?>