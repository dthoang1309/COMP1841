<?php
include '../includes/DatabaseConnection.php';

$id = $_POST['id'];
$reply = $_POST['reply'];

$sql = "UPDATE contact 
        SET reply = :reply, replied_at = NOW()
        WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'reply' => $reply,
    'id' => $id
]);

header('location: messages.php');