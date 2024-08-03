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

// Base SQL query to count total records
$sql = "SELECT COUNT(*) as total FROM users WHERE usertype = 'radmin'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalData = $row['total'];

// Base where clause
$whereClause = "WHERE users.usertype = 'radmin'";
$params = [];
$types = "";

// Filtering logic based on search input
if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (CONCAT(users.fname, ' ', users.lname) LIKE ? 
                         OR users.status LIKE ?
                         OR IFNULL(courier.tracking_id, '') LIKE ?
                         OR IFNULL(courier.courier_by, '') LIKE ?
                         OR IFNULL(courier.date, '') LIKE ?)";
    $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    $types .= str_repeat("s", count($params));
}

// Count total records with applied filter
$sql = "SELECT COUNT(*) as totalFiltered FROM users 
        LEFT JOIN courier ON users.uid = courier.uid 
        $whereClause";
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalFiltered = $row['totalFiltered'];

// Fetch the filtered data
$sql = "SELECT users.uid, CONCAT(users.fname, ' ', users.lname) AS name, 
        IFNULL(courier.date, 'N/A') as date_of_courier, 
        IFNULL(courier.tracking_id, 'N/A') as tracking_id, 
        IFNULL(courier.courier_by, 'N/A') as courier_by 
        FROM users 
        LEFT JOIN courier ON users.uid = courier.uid 
        $whereClause 
        LIMIT ?, ?";
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
        $row['name'],
        $row['date_of_courier'],
        $row['tracking_id'],
        $row['courier_by'],
        '<button type="button" class="btn btn-dark edit-btn" 
        data-uid="' . $row['uid'] . '" 
        data-name="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" 
        data-date-of-courier="' . $row['date_of_courier'] . '" 
        data-tracking-id="' . $row['tracking_id'] . '" 
        data-courier-by="' . htmlspecialchars($row['courier_by'], ENT_QUOTES, 'UTF-8') . '"
        data-bs-toggle="modal" 
        data-bs-target="#editStatusModal"
        onclick="openEditModal(this)">
        <i class="fa fa-pencil-alt"></i> Edit
    </button>'
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
