<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$capaciteit = $_POST['capaciteit'];
$melder = $_POST['melder'];
$type = $_POST['type'] ?? 'Onbekend'; // ❌ fallback if type not sent

echo $attractie . " / " . $capaciteit . " / " . $melder . " / " . $type;

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query (capaciteit toegevoegd)
$query = "INSERT INTO meldingen (attractie, type, capaciteit) VALUES(:attractie, :type, :capaciteit)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ':attractie' => $attractie,
    ':type' => $type,
    ':capaciteit' => $capaciteit, // nu wordt capaciteit meegestuurd
]);