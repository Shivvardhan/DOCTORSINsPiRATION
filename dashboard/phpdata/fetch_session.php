<?php
include './dbcon.php';

$sql = "SELECT * FROM session_details LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $session_date = $row['session_date'];

    // Format time to 12-hour format with AM/PM
    $session_time = DateTime::createFromFormat('H:i:s', $row['session_time'])->format('h:i A');
    
    $session_address = $row['session_address'];
} else {
    $session_date = "";
    $session_time = "";
    $session_address = "";
}

$conn->close();
?>
