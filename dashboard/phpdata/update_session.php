<?php
include '../dbcon.php';
$response = array();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the raw POST data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Validate input
    if (isset($data['session_date']) && isset($data['session_time']) && isset($data['session_address'])) {
        $session_date = $data['session_date'];
        $session_time = $data['session_time'];
        $session_address = $data['session_address'];

        // Sanitize input data
        $session_date = $conn->real_escape_string($session_date);
        $session_time = $conn->real_escape_string($session_time);
        $session_address = $conn->real_escape_string($session_address);

        // Check if a record with session_id=1 exists
        $check_sql = "SELECT * FROM session_details WHERE session_id=1";
        $result = $conn->query($check_sql);

        if ($result->num_rows > 0) {
            // Record exists, perform update
            $sql = "UPDATE session_details SET session_date='$session_date', session_time='$session_time', session_address='$session_address' WHERE session_id=1";

            if ($conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'The session has been updated successfully.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error updating record: ' . $conn->error;
            }
        } else {
            // No record found, perform insert
            $sql = "INSERT INTO session_details (session_id, session_date, session_time, session_address) VALUES (1, '$session_date', '$session_time', '$session_address')";

            if ($conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'The session has been created successfully.';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error inserting record: ' . $conn->error;
            }
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'All fields are required.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

$conn->close();
echo json_encode($response);
?>
