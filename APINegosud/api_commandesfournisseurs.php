<?php
header("Content-Type: application/json");
require_once "functions_commandesfournisseurs.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($requestMethod) {
    case 'GET':
        if ($id) getCommandeFournisseurById($id); 
        else getAllCommandesFournisseurs();
        break;
    case 'POST':
        addCommandeFournisseur();
        break;
    case 'PUT':
        if ($id) updateCommandeFournisseur($id);
        break;
    case 'DELETE':
        if ($id) deleteCommandeFournisseur($id);
        break;
    default:
        echo json_encode(["message" => "Méthode non supportée"]);
    }

?>