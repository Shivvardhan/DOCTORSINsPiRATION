<?php
// Include database connection
require "../dbcon.php"; // Ensure this path is correct for your setup

// Directory to save uploaded files
$uploadDir = '../uploads/';

// Ensure the directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Define the letter type
$letterType = 'OFFER_LETTER';

// Check if the form is submitted and the file is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['offerLetterUpload'])) {
    $studentId = $_POST['studentId'];
    $uploadFile = $_FILES['offerLetterUpload'];
    
    // Validate file upload
    if ($uploadFile['error'] === UPLOAD_ERR_OK) {
        // Generate a unique file name
        $fileExtension = pathinfo($uploadFile['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $fileExtension;
        $filePath = $uploadDir . $fileName;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($uploadFile['tmp_name'], $filePath)) {
            // Check if a record with this UID and letter_type exists
            $checkSql = "SELECT * FROM letters WHERE uid = ? AND letter_type = ?";
            $stmt = $conn->prepare($checkSql);
            $stmt->bind_param('is', $studentId, $letterType);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Record exists, update it
                $sql = "UPDATE letters SET status = ?, file = ? WHERE uid = ? AND letter_type = ?";
                $stmt = $conn->prepare($sql);
                $status = 'Uploaded';
                $stmt->bind_param('ssis', $status, $fileName, $studentId, $letterType);
            } else {
                // No record exists, insert a new one
                $sql = "INSERT INTO letters (uid, status, file, letter_type) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $status = 'Uploaded';
                $stmt->bind_param('isss', $studentId, $status, $fileName, $letterType);
            }
            
            // Execute the insert/update statement
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'File uploaded and status updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Database update failed.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No file uploaded or upload error occurred.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}

// Close the database connection
$conn->close();
