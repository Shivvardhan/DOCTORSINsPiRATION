<?php
require "../dbcon.php"; // Database connection

$response = ['success' => false, 'message' => ''];

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = isset($_POST['studentId']) ? intval($_POST['studentId']) : 0;
    $dateOfVisaAcceptance = isset($_POST['dateOfVisaAcceptance']) ? $_POST['dateOfVisaAcceptance'] : '';
    $visaStatus = isset($_POST['visaStatus']) ? $_POST['visaStatus'] : '';

    if ($studentId && $dateOfVisaAcceptance && $visaStatus) {
        // Check if the record exists
        $checkSql = "SELECT COUNT(*) as count FROM visa_details WHERE uid = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param('i', $studentId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $count = $checkResult->fetch_assoc()['count'];

        if ($count > 0) {
            // Update the existing record
            $sql = "UPDATE visa_details SET status = ?, date_of_visa_acceptance = ? WHERE uid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $visaStatus, $dateOfVisaAcceptance, $studentId);
            $message = 'Visa status updated successfully.';
        } else {
            // Insert a new record
            $sql = "INSERT INTO visa_details (uid, status, date_of_visa_acceptance) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('iss', $studentId, $visaStatus, $dateOfVisaAcceptance);
            $message = 'Visa status added successfully.';
        }

        if ($stmt->execute()) {
            // If the visa status is "Processed", update the mode table
            if ($visaStatus === 'Processed') {
                $updateModeSql = "UPDATE mode SET post_depart = 'paid' WHERE uid = ?";
                $updateModeStmt = $conn->prepare($updateModeSql);
                $updateModeStmt->bind_param('i', $studentId);
                if ($updateModeStmt->execute()) {
                    $response['success'] = true;
                    $response['message'] = $message . ' Mode updated successfully.';
                } else {
                    $response['success'] = false;
                    $response['message'] = 'Visa status updated, but failed to update mode.';
                }
                $updateModeStmt->close();
            } else {
                $response['success'] = true;
                $response['message'] = $message;
            }
        } else {
            $response['message'] = 'Database operation failed. Please try again.';
        }

        $checkStmt->close();
        $stmt->close();
    } else {
        $response['message'] = 'Invalid input data.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);