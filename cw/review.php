<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}
include 'includes/DatabaseConnection.php';

// 1. LẤY THÔNG TIN QUYỀN VÀ ID NGƯỜI DÙNG HIỆN TẠI
$isAdmin = false;
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
}

$currentUserId = null;
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
}

// 2. THÊM CỘT `review.userid` VÀO CÂU SELECT
$sql = "SELECT review.id,
               review.reviewtext,
               review.reviewdate,
               review.userid, /* THÊM CỘT NÀY ĐỂ CHECK QUYỀN */
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