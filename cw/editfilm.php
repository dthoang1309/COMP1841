<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
session_start();

// Nếu không phải là admin, đá về trang chủ hoặc báo lỗi
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Hoặc die("You do not have permission.");
    exit();
} 
// UPDATE
if (isset($_POST['title'])) {

    $imageName = $_POST['currentImage'];

    // nếu có upload ảnh mới
    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . '_' . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            'images/' . $imageName
        );
    }

    query($pdo, 'UPDATE film SET title = :title, image = :image WHERE id = :id', [
        'title' => $_POST['title'],
        'image' => $imageName,
        'id' => $_POST['id']
    ]);

    header('location: film.php');
    exit();
}

// GET DATA
$film = query($pdo, 'SELECT * FROM film WHERE id = :id', [
    'id' => $_GET['id']
])->fetch();

ob_start();
include 'templates/editfilm.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';