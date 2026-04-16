<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';


/* ADD USER */
if (isset($_POST['username'])) {

    query($pdo, 'INSERT INTO user SET username = :username, email = :email', [
        'username' => $_POST['username'],
        'email' => $_POST['email']
    ]);

    header('location: user.php');
    exit();
}

/* DELETE USER */
if (isset($_POST['delete'])) {

    query($pdo, 'DELETE FROM user WHERE id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: user.php');
    exit();
}

ob_start();
include 'templates/adduser.html.php';
$output = ob_get_clean();

$title = 'Add User';
include 'templates/layout.html.php';