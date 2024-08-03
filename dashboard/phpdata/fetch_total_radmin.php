<?php
// fetch_count.php

// Include database connection
require "../dbcon.php"; // Ensure this path is correct for your setup

// Query to count the number of 'radmin' users
$sql = "SELECT COUNT(*) as total FROM users WHERE usertype = 'radmin'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalRadminUsers = $row['total'];

// Close the database connection
$conn->close();

// Return the count as a JSON response
echo json_encode(['totalRadminUsers' => $totalRadminUsers]);
?>
