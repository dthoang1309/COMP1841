<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}
include 'includes/DatabaseConnection.php';

// 1. Get current user role and user ID
$isAdmin = false;
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
}

$currentUserId = null;
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
}

// 2. Add the `review.userid` column to the SELECT query
$sql = "SELECT review.id,
               review.reviewtext,
               review.reviewdate,
               review.userid, /* Add this column to check permissions */
               film.title,
               user.username
        FROM review
        JOIN film ON review.filmid = film.id
        JOIN user ON review.userid = user.id
        ORDER BY reviewdate DESC";

$reviews = $pdo->query($sql)->fetchAll();

ob_start();
include 'templates/reviews.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';