<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

session_start();

// 1. Check login status
if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}

$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
$currentUserId = $_SESSION['user_id'] ?? null;

// 2. Handle update (when user clicks Save Update)
if (isset($_POST['reviewtext'])) {
    $reviewId = $_POST['id'];
    
    // Re-check permissions before UPDATE (backend security)
    $stmt = $pdo->prepare('SELECT userid FROM review WHERE id = :id');
    $stmt->execute(['id' => $reviewId]);
    $review = $stmt->fetch();

    if ($review && ($isAdmin || $currentUserId == $review['userid'])) {
        query($pdo, 'UPDATE review SET reviewtext = :reviewtext, reviewdate = CURDATE() WHERE id = :id', [
            'reviewtext' => $_POST['reviewtext'],
            'id' => $reviewId
        ]);
    }

    header('location: review.php');
    exit();
}

// 3. Retrieve data to display the form (GET)
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM review WHERE id = :id');
    $stmt->execute(['id' => $_GET['id']]);
    $review = $stmt->fetch();

    // Check: if review not found or no permission, redirect out
    if (!$review || !($isAdmin || $currentUserId == $review['userid'])) {
        header('location: review.php');
        exit();
    }
} else {
    header('location: review.php');
    exit();
}

$title = 'Edit Review';

// 4. Render the view
ob_start();
include 'templates/editreview.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';