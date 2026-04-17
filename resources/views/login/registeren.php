<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp - Registreren</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h2>Registreren</h2>
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/registerController.php" method="POST">
            <div class="form-group">
                <label for="email">E-mailadres:</label>
                <input type="text" id="text" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_check">Wachtwoord herhalen:</label>
                <input type="password" id="password_check" name="password_check" required>
            </div>

            <button type="submit">Registreren</button>
        </form>
    </div>
</body>

</html>