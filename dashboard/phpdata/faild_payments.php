<?php
// Include database connection
require "../dbcon.php"; // Ensure this path is correct for your setup

// Error handling setup
ini_set('display_errors', 1); // Set to 0 in production
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log'); // Adjust this path

// Read DataTables parameters
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Base SQL query to count total records with payment_status 'DECLINED'
$sql = "SELECT COUNT(*) as total FROM payments WHERE payment_status = 'DECLINED'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalData = $row['total'];

// Filtering logic based on search input
$params = [];
$types = "";

// Initialize the where clause with the condition for payment_status 'DECLINED'
$whereClause = "WHERE payment_status = 'DECLINED'";

if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (uid LIKE ? OR name LIKE ? OR utr_number LIKE ?)";
    $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
    $types .= str_repeat("s", count($params));
}

// Count total records with applied filter
$sql = "SELECT COUNT(*) as totalFiltered FROM payments $whereClause";
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalFiltered = $row['totalFiltered'];

// Fetch the filtered data
$sql = "SELECT * FROM payments $whereClause LIMIT ?, ?";
$params = array_merge($params, [$start, $length]);
$types .= "ii"; // Add types for LIMIT parameters

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for DataTables
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        $row['uid'],
        $row['name'],
        $row['amount'],
        $row['payment_type'],
        $row['utr_number'],
        $row['transaction_date'],
        $row['transaction_time'],
        $row['upi_id'],
        $row['timestamp'],
    ];
}

// Create the response
$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
];

// Send the response as JSON
echo json_encode($response);

// Close the database connection
$conn->close();
?>
