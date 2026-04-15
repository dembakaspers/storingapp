<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once __DIR__ . '/../components/head.php'; ?>
</head>

<body>
    <?php require_once __DIR__ . '/../components/header.php'; ?>

    <main class="container home">
        <h1>Welkom bij de technische dienst</h1>
        <img src="<?php echo $base_url; ?>/public_html/img/logo-big-fill-only.png" alt="logo">
    </main>

    <div class="container">
        <h2>Inloggen</h2>
        <form action="logincontroller.php" method="POST">
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Inloggen</button>
        </form>
    </div>
</body>

</html>
