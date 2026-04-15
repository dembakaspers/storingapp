<?php
require_once __DIR__ . '/../../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    header('Location: ' . $base_url . '/login.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php?msg=' . urlencode('Geen melding geselecteerd'));
    exit;
}

require_once __DIR__ . '/../../../config/conn.php';
$query = 'SELECT * FROM meldingen WHERE id = :id';
$statement = $conn->prepare($query);
$statement->execute([':id' => $id]);
$melding = $statement->fetch(PDO::FETCH_ASSOC);

if (!$melding) {
    header('Location: index.php?msg=' . urlencode('Melding niet gevonden'));
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Bewerken</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Melding bewerken</h1>
        <p>Deze functie is nog niet volledig geïmplementeerd, maar je bent wel ingelogd.</p>
        <dl>
            <dt>Attractie</dt>
            <dd><?= htmlspecialchars($melding['attractie'] ?? '') ?></dd>
            <dt>Type</dt>
            <dd><?= htmlspecialchars($melding['type'] ?? '') ?></dd>
            <dt>Capaciteit</dt>
            <dd><?= htmlspecialchars($melding['capaciteit'] ?? '') ?></dd>
            <dt>Prioriteit</dt>
            <dd><?= htmlspecialchars($melding['prioriteit'] ?? '') ?></dd>
            <dt>Melder</dt>
            <dd><?= htmlspecialchars($melding['melder'] ?? '') ?></dd>
        </dl>
        <p><a href="index.php">Terug naar meldingen</a></p>
    </div>
</body>

</html>
