<?php
header("Content-Type: application/json");
require_once "functions_produits.php";

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents("php://input"), true);




?>