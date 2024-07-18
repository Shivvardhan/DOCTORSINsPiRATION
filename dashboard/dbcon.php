<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'doctor';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

$stmt = $conn->prepare("SELECT * FROM `mode` WHERE `uid` = ?");
$stmt->bind_param('s', $_SESSION['uid']);
$stmt->execute();
$result = $stmt->get_result();
$mode = $result->fetch_assoc();

if ($conn->connect_error) {
  die('Database connection failed: ' . $db->connect_error);
}
date_default_timezone_set("Asia/Calcutta"); 
?>