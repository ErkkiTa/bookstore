<?php
require_once 'db_connection.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM books  WHERE id = :id");
$stmt->execute(['id' => $id]);
header("Location: index.php");
die();
?>