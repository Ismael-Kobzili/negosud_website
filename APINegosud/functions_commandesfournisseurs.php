<?php
require_once "config.php";

// Récupérer toutes les commandes fournisseurs
function getAllCommandesFournisseurs() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM commandesfournisseurs");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// Récupérer une commande fournisseur par ID
function getCommandeFournisseurById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM commandesfournisseurs WHERE Id_CommandesFournisseurs = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}

// Ajouter une nouvelle commande fournisseur
function addCommandeFournisseur() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO commandesfournisseurs (DateCommande, Statut, RefCommandeFournisseur, IDFournisseur) VALUES (?, ?, ?, ?)");
    $stmt->execute([$data['DateCommande'], $data['Statut'], $data['RefCommandeFournisseur'], $data['IDFournisseur']]);
    echo json_encode(["message" => "Commande fournisseur ajoutée avec succès"]);
}

// Mettre à jour une commande fournisseur
function updateCommandeFournisseur($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("UPDATE commandesfournisseurs SET DateCommande=?, Statut=?, RefCommandeFournisseur=?, IDFournisseur=? WHERE Id_CommandesFournisseurs=?");
    $stmt->execute([$data['DateCommande'], $data['Statut'], $data['RefCommandeFournisseur'], $data['IDFournisseur'], $id]);
    echo json_encode(["message" => "Commande fournisseur mise à jour"]);
}

// Supprimer une commande fournisseur
function deleteCommandeFournisseur($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM commandesfournisseurs WHERE Id_CommandesFournisseurs = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "Commande fournisseur supprimée"]);
}

// Routing simple
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = explode("/", $_SERVER["REQUEST_URI"]);
$id = isset($requestUri[2]) ? (int) $requestUri[2] : null;



?>