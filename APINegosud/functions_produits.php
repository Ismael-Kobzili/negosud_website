<?php
require_once "config.php";

// ✅ Récupérer tous les produits
function getProduits($pdo){
    try {
        $stmt = $pdo->query("SELECT * FROM produits");
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return ["success" => true, "data" => $produits];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
    }

// ✅ Ajouter un produit
function addProduits($pdo, $data) {
// Vérifier si la requête est bien en PUT
if (!isset($data['id']) || !isset($data['nom']) || !isset($data['prix']) || !isset($data['description'])) {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
    exit();
}

$id = intval($data['id']);
$nom = htmlspecialchars($data['nom']);
$prix = floatval($data['prix']);
$description = htmlspecialchars($data['description']);

try {
    $stmt = $pdo->prepare("UPDATE produits SET nom = :nom, prix = :prix, description = :description WHERE id = :id");
    $stmt->execute([
        ":id" => $id,
        ":nom" => $nom,
        ":prix" => $prix,
        ":description" => $description
    ]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            "success" => true,
            "message" => "Produit mis à jour avec succès"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Aucune mise à jour effectuée (vérifie l'ID)"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Erreur lors de la mise à jour du produit : " . $e->getMessage()
    ]);
}
}

// ✅ Modifier un produit
function updateProduits($pdo, $data) {
    // Vérifier si les données sont envoyées en POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée"]);
    exit();
}

// Récupérer les données envoyées en JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['nom']) || !isset($data['prix']) || !isset($data['description'])) {
    echo json_encode(["success" => false, "message" => "Données incomplètes"]);
    exit();
}

$nom = htmlspecialchars($data['nom']);
$prix = floatval($data['prix']);
$description = htmlspecialchars($data['description']);

try {
    $stmt = $pdo->prepare("INSERT INTO produits (nom, prix, description) VALUES (:nom, :prix, :description)");
    $stmt->execute([
        ":nom" => $nom,
        ":prix" => $prix,
        ":description" => $description
    ]);

    echo json_encode([
        "success" => true,
        "message" => "Produit ajouté avec succès"
    ]);
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Erreur lors de l'ajout du produit : " . $e->getMessage()
    ]);
}
}

// ✅ Supprimer un produit
function deleteProduits($pdo, $data) {
    // Vérifier si la requête est bien en DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(["success" => false, "message" => "Méthode non autorisée"]);
    exit();
}

// Récupérer les données envoyées en JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "ID du produit manquant"]);
    exit();
}

$id = intval($data['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM produits WHERE id = :id");
    $stmt->execute([":id" => $id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            "success" => true,
            "message" => "Produit supprimé avec succès"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Aucun produit trouvé avec cet ID"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "Erreur lors de la suppression du produit : " . $e->getMessage()
    ]);
}
}
?>
