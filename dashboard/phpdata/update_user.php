<?php
// Include your database connection file
require '../dbcon.php';

// Check if the form is submitted
if (isset($_POST['update_personal'])) {
    // Retrieve the data from the form
    $uid = isset($_POST['uid']) ? $_POST['uid'] : null; // Assuming uid is passed as a hidden input
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $completionYear = $_POST['12_year_of_completeion'];
    $totalMarks12th = $_POST['12_total_marks_scored'];
    $neetYear = $_POST['neet_qualification_year'];
    $neetMarks = $_POST['neet_total_marks_scored'];
    $itlsQualification = $_POST['ilt_exam_qualification'];

    // Ensure the uid is provided
    if (!$uid) {
        // Redirect to edit_student_info.php with error message
        header("Location: ../edit_student_info.php?status=error&message=No%20user%20ID%20provided");
        exit();
    }

    // Prepare the update query
    $stmt = $conn->prepare("UPDATE users SET fname = ?,lname = ?, phone = ?, email = ?, address_one = ?, 12_year_of_completeion = ?, 12_total_marks_scored = ?, neet_qualification_year = ?, neet_total_marks_scored = ?, ilt_exam_qualification = ? WHERE uid = ?");
    $stmt->bind_param('ssssssssssi', $fname, $lname, $phone, $email, $address, $completionYear, $totalMarks12th, $neetYear, $neetMarks, $itlsQualification, $uid);

    // Execute the update query
    if ($stmt->execute()) {
        // Redirect to edit_student_info.php with success message
        header("Location: ../edit_student_info.php?uid={$uid}&status=success&message=User%20details%20updated%20successfully");
    } else {
        // Redirect to edit_student_info.php with error message
        header("Location: ../edit_student_info.php?uid={$uid}&status=error&message=Failed%20to%20update%20user%20details");
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
