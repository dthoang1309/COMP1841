<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// 1. Initialize session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Get authorization info for the view
$isAdmin = false; 
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
}

$currentUserId = null;
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
}

// 3. Handle film deletion (with permission check)
if (isset($_POST['delete']) && !empty($_POST['id'])) {

    // Fetch the film data before deleting
    $filmToDelete = query($pdo, 'SELECT * FROM film WHERE id = :id', ['id' => $_POST['id']])->fetch();

    if ($filmToDelete) {
        // Check permissions: allow delete only if admin OR film owner
        if ($isAdmin || ($currentUserId !== null && $filmToDelete['user_id'] == $currentUserId)) {
            
            // Delete film
            query($pdo, 'DELETE FROM film WHERE id = :id', [
                'id' => $_POST['id']
            ]);
            
            // (Optional) You can add code here to delete the image file from the images/ folder if needed
        }
    }

    header('location: film.php');
    exit();
}

// 4.  Load data
// The user_id column will automatically be loaded along with other fields
$films = query($pdo, 'SELECT * FROM film')->fetchAll();

$title = 'Film List';

// 5. Render the view
ob_start();
include 'templates/films.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';