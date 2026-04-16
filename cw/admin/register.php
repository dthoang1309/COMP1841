<?php
include '../includes/DatabaseConnection.php';
session_start();

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Sử dụng password_hash để mã hóa mật khẩu
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $check->execute(['username' => $username]);

    if ($check->rowCount() > 0) {
        $error = "Username already exists";
    } else {
        // Lưu mật khẩu đã mã hóa vào database
        $sql = "INSERT INTO user (username, email, password, role)
                VALUES (:username, :email, :password, 'user')";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        header('location: login.php');
        exit();
    }
}

$title = 'Register';
ob_start();
include '../templates/register.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';