<?php
// Include database connection
require "../dbcon.php"; // Ensure this path is correct for your setup

// Initialize response array
$response = ['success' => false, 'status' => ''];

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract the student ID
    $studentId = isset($_POST['studentId']) ? intval($_POST['studentId']) : 0;

    // Check if the file was uploaded
    if (isset($_FILES['offerLetterUpload']) && $_FILES['offerLetterUpload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['offerLetterUpload']['tmp_name'];
        $fileName = $_FILES['offerLetterUpload']['name'];
        $fileSize = $_FILES['offerLetterUpload']['size'];
        $fileType = $_FILES['offerLetterUpload']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validate file type (example: PDF)
        $allowedExtensions = ['pdf'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Generate a unique file name
            $randomNumber = rand(1000, 9999); // Generate a random number
            $newFileName = 'invitation_letter_' . $studentId . '_' . $randomNumber . '.' . $fileExtension;

            // Define the upload path
            $uploadFileDir = '../uploads/';
            $dest_path = $uploadFileDir . $newFileName;

            // Move the file to the destination directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Check if the record exists
                $checkSql = "SELECT COUNT(*) as count FROM letters WHERE uid = ? AND letter_type = 'INVITATION_LETTER'";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->bind_param('i', $studentId);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();
                $count = $checkResult->fetch_assoc()['count'];

                // Determine whether to update or insert
                if ($count > 0) {
                    // Update the existing record
                    $sql = "UPDATE letters SET file = ?, status = 'Uploaded' WHERE uid = ? AND letter_type = 'INVITATION_LETTER'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('si', $newFileName, $studentId);
                } else {
                    // Insert a new record
                    $sql = "INSERT INTO letters (uid, file, letter_type, status) VALUES (?, ?, 'INVITATION_LETTER', 'Uploaded')";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('is', $studentId, $newFileName);
                }

                // Execute the SQL statement
                if ($stmt->execute()) {
                    $response['success'] = true;
                    $response['status'] = $count > 0 ? 'Updated successfully' : 'Inserted successfully';
                } else {
                    $response['status'] = 'Database operation failed. Please try again.';
                }

                // Close the check statement
                $checkStmt->close();
            } else {
                $response['status'] = 'Failed to move uploaded file.';
            }
        } else {
            $response['status'] = 'Invalid file type. Only PDF files are allowed.';
        }
    } else {
        $response['status'] = 'No file uploaded or upload error.';
    }

    // Close the statement if it was created
    if (isset($stmt)) {
        $stmt->close();
    }
}

// Close the database connection
$conn->close();

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
