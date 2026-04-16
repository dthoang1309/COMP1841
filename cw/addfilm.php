<?php

include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

// If not admin, redirect to homepage or show error
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Or die("You do not have permission.");
    exit();
} 
// Ensure the session has started to access $_SESSION['user_id']
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check whether the user is logged in (user_id is required)
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
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

    // UPDATE: add user_id to the INSERT statement
    query($pdo, 'INSERT INTO film SET title = :title, image = :image, user_id = :user_id', [
        'title' => $_POST['title'],
        'image' => $imageName,
        'user_id' => $_SESSION['user_id'] // Get user ID from Session
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