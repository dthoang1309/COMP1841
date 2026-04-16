<?php

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

// Nếu không phải là admin, đá về trang chủ hoặc báo lỗi
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Hoặc die("You do not have permission.");
    exit();
} 
// Đảm bảo session đã bắt đầu để lấy $_SESSION['user_id']
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem người dùng đã đăng nhập chưa (cần user_id)
if (!isset($_SESSION['user_id'])) {
    // Nếu chưa, chuyển hướng về trang đăng nhập
    header('location: login.php');
    exit();
}

// ADD FILM
if (isset($_POST['title'])) {

    $imageName = '';

    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . '_' . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            'images/' . $imageName
        );
    }

    // CẬP NHẬT: Thêm user_id vào câu lệnh INSERT
    query($pdo, 'INSERT INTO film SET title = :title, image = :image, user_id = :user_id', [
        'title' => $_POST['title'],
        'image' => $imageName,
        'user_id' => $_SESSION['user_id'] // Lấy ID người dùng từ Session
    ]);

    header('location: film.php');
    exit();
}

// DELETE FILM
if(isset($_POST['delete'])){

    query($pdo, 'DELETE FROM film WHERE id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: addfilm.php');
    exit();
}

// VIEW
ob_start();
include 'templates/addfilm.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';