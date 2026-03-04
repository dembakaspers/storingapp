<?php require_once __DIR__ . '/../../../config/config.php'; ?>
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
        if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
        }

        require_once __DIR__ . '/../../../config/conn.php';

        $sql = "SELECT * FROM meldingen ORDER BY gemeld_op DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="meldingen-container">
            <?php foreach ($list as $melding) : ?>
                <div class="melding">
                    <h2><?php echo htmlspecialchars($melding['attractie'] ?? 'Onbekend'); ?></h2>

                    <p><span class="label">Type:</span>
                        <?php echo htmlspecialchars($melding['type'] ?? 'Onbekend'); ?>
                    </p>

                    <p><span class="label">Capaciteit:</span>
                        <?php echo htmlspecialchars($melding['capaciteit'] ?? 0); ?> p/uur
                    </p>

                    <p><span class="label">Melder:</span>
                        <?php echo htmlspecialchars($melding['melder'] ?? ''); ?>
                    </p>

                    <p><span class="label">Gemeld op:</span>
                        <?php echo htmlspecialchars($melding['gemeld_op']); ?>
                    </p>

                    <?php if (!empty($melding['overige_info'])) : ?>
                        <p><span class="label">Overige info:</span><br>
                            <?php echo nl2br(htmlspecialchars($melding['overige_info'])); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</body>

</html>
