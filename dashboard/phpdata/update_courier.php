<?php
// Include database connection
require "../dbcon.php"; // Ensure this path is correct for your setup

// Error handling setup
ini_set('display_errors', 1); // Set to 0 in production
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log'); // Adjust this path

// Read form data
$studentId = $_POST['studentId'];
$dateOfCourier = $_POST['dateOfCourier'];
$trackingId = $_POST['trackingId'];
$courierBy = $_POST['courierBy'];

// Check if UID exists in the courier table
$sql = "SELECT COUNT(*) as count FROM courier WHERE uid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['count'] > 0) {
    // Update existing record
    $sql = "UPDATE courier SET date = ?, tracking_id = ?, courier_by = ? WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $dateOfCourier, $trackingId, $courierBy, $studentId);
} else {
    // Insert new record
    $sql = "INSERT INTO courier (uid, date, tracking_id, courier_by) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $studentId, $dateOfCourier, $trackingId, $courierBy);
}

if ($stmt->execute()) {
    // Success
    echo json_encode(['status' => 'success', 'message' => 'Record updated successfully.']);
} else {
    // Error
    echo json_encode(['status' => 'error', 'message' => 'Failed to update record.']);
}

// Close the database connection
$stmt->close();
$conn->close();
?>
