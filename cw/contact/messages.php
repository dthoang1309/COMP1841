<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// chặn nếu không phải admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('location: /COMP1841/cw/index.php'); 
    exit();
}

include '../includes/DatabaseConnection.php';

$sql = 'SELECT * FROM contact ORDER BY created_at DESC';
$messages = $pdo->query($sql);

$title = 'Messages';

ob_start();
include '../templates/messages.html.php';
$output = ob_get_clean();

include '../templates/layout.html.php';