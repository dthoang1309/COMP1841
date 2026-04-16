<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

$users = query($pdo, 'SELECT * FROM user')->fetchAll();

ob_start();
include 'templates/users.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';