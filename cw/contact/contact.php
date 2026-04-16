<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}
$title = 'Contact';
ob_start();
include '../templates/contact.html.php';
$output = ob_get_clean();
include '../templates/layout.html.php';