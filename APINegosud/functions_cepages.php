<?php
require_once "config.php";

// ✅ Récupérer tous les cépages
function getCepages($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM cepages");
        $cepages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ["success" => true, "data" => $cepages];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ Ajouter un cépage
function addCepage($pdo, $data) {
    if (!isset($data['NomCepage']) || empty($data['NomCepage'])) {
        return ["success" => false, "message" => "Le nom du cépage est requis"];
    }

    $nomCepage = htmlspecialchars($data['NomCepage']);

    try {
        $stmt = $pdo->prepare("INSERT INTO cepages (NomCepage) VALUES (:nomCepage)");
        $stmt->execute([":nomCepage" => $nomCepage]);
        return ["success" => true, "message" => "Cépage ajouté"];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ Modifier un cépage
function updateCepage($pdo, $data) {
    if (!isset($data['Id_Cepages'], $data['NomCepage'])) {
        return ["success" => false, "message" => "Données incomplètes"];
    }

    $id = intval($data['Id_Cepages']);
    $nomCepage = htmlspecialchars($data['NomCepage']);

    try {
        $stmt = $pdo->prepare("UPDATE cepages SET NomCepage = :nomCepage WHERE Id_Cepages = :id");
        $stmt->execute([":id" => $id, ":nomCepage" => $nomCepage]);
        
        return ($stmt->rowCount() > 0) ? ["success" => true, "message" => "Cépage mis à jour"]
                                    : ["success" => false, "message" => "Aucune modification"];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ Supprimer un cépage
function deleteCepage($pdo, $data) {
    if (!isset($data['Id_Cepages'])) {
        return ["success" => false, "message" => "ID du cépage manquant"];
    }

    $id = intval($data['Id_Cepages']);

    try {
        $stmt = $pdo->prepare("DELETE FROM cepages WHERE Id_Cepages = :id");
        $stmt->execute([":id" => $id]);
        
        return ($stmt->rowCount() > 0) ? ["success" => true, "message" => "Cépage supprimé"]
                                    : ["success" => false, "message" => "Aucun cépage trouvé"];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}
?>
