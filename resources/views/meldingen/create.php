<?php require_once __DIR__ . '/../../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../../config/conn.php';

    $attractie = $_POST['naam_attractie'] ?? '';
    $type = $_POST['type_attractie'] ?? '';
    $capaciteit = $_POST['capaciteit'] ?? '';
    $melder = $_POST['melder'] ?? '';
    $prioriteit = $_POST['prioriteit'] ?? '';
    $overige_info = $_POST['overige_info'] ?? null;

    $query = "INSERT INTO meldingen 
        (attractie, type, capaciteit, prioriteit, melder, overige_info) 
        VALUES 
        (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':attractie' => $attractie,
        ':type' => $type,
        ':capaciteit' => $capaciteit,
        ':prioriteit' => $prioriteit,
        ':melder' => $melder,
        ':overige_info' => $overige_info,
    ]);

    header('Location: index.php?msg=' . urlencode('Melding opgeslagen'));
    exit;
}
?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <form action="create.php" method="POST">

            <div class="form-group">
                <label for="naam_attractie">Naam attractie:</label>
                <input type="text" name="naam_attractie" id="naam_attractie" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="type_attractie">Wat voor attractie?:</label>
                <select name="type_attractie" id="type_attractie" required>
                    <option value="Wateratractie">Wateratractie</option>
                    <option value="Achtbaan">Achtbaan</option>
                    <option value="Kinderachtbaan">Kinderachtbaan</option>
                    <option value="Eetplek">Eetplek</option>
                </select>
            </div>

            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="prioriteit">Wat is de prioriteit?:</label>
                <select name="prioriteit" id="prioriteit" required>
                    <option value="hoog">Hoog</option>
                    <option value="laag">Laag</option>
                </select>
            </div>

            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>
