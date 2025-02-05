<?php
require_once "config.php";

// Récupérer toutes les commandes
function getAllCommandes() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM commandesclients");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// Récupérer une commande par ID
function getCommandeById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM commandesclients WHERE Id_CommandesClients = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}

// Ajouter une nouvelle commande
function addCommande() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO commandesclients (IDClient, DateCommande, Statut, RefCommandeClient) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data['IDClient'], $data['DateCommande'], $data['Statut'], $data['RefCommandeClient']]);
    echo json_encode(["message" => "Commande ajoutée avec succès"]);
}

// Mettre à jour une commande
function updateCommande($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("UPDATE commandesclients SET IDClient=?, DateCommande=?, Statut=?, RefCommandeClient=? WHERE Id_CommandesClients=?");
    $stmt->execute([$data['IDClient'], $data['DateCommande'], $data['Statut'], $data['RefCommandeClient'], $id]);
    echo json_encode(["message" => "Commande mise à jour"]);
}

// Supprimer une commande
function deleteCommande($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM commandesclients WHERE Id_CommandesClients = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "Commande supprimée"]);
}
// Routing simple
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = explode("/", $_SERVER["REQUEST_URI"]);
$id = isset($requestUri[2]) ? (int) $requestUri[2] : null;
?>
