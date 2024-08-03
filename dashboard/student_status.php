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

        .modal-content {
            border-radius: 8px;
        }

        .close {
            font-size: 1.4rem;
        }

        .form-control:disabled {
            background-color: #e9ecef;
            /* opacity: 1; */
            ;
            color: #333;
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
                            Students Status</h1>
                    </li>
                </ul>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Students</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Students Status</li>
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
                            <th scope="col">Status</th>
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



    <!-- Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editStatusForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStatusModalLabel">Edit Student Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Readonly field for displaying student ID -->
                        <div class="mb-3">
                            <label for="studentId" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentId" name="studentId" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Offer Letter">Offer Letter</option>
                                <option value="Invitation Letter">Invitation Letter</option>
                                <option value="Pre Departure">Pre Departure</option>
                                <option value="Visa Processing">Visa Processing</option>
                                <option value="Post Departure">Post Departure</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: './phpdata/student_status_data.php',
                    type: 'POST'
                },
                columns: [{
                        data: 0
                    }, // Name
                    {
                        data: 1
                    }, // Status
                    {
                        data: 2
                    }, // Actions

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


        function openEditModal(uid, currentStatus) {
            $('#studentId').val(uid);
            $('#status').val(currentStatus);
            $('#editStatusModal').modal('show');
        }

        $('#editStatusForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'update_student_status.php',
                data: formData,
                success: function(response) {
                    // Handle success response
                    $('#editStatusModal').modal('hide');
                    $('#data-table').DataTable().ajax.reload(); // Reload the DataTable
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
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