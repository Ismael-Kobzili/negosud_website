<?php
require_once "config.php";

// ✅ Récupérer tous les clients
function getClients($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM clients");
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ["success" => true, "data" => $clients];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ Ajouter un client
function addClient($pdo, $data) {
    if (!isset($data['NomClient'], $data['PrenomClient'], $data['Adresse'], $data['Email'], $data['Telephone'])) {
        return ["success" => false, "message" => "Données incomplètes"];
    }

    $nom = htmlspecialchars($data['NomClient']);
    $prenom = htmlspecialchars($data['PrenomClient']);
    $adresse = htmlspecialchars($data['Adresse']);
    $email = filter_var($data['Email'], FILTER_VALIDATE_EMAIL);
    $telephone = htmlspecialchars($data['Telephone']);
    $dateInscription = date('Y-m-d');
    $refClient = uniqid("CLT_");

    if (!$email) return ["success" => false, "message" => "Email invalide"];

    try {
        $stmt = $pdo->prepare("INSERT INTO clients (NomClient, PrenomClient, Adresse, Email, Telephone, DateInscription, RefClient) VALUES (:nom, :prenom, :adresse, :email, :telephone, :dateInscription, :refClient)");
        $stmt->execute([
            ":nom" => $nom, ":prenom" => $prenom, ":adresse" => $adresse,
            ":email" => $email, ":telephone" => $telephone,
            ":dateInscription" => $dateInscription, ":refClient" => $refClient
        ]);
        return ["success" => true, "message" => "Client ajouté", "refClient" => $refClient];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ Modifier un client
function updateClient($pdo, $data) {
    if (!isset($data['Id_Clients'], $data['NomClient'], $data['PrenomClient'], $data['Adresse'], $data['Email'], $data['Telephone'])) {
        return ["success" => false, "message" => "Données incomplètes"];
    }

    $id = intval($data['Id_Clients']);
    $nom = htmlspecialchars($data['NomClient']);
    $prenom = htmlspecialchars($data['PrenomClient']);
    $adresse = htmlspecialchars($data['Adresse']);
    $email = filter_var($data['Email'], FILTER_VALIDATE_EMAIL);
    $telephone = htmlspecialchars($data['Telephone']);

    if (!$email) return ["success" => false, "message" => "Email invalide"];

    try {
        $stmt = $pdo->prepare("UPDATE clients SET NomClient = :nom, PrenomClient = :prenom, Adresse = :adresse, Email = :email, Telephone = :telephone WHERE Id_Clients = :id");
        $stmt->execute([
            ":id" => $id, ":nom" => $nom, ":prenom" => $prenom,
            ":adresse" => $adresse, ":email" => $email, ":telephone" => $telephone
        ]);

        return ($stmt->rowCount() > 0) ? ["success" => true, "message" => "Client mis à jour"]
                                    : ["success" => false, "message" => "Aucune modification"];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

// ✅ Supprimer un client
function deleteClient($pdo, $data) {
    if (!isset($data['Id_Clients'])) 
    return ["success" => false, "message" => "ID client manquant"];

    $id = intval($data['Id_Clients']);

    try {
        $stmt = $pdo->prepare("DELETE FROM clients WHERE Id_Clients = :id");
        $stmt->execute([":id" => $id]);

        return ($stmt->rowCount() > 0) ? ["success" => true, "message" => "Client supprimé"]
                                    : ["success" => false, "message" => "Aucun client trouvé"];
    } catch (Exception $e) {
        return ["success" => false, "message" => "Erreur : " . $e->getMessage()];
    }
}

?>
