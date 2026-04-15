<?php
require_once __DIR__ . '/../../../config/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['user_id'])) {
    header('Location: ' . $base_url . '/login.php');
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>
        <a href="create.php">Nieuwe melding &gt;</a>

        <?php
        // Eventuele melding tonen
        if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
        }

        // Databaseverbinding
        require_once __DIR__ . '/../../../config/conn.php';

        // SELECT-query
        $sql = "SELECT * FROM meldingen ORDER BY gemeld_op DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="meldingen-tabel">
            <tr>
                <th>ID</th>
                <th>Attractie</th>
                <th>Type</th>
                <th>Capaciteit</th>
                <th>Prioriteit</th>
                <th>Melder</th>
                <th>Gemeld op</th>
                <th>Overige info</th>
                <th>aanpassen</th>
            </tr>

            <?php foreach ($list as $melding) : ?>
                <tr>
                    <td><?= htmlspecialchars($melding['id'] ?? '') ?></td>
                    <td><?= htmlspecialchars($melding['attractie'] ?? '') ?></td>
                    <td><?= htmlspecialchars($melding['type'] ?? '') ?></td>
                    <td><?= htmlspecialchars($melding['capaciteit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($melding['prioriteit'] ?? '') ?></td>
                    <td><?= htmlspecialchars($melding['melder'] ?? '') ?></td>
                    <td><?= htmlspecialchars($melding['gemeld_op'] ?? '') ?></td>
                    <td><?= nl2br(htmlspecialchars($melding['overige_info'] ?? '')) ?></td>
                    <td><a href="edit.php?id=<?php echo $melding['id']; ?>">aanpassen</a></td>

                    
                </tr>
            <?php endforeach; ?>
        </table>
        

    </div>

</body>

</html>
