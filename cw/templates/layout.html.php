<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title><?php echo $title ?></title>
<link rel="stylesheet" href="/COMP1841/cw/style.css">
</head>

<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<h1>Film Review System</h1>

<nav>
<?php if (isset($_SESSION['role']) &&$_SESSION['role'] == 'user'):?>
    <a href="/COMP1841/cw/index.php">Home</a> 
    <a href="/COMP1841/cw/film.php">Films</a> 
    <a href="/COMP1841/cw/review.php">Reviews</a> 
    <a href="/COMP1841/cw/contact/contact.php">Contact</a> 
    <a href="/COMP1841/cw/contact/usermessage.php">My Messages</a>
<?php endif; ?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <a href="/COMP1841/cw/index.php">Home</a>
    <a href="/COMP1841/cw/film.php">Films</a>
    <a href="/COMP1841/cw/review.php">Reviews</a>
    <a href="/COMP1841/cw/user.php">Users</a>
    <a href="/COMP1841/cw/contact/messages.php">Messages</a> |
<?php endif; ?>

<?php if (isset($_SESSION['user'])): ?>
    Hello <?= $_SESSION['user'] ?> |
    <a href="/COMP1841/cw/admin/logout.php">Logout</a>
<?php else: ?>
    <a href="/COMP1841/cw/admin/login.php">Login</a>
<?php endif; ?>

</nav>
<main>
<?php echo $output; ?>
</main>
<footer class="main-footer">
    <div class="footer-container">
        <div class="footer-info">
            <h3 class="footer-logo">Film Review System</h3>
            <p>Sharing cinematic passion and providing the most objective reviews for movie enthusiasts.</p>
        </div>
        
        <div class="footer-nav">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="/COMP1841/cw/index.php">Home</a></li>
                <li><a href="/COMP1841/cw/film.php">Films</a></li>
                <li><a href="/COMP1841/cw/review.php">Reviews</a></li>
                <li><a href="/COMP1841/cw/contact/contact.php">Contact Us</a></li>
            </ul>
        </div>

        <div class="footer-contact">
            <h4>Support</h4>
            <p>Email: admin@gmail.com</p>
            <p>Phone: +1 234 567 890</p>
        </div>
    </div>
    
    <div class="footer-copyright">
        <p>&copy; <?= date("Y") ?> Film Review System. All rights reserved.</p>
    </div>
</footer>

</body>
</html>