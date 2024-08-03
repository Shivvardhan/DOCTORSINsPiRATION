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

// Filtering logic based on search input
$whereClause = "WHERE usertype = 'radmin'";
$params = [];
$types = "";

if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (CONCAT(users.fname, ' ', users.lname) LIKE ? OR visa_details.status LIKE ?)";
    $params = array_merge($params, [$searchTerm, $searchTerm]);
    $types .= str_repeat("s", count($params));
}

// Count total records with applied filter
$sql = "SELECT COUNT(*) as totalFiltered FROM users LEFT JOIN visa_details ON users.uid = visa_details.uid $whereClause";
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
               COALESCE(visa_details.status, 'Not Processed') as status, 
               COALESCE(DATE_FORMAT(visa_details.date_of_visa_acceptance, '%d-%m-%Y'), 'XX/XX/XXXX') as date_of_visa_acceptance
        FROM users 
        LEFT JOIN visa_details ON users.uid = visa_details.uid
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
    $formattedDate = $row['date_of_visa_acceptance'];

    // Determine the badge color based on the status
    $badgeColor = '';
    switch ($row['status']) {
        case 'Not Processed':
            $badgeColor = 'badge-danger'; // RED
            break;
        case 'In Process':
            $badgeColor = 'badge-warning'; // Orange
            break;
        case 'Processed':
            $badgeColor = 'badge-success'; // Green
            break;
        default:
            $badgeColor = 'badge-secondary'; // Default Grey for unknown statuses
    }

    $data[] = [
        $row['name'],
        '<span class="badge ' . $badgeColor . ' text-white" style="font-size: 1.25rem; padding: 0.5rem;">' . $row['status'] . '</span>',
        $formattedDate,
        '<button type="button" class="btn btn-dark edit-btn" 
    data-uid="' . $row['uid'] . '" 
    data-name="' . htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') . '" 
    data-visa-status="' . htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') . '"
    data-visa-date="' . htmlspecialchars($row['date_of_visa_acceptance'], ENT_QUOTES, 'UTF-8') . '"
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
