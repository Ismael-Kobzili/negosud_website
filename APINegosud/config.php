<?php
$host = "localhost"; // Adresse du serveur MySQL
$dbname = "bddnegosudentrepot1"; // Nom de la base de données
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL (laisser vide si aucun)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die(json_encode([
        "success" => false,
        "message" => "Echec de la connexion à la base de données : " . $e->getMessage()
    ]));
}
?>