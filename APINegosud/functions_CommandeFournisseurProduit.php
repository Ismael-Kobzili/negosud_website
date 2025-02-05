<?php
require_once "config.php";

// Récupérer toutes les commandes fournisseurs produits
function getAllCommandesFournisseursProduits() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM commandesfournisseursproduits");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

// Récupérer une commande fournisseur produit par ID
function getCommandeFournisseurProduitById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM commandesfournisseursproduits WHERE Id_CommandesFournisseursProduits = ?");
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}

// Ajouter une nouvelle commande fournisseur produit
function addCommandeFournisseurProduit() {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("INSERT INTO commandesfournisseursproduits (IDCommandeFournisseur, IDProduit, Quantite) VALUES (?, ?, ?)");
    $stmt->execute([$data['IDCommandeFournisseur'], $data['IDProduit'], $data['Quantite']]);
    echo json_encode(["message" => "Commande fournisseur produit ajoutée avec succès"]);
}

// Mettre à jour une commande fournisseur produit
function updateCommandeFournisseurProduit($id) {
    global $pdo;
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdo->prepare("UPDATE commandesfournisseursproduits SET IDCommandeFournisseur=?, IDProduit=?, Quantite=? WHERE Id_CommandesFournisseursProduits=?");
    $stmt->execute([$data['IDCommandeFournisseur'], $data['IDProduit'], $data['Quantite'], $id]);
    echo json_encode(["message" => "Commande fournisseur produit mise à jour"]);
}

// Supprimer une commande fournisseur produit
function deleteCommandeFournisseurProduit($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM commandesfournisseursproduits WHERE Id_CommandesFournisseursProduits = ?");
    $stmt->execute([$id]);
    echo json_encode(["message" => "Commande fournisseur produit supprimée"]);
}

// Routing simple
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestUri = explode("/", $_SERVER["REQUEST_URI"]);
$id = isset($requestUri[2]) ? (int) $requestUri[2] : null;


?>