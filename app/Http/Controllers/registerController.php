<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

// Get form data
$user = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';
$password_check = $_POST['password_check'] ?? '';

// STAP 1: Controleer of gebruikersnaam niet leeg is
if (empty($user)) {
    die("Error: Gebruikersnaam is verplicht");
}

// STAP 2: Controleer of beide wachtwoorden niet leeg zijn
if (empty($password) || empty($password_check)) {
    die("Error: Wachtwoord is verplicht");
}

// STAP 3: Controleer of beide wachtwoorden gelijk zijn
if ($password !== $password_check) {
    die("Error: Wachtwoorden komen niet overeen");
}

// Controleer of gebruikersnaam al bestaat
$query = "SELECT * FROM users WHERE username = :user";
$statement = $conn->prepare($query);
$statement->execute([':user' => $user]);

if ($statement->rowCount() > 0) {
    die("Error: Gebruikersnaam bestaat al");
}

// STAP 1: Hash het wachtwoord
$hash = password_hash($password, PASSWORD_DEFAULT);

// STAP 2: Bereid de INSERT-statement voor
$query = "INSERT INTO users (username, password) VALUES (:user, :hash)";

// STAP 3: Prepare de statement
$statement = $conn->prepare($query);

// STAP 4: Execute de statement met de parameters
$statement->execute([
    ':user' => $user,
    ':hash' => $hash
]);

// STAP 5: Redirect naar login
header('Location: ' . $base_url . '/login.php');
exit;
