<?php
include '../includes/DatabaseConnection.php';

$id = $_POST['id'];

$sql = "DELETE FROM contact WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header('location: messages.php');