<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <div class="container">
        <h2>Inloggen</h2>
        <form action="<?php echo $base_url; ?>/app/Http/Controllers/logincontroller.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Inloggen</button>
            
        </form>
    </div>
</body>

</html>
