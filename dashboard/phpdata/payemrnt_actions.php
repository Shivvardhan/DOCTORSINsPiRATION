<?php
require "../dbcon.php"; // Ensure this path is correct for your setup

// Get the action (accept or decline), sno, uid, and payment_type from the request
$action = isset($_GET['action']) ? $_GET['action'] : '';
$sno = isset($_POST['sno']) ? $_POST['sno'] : '';
$uid = isset($_POST['uid']) ? $_POST['uid'] : '';
$payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';

if (!empty($action) && !empty($sno)) {
    // Determine the new payment_status based on the action
    $status = ($action === 'accept') ? 'ACCEPTED' : 'DECLINED';

    // Begin a transaction
    $conn->begin_transaction();

    try {
        // Update the payments table
        $sql = "UPDATE payments SET payment_status = ? WHERE sno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $status, $sno);
        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }
        
        // Check payment_type and update mode table accordingly
        if ($payment_type === 'register') {
            // Insert or update the mode table based on uid
            $sql = "INSERT INTO mode (uid, register) VALUES (?, 'paid') 
                    ON DUPLICATE KEY UPDATE register = 'paid'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $uid);
        } else {
            // For other payment types, update the corresponding column
            $column = '';
            switch ($payment_type) {
                case 'application':
                    $column = 'application';
                    break;
                case 'invitation_letter':
                    $column = 'invitation_letter';
                    break;
                case 'pre_depart':
                    $column = 'pre_depart';
                    break;
                default:
                    throw new Exception('Invalid payment type');
            }
            
            // Insert or update the mode table based on uid and payment_type
            $sql = "INSERT INTO mode (uid, $column) VALUES (?, 'paid') 
                    ON DUPLICATE KEY UPDATE $column = 'paid'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('i', $uid);
        }

        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Commit the transaction
        $conn->commit();
        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        // Rollback the transaction on error
        $conn->rollback();
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    } finally {
        // Close the statement
        $stmt->close();
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request"]);
}

$conn->close();
?>
