<?php
session_start(); // Bắt đầu session để lấy thông tin user
include '../includes/DatabaseConnection.php';

// Kiểm tra nếu user đã đăng nhập
if (isset($_SESSION['user']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    
$user_id = $_SESSION['user_id']; // Lấy user_id đã có sẵn trong session
$sql = 'INSERT INTO contact (user_id, message, created_at) VALUES (:user_id, :message, NOW())';

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'user_id' => $user_id, 
    'message' => $message
]);
    header('location: /COMP1841/cw/contact/contact.php?success=1');
    exit();
} else {
    // Nếu chưa đăng nhập hoặc không có tin nhắn, quay về trang chủ hoặc trang login
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}