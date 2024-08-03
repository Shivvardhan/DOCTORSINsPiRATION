<?php
require '../dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uid = $_POST['uid'];
    $fileType = $_POST['file_type'];

    // Validate file type
    $allowedTypes = ['application/pdf'];
    if (!in_array($_FILES['file']['type'], $allowedTypes)) {
        header("Location: ../edit_student_info.php?uid=$uid&status=error&message=Invalid%20file%20type");
        exit();
    }
  // Define the path to the uploads directory
  $uploadsDir = '../uploads';

  // Create the uploads directory if it doesn't exist
  if (!is_dir($uploadsDir)) {
      mkdir($uploadsDir, 0777, true);
  }

    // Generate a new file name
    $newFileName = $fileType . '_' . $uid . '_' . time() . '.pdf';
    $targetPath = '../uploads/' . $newFileName;

    // Move the uploaded file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetPath)) {
        // Update the database with the new file path
        $stmt = $conn->prepare("UPDATE users SET $fileType = ? WHERE uid = ?");
        $stmt->bind_param('si', $newFileName, $uid);

        if ($stmt->execute()) {
            header("Location: ../edit_student_info.php?uid=$uid&status=success&message=File%20uploaded%20successfully");
        } else {
            header("Location: ../edit_student_info.php?uid=$uid&status=error&message=Failed%20to%20update%20database");
        }

        $stmt->close();
    } else {
        header("Location: ../edit_student_info.php?uid=$uid&status=error&message=Failed%20to%20upload%20file");
    }
}

$conn->close();
?>
