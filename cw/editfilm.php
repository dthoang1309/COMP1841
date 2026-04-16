<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';
session_start();

// If not admin, redirect to homepage or show error
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Or die("You do not have permission.");
    exit();
} 
// UPDATE
if (isset($_POST['title'])) {

    $imageName = $_POST['currentImage'];

    // if a new image is uploaded
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

// Get film data
$film = query($pdo, 'SELECT * FROM film WHERE id = :id', [
    'id' => $_GET['id']
])->fetch();

ob_start();
include 'templates/editfilm.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';