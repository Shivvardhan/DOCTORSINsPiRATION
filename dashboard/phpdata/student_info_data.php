<?php
require "../dbcon.php";

// Error handling setup
ini_set('display_errors', 1); // Set to 0 in production
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log'); // Adjust this path

// Get the total number of records without any search
$sql = "SELECT COUNT(*) as total FROM users WHERE usertype = 'radmin'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalData = $row['total'];

// Read values from the DataTables request
$draw = isset($_POST['draw']) ? intval($_POST['draw']) : 0;
$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
$search = isset($_POST['search']['value']) ? $_POST['search']['value'] : '';

// Filtering
$whereClause = "WHERE usertype = 'radmin'";
$params = [];
$types = "";

if (!empty($search)) {
    $searchTerm = "%$search%";
    $whereClause .= " AND (CONCAT(fname, ' ', lname) LIKE ? OR phone LIKE ? OR status LIKE ? OR timestamp LIKE ?)";
    $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    $types .= str_repeat("s", count($params));
}

// Get the filtered number of records
$sql = "SELECT COUNT(*) as totalFiltered FROM users $whereClause";
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$totalFiltered = $row['totalFiltered'];

// Updated query to include the necessary columns from the mode table
$sql = "SELECT u.uid, CONCAT(u.fname, ' ', u.lname) AS name, u.phone, 
               m.register, m.application, m.invitation_letter, m.pre_depart,
               0.00 as fees_paid, u.timestamp as date_of_registration 
        FROM users u
        LEFT JOIN mode m ON u.uid = m.uid
        $whereClause LIMIT ?, ?";

// Add LIMIT parameters to $params array and types
$params = array_merge($params, [$start, $length]);
$types .= "ii";

// Prepare and execute the SQL statement
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    // Determine the status based on the conditions
    $status = 'UnActive'; // Default status
    $fees = '0';

    if ($row['register'] != "paid") {
        $status = 'UnActive'; // Default status
        $fees = '0';
    } elseif ($row['application'] != "paid") {
        $status = "Registered";
        $fees = '10,000';    
    } elseif ($row['invitation_letter'] != "paid") {
        $status = "Offer Letter";
        $fees = '60,000';  
    } elseif ($row['pre_depart'] != "paid") {
        $status = "Invitation Letter";
        $fees = '110,000';
    } elseif ($row['pre_depart'] == "paid") {
        $status = "Pre-Departure";
        $fees = '110,000';
    } else {
        $status = "Post-Departure";
        $fees = '110,000';
    }
    

    // Format the date
    $formattedDate = date('d-m-Y', strtotime($row['date_of_registration']));

    // Add the data to the array
    $data[] = [
        $row['name'],
        $row['phone'],
        '<button type="button" class="btn btn-dark status-btn">'.$status.'</button>', // Use dynamic status
        $fees,
        $formattedDate, // Use the formatted date here
        '<a href="edit_student_info.php?uid='.$row['uid'].'" class="btn btn-dark edit-btn">
            <i class="fa fa-pencil-alt"></i> Edit
        </a>'
    ];
}

// Prepare the response in JSON format
$response = [
    "draw" => intval($draw),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
];

$jsonResponse = json_encode($response);

if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("JSON encoding error: " . json_last_error_msg());
    // Handle the error appropriately
    echo json_encode(["error" => "JSON encoding error"]);
} else {
    echo $jsonResponse;
}

$conn->close();
?>