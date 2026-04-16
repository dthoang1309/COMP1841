<?php
include 'includes/DatabaseConnection.php';
include 'includes/DatabaseFunctions.php';

// 1. Khởi tạo session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Lấy thông tin phân quyền cho View (Giao diện)
$isAdmin = false; 
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
}

$currentUserId = null;
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
}

// 3. 🔥 XỬ LÝ XÓA PHIM (Có kiểm tra quyền)
if (isset($_POST['delete']) && !empty($_POST['id'])) {

    // Lấy thông tin bộ phim đang muốn xóa ra trước
    $filmToDelete = query($pdo, 'SELECT * FROM film WHERE id = :id', ['id' => $_POST['id']])->fetch();

    if ($filmToDelete) {
        // Kiểm tra quyền: Chỉ cho phép xóa nếu là Admin HOẶC là người đã đăng bộ phim đó
        if ($isAdmin || ($currentUserId !== null && $filmToDelete['user_id'] == $currentUserId)) {
            
            // Xóa phim
            query($pdo, 'DELETE FROM film WHERE id = :id', [
                'id' => $_POST['id']
            ]);
            
            // (Tùy chọn) Bạn có thể thêm code xóa file ảnh trong thư mục images/ tại đây nếu muốn
        }
    }

    header('location: film.php');
    exit();
}

// 4. 🔥 LOAD DATA
// Cột user_id sẽ tự động được lấy ra cùng các thông tin khác
$films = query($pdo, 'SELECT * FROM film')->fetchAll();

$title = 'Film List';

// 5. GỌI GIAO DIỆN
ob_start();
include 'templates/films.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';