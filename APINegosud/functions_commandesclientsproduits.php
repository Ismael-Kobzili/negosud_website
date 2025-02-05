<?php
require_once "config.php";

// Récupérer toutes les commandes de produits
function getAllCommandesProduits() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM commandesclientsproduits");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// Récupérer une commande de produit par ID
function getCommandeProduitById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM commandesclientsproduits WHERE Id_CommandesClientsProduits = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}

// Ajouter une nouvelle commande de produit
function addCommandeProduit() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO commandesclientsproduits (IDCommandeProduit, IDCommandesClients, IDProduit, Quantite, PrixUnitaire) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$data['IDCommandeProduit'], $data['IDCommandesClients'], $data['IDProduit'], $data['Quantite'], $data['PrixUnitaire']]);
    echo json_encode(["message" => "Commande produit ajoutée avec succès"]);
}

// Mettre à jour une commande de produit
function updateCommandeProduit($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("UPDATE commandesclientsproduits SET IDCommandeProduit=?, IDCommandesClients=?, IDProduit=?, Quantite=?, PrixUnitaire=? WHERE Id_CommandesClientsProduits=?");
    $stmt->execute([$data['IDCommandeProduit'], $data['IDCommandesClients'], $data['IDProduit'], $data['Quantite'], $data['PrixUnitaire'], $id]);
    echo json_encode(["message" => "Commande produit mise à jour"]);
}

// Supprimer une commande de produit
function deleteCommandeProduit($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM commandesclientsproduits WHERE Id_CommandesClientsProduits = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "Commande produit supprimée"]);
}

// Routing simple
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = explode("/", $_SERVER["REQUEST_URI"]);
$id = isset($requestUri[2]) ? (int) $requestUri[2] : null;
?>
