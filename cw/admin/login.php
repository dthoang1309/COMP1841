<?php
include '../includes/DatabaseConnection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['username'])) {
    $sql = 'SELECT * FROM user WHERE username = :username';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $_POST['username']]);
    $user = $stmt->fetch();

    // Use password_verify to validate the password
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];

        header('location: /COMP1841/cw/index.php'); 
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
$title = 'Login';
ob_start();
include '../templates/login.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';