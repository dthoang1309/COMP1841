<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';


if (isset($_POST['username'])) {

    query($pdo, 'UPDATE user 
                 SET username = :username, email = :email 
                 WHERE id = :id', [
        'username' => $_POST['username'],
        'email' => $_POST['email'],   
        'id' => $_POST['id']
    ]);

    header('location: user.php');
    exit();
}

/* GET USER */
$id = $_GET['id'];

$user = query($pdo, 'SELECT * FROM user WHERE id = :id', [
    'id' => $id
])->fetch();

/* LOAD VIEW */
ob_start();
include 'templates/edituser.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';