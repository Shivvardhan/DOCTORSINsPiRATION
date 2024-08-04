<?php
include '../dbcon.php';
$response = array();

$sql = "DELETE FROM session_details WHERE session_id=1";

if ($conn->query($sql) === TRUE) {
    $response['status'] = 'success';
    $response['message'] = 'The session has been deleted successfully.';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error deleting record: ' . $conn->error;
}

$conn->close();
echo json_encode($response);
?>
