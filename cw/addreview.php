<?php
include 'includes/DatabaseConnection.php';
// Bao gồm file chứa hàm query() nếu bạn có sử dụng hàm tự định nghĩa
include 'includes/DatabaseFunctions.php'; 

session_start();

// Kiểm tra quyền truy cập (nếu cần)
if (!isset($_SESSION['user'])) {
    header('location: /COMP1841/cw/admin/login.php');
    exit();
}

// 👉 XỬ LÝ THÊM REVIEW (ADD)
if (isset($_POST['reviewtext'])) {
    // Sử dụng hàm query tự định nghĩa hoặc PDO trực tiếp
    $sql = 'INSERT INTO review (reviewtext, reviewdate, userid, filmid) 
            VALUES (:reviewtext, CURDATE(), :userid, :filmid)';
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'reviewtext' => $_POST['reviewtext'],
        'userid' => $_POST['userid'],
        'filmid' => $_POST['filmid']
    ]);

    // CHUYỂN HƯỚNG VỀ TRANG REVIEW NGAY LẬP TỨC
    header('location: review.php');
    exit();
}

// 👉 XỬ LÝ XÓA REVIEW
if (isset($_POST['delete']) && isset($_POST['id'])) {
    
    // 1. Lấy thông tin review để kiểm tra ai là người viết
    $stmt = $pdo->prepare('SELECT userid FROM review WHERE id = :id');
    $stmt->execute(['id' => $_POST['id']]);
    $reviewToDelete = $stmt->fetch();

    $isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
    $currentUserId = $_SESSION['user_id'] ?? null;

    // 2. Chỉ thực hiện xóa nếu tìm thấy review VÀ (là admin HOẶC là chính chủ)
    if ($reviewToDelete && ($isAdmin || ($currentUserId == $reviewToDelete['userid']))) {
        $sql = "DELETE FROM review WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $_POST['id']]);
    }

    header('location: review.php');
    exit();
}

// 👉 CHUẨN BỊ DỮ LIỆU CHO DROPDOWN TRONG FORM
$users = $pdo->query('SELECT * FROM user')->fetchAll();
$films = $pdo->query('SELECT * FROM film')->fetchAll();

$title = 'Add Review';

// 👉 HIỂN THỊ GIAO DIỆN
ob_start();
include 'templates/addreview.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';