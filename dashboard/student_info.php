<?php require "./component/d_head.php";
// Code for checking the mode status
if ($mode['register'] != 'paid') {
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    exit();
}

$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {
    require "./component/menu.php";
?>

    <style>
        /* General styling */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
        }


        /* Page title styling */
        .page-title h1 {
            font-size: 24px;
            color: #18618E;
            font-weight: bold;
        }

        .breadcrumb-item {
            font-size: 14px;
            color: #6c757d;
        }

        /* Table styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background: linear-gradient(45deg, #18618E, #2A4590);
            color: white;
            font-weight: bold;
            padding: 12px;
        }

        .table tbody tr {
            background-color: #fff;
            transition: background-color 0.3s;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f7f9fc;
        }

        .table tbody tr:hover {
            background-color: #e9f5f8;
        }

        .table tbody tr td {
            padding: 12px;
            color: #333;
        }

        .table thead th,
        .table tbody td {
            border: 1px solid #dee2e6;
        }

        /* DataTables custom styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #18618E !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #18618E !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 250px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 5px;
            margin-left: 5px;
        }

        .dataTables_wrapper .dataTables_filter button {
            background-color: #18618E;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }

        .dataTables_wrapper .dataTables_filter button:hover {
            background-color: #2A4590;
        }

        /* Custom button styling */
        .btn-dark {
            background-color: #2A4590 !important;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-dark:hover {
            background-color: #1b2f5a;
        }

        .status-btn {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            border: none;
        }

        .edit-btn {
            display: inline-flex;
            align-items: center;
        }

        .edit-btn i {
            margin-right: 5px;
        }
    </style>

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!-- Toolbar container -->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!-- Page title -->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Students Information</h1>
                    </li>
                </ul>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Students</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Students Information</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Phone No.</th>
                            <th scope="col">Status</th>
                            <th scope="col">Fees Paid</th>
                            <th scope="col">Date of Registration</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data to be populated via DataTables -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: './phpdata/student_info_data.php',
                    type: 'POST'
                },
                columns: [
                    { data: 0 }, // Name
                    { data: 1 }, // Phone No.
                    { data: 2 }, // Status
                    { data: 3 }, // Fees Paid
                    { data: 4 }, // Date of Registration
                    { data: 5 }  // Actions
                ],
                language: {
                    paginate: {
                        first: 'First',
                        previous: 'Previous',
                        next: 'Next',
                        last: 'Last'
                    },
                    search: 'Filter:',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries'
                }
            });

            // Custom search button functionality
            $('.dataTables_filter button').on('click', function() {
                table.search($('.dataTables_filter input').val()).draw();
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>
