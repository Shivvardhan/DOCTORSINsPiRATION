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
                            Passport Courier</h1>
                    </li>
                </ul>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Visa Processing</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Passport Courier</li>
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
                            <th scope="col">Date of Courier</th>
                            <th scope="col">Tracking ID</th>
                            <th scope="col">Courier By</th>
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
                        <h5 class="modal-title" id="editStatusModalLabel">Passport Courier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Hidden field for storing student ID -->
                        <input type="hidden" id="studentId" name="studentId">

                        <!-- Full Name Field (Disabled) -->
                        <div class="mb-3">
                            <label for="studentName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="studentName" name="studentName" disabled>
                        </div>

                        <!-- Student ID Field (Disabled) -->
                        <div class="mb-3">
                            <label for="studentUID" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="studentUID" name="studentUID" disabled>
                        </div>

                        <!-- Date of Courier Field -->
                        <div class="mb-3">
                            <label for="dateOfCourier" class="form-label">Date of Courier</label>
                            <input type="date" class="form-control" id="dateOfCourier" name="dateOfCourier">
                        </div>

                        <!-- Tracking ID Field -->
                        <div class="mb-3">
                            <label for="trackingId" class="form-label">Tracking ID</label>
                            <input type="text" class="form-control" id="trackingId" name="trackingId">
                        </div>

                        <!-- Courier By Field -->
                        <div class="mb-3">
                            <label for="courierBy" class="form-label">Courier By</label>
                            <input type="text" class="form-control" id="courierBy" name="courierBy">
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
                    url: './phpdata/passport_courier_data.php',
                    type: 'POST'
                },
                columns: [{
                        data: 0
                    },
                    {
                        data: 1
                    },
                    {
                        data: 2
                    },
                    {
                        data: 3
                    },
                    {
                        data: 4
                    }
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

            // Debounce function to delay the search
            function debounce(fn, delay) {
                var timeoutID;
                return function() {
                    var args = arguments;
                    clearTimeout(timeoutID);
                    timeoutID = setTimeout(function() {
                        fn.apply(null, args);
                    }, delay);
                };
            }

            // Custom search input with debounce
            $('.dataTables_filter input')
                .off('keyup') // Remove default handler
                .on('keyup', debounce(function() {
                    table.search(this.value).draw();
                }, 500)); // 500ms debounce delay
        });

        // Function to open the modal and populate the fields
        function openEditModal(button) {
            var studentId = button.getAttribute('data-uid');
            var studentName = button.getAttribute('data-name');
            var dateOfCourier = button.getAttribute('data-date-of-courier');
            var trackingId = button.getAttribute('data-tracking-id');
            var courierBy = button.getAttribute('data-courier-by');

            document.getElementById('studentId').value = studentId;
            document.getElementById('studentName').value = studentName;
            document.getElementById('studentUID').value = studentId; // Assuming UID is same as studentId
            document.getElementById('dateOfCourier').value = dateOfCourier;
            document.getElementById('trackingId').value = trackingId;
            document.getElementById('courierBy').value = courierBy;
        }

        // Handle form submission with AJAX
        document.getElementById('editStatusForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var formData = new FormData(this);

            fetch('./phpdata/update_courier.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Close the modal
                            var modal = bootstrap.Modal.getInstance(document.getElementById('editStatusModal'));
                            if (modal) {
                                modal.hide();
                            } else {
                                // Fallback if modal instance is not found
                                document.getElementById('editStatusModal').classList.remove('show');
                                document.getElementById('editStatusModal').style.display = 'none';
                                document.querySelector('.modal-backdrop').remove();
                            }

                            // Refresh the page
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    console.error('Error:', error);
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