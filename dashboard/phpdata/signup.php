<?php
header('Content-Type: application/json');
include "../dbcon.php";

// Check connection
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect registration form data
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $address_one = $_POST['address'] ?? '';
    $address_two = $_POST['address_two'] ?? '';
    $year_of_completion = $_POST['year-of-completion'] ?? '';
    $total_marks = $_POST['total-marks'] ?? '';
    $ilts_qualification = $_POST['ilts-qualification'] ?? '';
    $neet_year = $_POST['neet-year'] ?? '';
    $neet_marks = $_POST['neet-marks'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = md5($_POST['password']);

    // Full name concatenation
    $full_name = trim($fname . ' ' . $lname);

    // Collect payment form data
    $payment_name = $_POST['name'] ?? $full_name; // Use full name by default if payment name is not provided
    $amount = $_POST['amount'] ?? 0;
    $utr = $_POST['utr'] ?? '';
    $tdate = $_POST['tdate'] ?? '';
    $ttime = $_POST['ttime'] ?? '';
    $upi = $_POST['upi'] ?? '';

    // Combine date and time into separate variables
    $transaction_date = $tdate;
    $transaction_time = $ttime;

    // Define the uploads directory
    $uploads_dir = "../uploads/";

    // Function to generate a unique file name
    function generateFileName($fileType, $uid)
    {
        return $fileType . '_' . $uid . '_' . time() . '.pdf';
    }

    // Function to handle file uploads
    function handleFileUpload($fileInputName, $fileType, $uid, $uploads_dir, $conn)
    {
        if (!empty($_FILES[$fileInputName]['name'])) {
            $fileName = generateFileName($fileType, $uid);
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $uploads_dir . $fileName)) {
                // Update the file name in the database
                $sql_update = "UPDATE users SET " . $fileType . "_pdf = ? WHERE uid = ?";
                if ($stmt = $conn->prepare($sql_update)) {
                    $stmt->bind_param("si", $fileName, $uid);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    throw new Exception('Database preparation failed for ' . $fileType . ' update! Error: ' . $conn->error);
                }
                return $fileName;
            } else {
                throw new Exception('Failed to upload ' . $fileType . '.');
            }
        }
        return '';
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Insert user data into the users table
        $sql_registration = "INSERT INTO users (username, r_name, email, phone, password, fname, lname, address_one, address_two, 12_year_of_completeion, 12_total_marks_scored, ilt_exam_qualification, neet_qualification_year, neet_total_marks_scored, hsc_marksheet_pdf, neet_marksheet_pdf, passport_pdf, usertype, status)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'radmin', 'active')";
        if ($stmt = $conn->prepare($sql_registration)) {
            $stmt->bind_param("sssisssssiissssss", $email, $full_name, $email, $mobile, $password, $fname, $lname, $address_one, $address_two, $year_of_completion, $total_marks, $ilts_qualification, $neet_year, $neet_marks, $hsc_marksheet, $neet_marksheet, $passport);
            if (!$stmt->execute()) {
                throw new Exception('Failed to register! Error: ' . $stmt->error);
            }

            // Retrieve the last inserted user ID
            $uid = $stmt->insert_id;
            $stmt->close();
        } else {
            throw new Exception('Database preparation failed for registration! Error: ' . $conn->error);
        }

        // Handle file uploads
        $hsc_marksheet = handleFileUpload('fileInputHsc', 'hsc_marksheet', $uid, $uploads_dir, $conn);
        $neet_marksheet = handleFileUpload('fileInputNeet', 'neet_marksheet', $uid, $uploads_dir, $conn);
        $passport = handleFileUpload('fileInputPassport', 'passport', $uid, $uploads_dir, $conn);

        // Insert payment data into the payments table
        $sql_payment = "INSERT INTO payments (uid, name, amount, utr_number, transaction_date, transaction_time, upi_id)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql_payment)) {
            $stmt->bind_param("issssss", $uid, $payment_name, $amount, $utr, $transaction_date, $transaction_time, $upi);
            if (!$stmt->execute()) {
                throw new Exception('Failed to record payment! Error: ' . $stmt->error);
            }
            $stmt->close();
        } else {
            throw new Exception('Database preparation failed for payment! Error: ' . $conn->error);
        }

        // Commit the transaction
        $conn->commit();
        $response['status'] = 'success';
        $response['message'] = 'Registration and payment completed successfully!';
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }

    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method!';
}

echo json_encode($response);