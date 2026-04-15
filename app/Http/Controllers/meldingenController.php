<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../../config/config.php';
if (empty($_SESSION['user_id'])) {
    header('Location: ' . $base_url . '/resources/views/login/index.php');
    exit;
}

// POST-variabelen ophalen (namen komen uit create.php)
$attractie = $_POST['naam_attractie'];
$type = $_POST['type_attractie'];
$capaciteit = $_POST['capaciteit'];
$melder = $_POST['melder'];
$prioriteit = $_POST['prioriteit'];
$overige_info = $_POST['overige_info'] ?? null;

// Databaseverbinding
require_once __DIR__ . '/../../../config/conn.php';

// SQL-query
$query = "INSERT INTO meldingen 
(attractie, type, capaciteit, prioriteit, melder, overige_info) 
VALUES 
(:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

$statement = $conn->prepare($query);

// Uitvoeren
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => $capaciteit,
    ':prioriteit' => $prioriteit,
    ':melder' => $melder,
    ':overige_info' => $overige_info
]);

header("Location: /storingapp/resources/views/meldingen/index.php?msg=Melding+opgeslagen");
exit;
