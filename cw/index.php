<?php
include 'includes/DatabaseConnection.php';
session_start();

// 1. Check login status
if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}

$sql = 'SELECT f.*, r.reviewtext 
        FROM film f 
        LEFT JOIN review r ON f.id = r.filmid 
        GROUP BY f.id 
        ORDER BY f.id DESC LIMIT 3';

$stmt = $pdo->query($sql);
$latestFilms = $stmt->fetchAll();


$totalFilms = $pdo->query('SELECT count(*) FROM film')->fetchColumn();
$totalReviews = $pdo->query('SELECT count(*) FROM review')->fetchColumn();


$title = 'Home';
$username = $_SESSION['user'];

$isAdmin = false; 
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
}

// 2. Get the current logged-in user ID
$currentUserId = null;
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
}

ob_start();
include 'templates/home.html.php'; 
$output = ob_get_clean();

include 'templates/layout.html.php';