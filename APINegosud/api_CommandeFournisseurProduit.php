<?php
header("Content-Type: application/json");
require_once("functions_CommandeFournisseurProduit.php");


$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);

switch ($requestMethod) {
    case 'GET':
        if ($id) getCommandeFournisseurProduitById($id);
        else getAllCommandesFournisseursProduits();
        break;
    case 'POST':
        addCommandeFournisseurProduit();
        break;
    case 'PUT':
        if ($id) updateCommandeFournisseurProduit($id);
        break;
    case 'DELETE':
        if ($id) deleteCommandeFournisseurProduit($id);
        break;
    default:
        echo json_encode(["message" => "Méthode non supportée"]);
}

echo json_encode($response);
?>