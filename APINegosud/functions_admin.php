<?php

require_once "config.php"; // Connexion à la base de données

// ✅ GET - Récupérer tous les administrateurs
function getAdmins($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM admin");
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return["success" => true, "data" => $admins];
    } catch (Exception $e) {
        return["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ POST - Ajouter un administrateur
function addAdmin($pdo,$data) {
    if (!isset($data['PrenomAdmin']) || !isset($data['MdpAdmin'])) {
        return["success" => false, "message" => "Données incomplètes"];
    }

    $prenom = htmlspecialchars($data['PrenomAdmin']);
    $mdp = password_hash($data['MdpAdmin'], PASSWORD_BCRYPT); // Hachage du mot de passe

    if (!$mdp) return ["success" => false, "message" => "mdp invalide"];

    try {
        $stmt = $pdo->prepare("INSERT INTO admin (PrenomAdmin, MdpAdmin) VALUES (:prenom, :mdp)");
        $stmt->execute([":prenom" => $prenom, ":mdp" => $mdp]);

        return["success" => true, "message" => "Admin ajouté avec succès"];
    } catch (Exception $e) {
        return["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ PUT - Modifier un administrateur
function updateAdmin($pdo) {
    if (!isset($data['id_Admin']) || !isset($data['PrenomAdmin']) || !isset($data['MdpAdmin'])) {
    return;["success" => false, "message" => "Données incomplètes"];
    }

    $id = intval($data['id_Admin']);
    $prenom = htmlspecialchars($data['PrenomAdmin']);
    $mdp = password_hash($data['MdpAdmin'], PASSWORD_BCRYPT); // Hachage du mot de passe

    if (!$mdp) return ["success" => false, "message" => "Email invalide"];

    try {
        $stmt = $pdo->prepare("UPDATE admins SET PrenomAdmin = :prenom, MdpAdmin = :mdp WHERE id_Admin = :id");
        $stmt->execute([":id" => $id, ":prenom" => $prenom, ":mdp" => $mdp]);

        return($stmt->rowCount() > 0) ? ["success" => true, "message" => "Admin mis à jour avec succès"]
                                    :["success" => false, "message" => "Aucune modification effectuée"];
    } catch (Exception $e) {
        return(["success" => false, "message" => "Erreur : " . $e->getMessage()]);
    }
}

// ✅ DELETE - Supprimer un administrateur
function deleteAdmin($pdo, $data) {
    if (!isset($data['id_Admin'])) 
    return;["success" => false, "message" => "ID admin manquant"];

    $id = intval($data['id_Admin']);

    try {
        $stmt = $pdo->prepare("DELETE FROM admins WHERE id_Admin = :id");
        $stmt->execute([":id" => $id]);

        return ($stmt->rowCount() > 0) ? (["success" => true, "message" => "Admin supprimé avec succès"])
                                : ["success" => false, "message" => "Aucun admin trouvé avec cet ID"];
    } catch (Exception $e) {
        return["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}
?>
