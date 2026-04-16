<?php
include 'includes/DatabaseConnection.php';
// Include file containing query() helper if you use a custom helper
include 'includes/DatabaseFunctions.php'; 

session_start();

// Check access permissions (if needed)
if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}

// 👉 Handle adding a review (ADD)
if (isset($_POST['reviewtext'])) {
    // Use a custom query helper or PDO directly
    $sql = 'INSERT INTO review (reviewtext, reviewdate, userid, filmid) 
            VALUES (:reviewtext, CURDATE(), :userid, :filmid)';
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'reviewtext' => $_POST['reviewtext'],
        'userid' => $_POST['userid'],
        'filmid' => $_POST['filmid']
    ]);

    // Redirect immediately back to the review page
    header('location: review.php');
    exit();
}

// 👉 Handle review deletion
if (isset($_POST['delete']) && isset($_POST['id'])) {
    
    // 1. Fetch the review info to check who wrote it
    $stmt = $pdo->prepare('SELECT userid FROM review WHERE id = :id');
    $stmt->execute(['id' => $_POST['id']]);
    $reviewToDelete = $stmt->fetch();

    $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
    $currentUserId = $_SESSION['user_id'] ?? null;

    // 2. Only delete if review is found AND (is admin OR owner)
    if ($reviewToDelete && ($isAdmin || ($currentUserId == $reviewToDelete['userid']))) {
        $sql = "DELETE FROM review WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $_POST['id']]);
    }

    header('location: review.php');
    exit();
}

// 👉 Prepare data for dropdowns in the form
$users = $pdo->query('SELECT * FROM user')->fetchAll();
$films = $pdo->query('SELECT * FROM film')->fetchAll();

$title = 'Add Review';

// 👉 Render the view
ob_start();
include 'templates/addreview.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';