<?php
session_start(); // Start session to get user information
include '../includes/DatabaseConnection.php';

// Check if user is logged in
if (isset($_SESSION['user']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    
$user_id = $_SESSION['user_id']; // Get user_id from session
$sql = 'INSERT INTO contact (user_id, message, created_at) VALUES (:user_id, :message, NOW())';

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'user_id' => $user_id, 
    'message' => $message
]);
    header('location: /COMP1841/cw/contact/contact.php?success=1');
    exit();
} else {
    // If not logged in or no message provided, redirect to login page
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}