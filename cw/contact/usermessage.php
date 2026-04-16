<?php
session_start();
include '../includes/DatabaseConnection.php';

// Check if logged in
if (!isset($_SESSION['user'])) {
    header('location: ../admin/login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Get ID from session
$sql = "SELECT * FROM contact WHERE user_id = :user_id ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);;

$messages = $stmt->fetchAll();

$title = 'My Messages';

ob_start();
include '../templates/usermessages.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';