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

// Define the letter type
$letterType = 'INVITATION_LETTER';

// Base SQL query to count total records
$sql = "SELECT COUNT(*) as total FROM users WHERE usertype = 'radmin'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalData = $row['total'];

// Filtering logic based on search input
$whereClause = "WHERE u.usertype = 'radmin'";
$params = [];
$types = "";

// Prepare the search filter if applicable
if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (CONCAT(u.fname, ' ', u.lname) LIKE ? OR IFNULL(o.status, 'Not Uploaded') LIKE ?)";
    $params = array_merge($params, [$searchTerm, $searchTerm]);
    $types .= str_repeat("s", count($params)); // Add 's' for each search parameter
}

// Count total records with applied filter
$sql = "SELECT COUNT(*) as totalFiltered FROM users u
        LEFT JOIN letters o ON u.uid = o.uid AND o.letter_type = ?
        $whereClause";
$stmt = $conn->prepare($sql);

// Bind parameters including letter_type for filtering
if (!empty($params)) {
    array_unshift($params, $letterType); // Add letter_type as the first parameter
    $stmt->bind_param($types . 's', ...$params); // Append 's' for letter_type
} else {
    $stmt->bind_param('s', $letterType);
}
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalFiltered = $row['totalFiltered'];

// Fetch the filtered data
$sql = "SELECT u.uid, CONCAT(u.fname, ' ', u.lname) AS name, 
        IFNULL(o.status, 'Not Uploaded') as status, 
        u.timestamp, 
        o.file
        FROM users u
        LEFT JOIN letters o ON u.uid = o.uid AND o.letter_type = ?
        $whereClause LIMIT ?, ?";
$params = array_merge([$letterType], $params, [$start, $length]);
$types = 'sii'; // Add 's' for letter_type and 'ii' for LIMIT parameters

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params); // Correct binding of parameters
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for DataTables
$data = [];
while ($row = $result->fetch_assoc()) {
    $formattedDate = date('d-m-Y', strtotime($row['timestamp']));
    $status = $row['status'];
    $statusClass = ($status === 'Uploaded') ? 'badge bg-success text-white' : 'badge bg-danger text-white';
    
    $data[] = [
        $row['name'],
        '<span class="' . $statusClass . '" style="font-size: 1.25rem; padding: 0.5rem;">' . $status . '</span>',
        $formattedDate,
        '<button type="button" class="btn btn-dark edit-btn" 
        data-uid="' . $row['uid'] . '" 
        data-name="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" 
        data-registration-date="' . $formattedDate . '" 
        data-bs-toggle="modal" 
        data-bs-target="#editStatusModal"
        onclick="openEditModal(this)">
        <i class="fa fa-pencil-alt"></i> Edit
    </button>' .
    (!empty($row['file']) ? 
    '<a href="./uploads/' . htmlspecialchars($row['file'], ENT_QUOTES, 'UTF-8') . '" target="_blank" class="btn btn-secondary view-pdf-btn" role="button">
        <i class="fa fa-file-pdf"></i> View PDF
    </a>' : '')
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
