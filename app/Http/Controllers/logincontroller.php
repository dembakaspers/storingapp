<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/conn.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([':username' => $username]);

if ($statement->rowCount() < 1) {
    die("Error: account bestaat niet");
}

$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!password_verify($password, $user['password'])) {
    die("Error: wachtwoord niet juist!");
}

$_SESSION['user_id'] = $user['id'];
header('Location: ' . $base_url . '/index.php');
exit;
