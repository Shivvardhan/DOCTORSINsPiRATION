<?php
require "./component/d_head.php";
//Code for checking the mode status
if ($mode['register'] != 'paid') {
    echo '<script type="text/javascript">';
    echo 'window.location.href = "index.php";';
    echo '</script>';
    exit();
}
$uid = isset($_GET['uid']) ? $_GET['uid'] : null;
if (!$uid) {
    echo "<script>alert('No user ID provided.'); window.location.href='dash.php';</script>";
    exit();
}

$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {
    require "./component/menu.php";



    // Fetch the user's data from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        echo "<script>alert('User not found.'); window.location.href='index.php';</script>";
        exit();
    }
?>

    <style>
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 0;
            color: #166572;
            text-decoration: none;
        }

        .sidebar a i {
            margin-right: 8px;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #B5C8C9;
            padding-left: 10px;
            border-radius: 5px;
        }

        .custom-header {
            background-color: #166572;
            color: white;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            background-color: #DFE7E8;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            color: #166572;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #166572;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, padding-left 0.3s;
        }

        .sidebar a:hover {
            background-color: #B5C8C9;
            padding-left: 20px;
        }



        .table {
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .table td {
            text-transform: uppercase;
        }

        .table th,
        .table td {
            border: none;
            padding: 12px 15px;
        }

        .table thead {
            background-color: #166572;
            color: white;
        }

        .table thead th:first-child {
            border-top-left-radius: 8px;
        }

        .table thead th:last-child {
            border-top-right-radius: 8px;
        }

        .table tbody tr:last-child td:first-child {
            border-bottom-left-radius: 8px;
        }

        .table tbody tr:last-child td:last-child {
            border-bottom-right-radius: 8px;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }

        .pdf-type {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            background-color: #EDE9FE;
            color: #333;
        }



        .btn-primary {
            background-color: #166572;
            border-color: #166572;
        }

        .btn-secondary {
            background-color: #DFE7E8;
            border-color: #DFE7E8;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            opacity: 0.8;
        }

        .step {
            margin-bottom: 20px;
        }

        .step h4 {
            color: #555;
            margin-top: 0;
        }

        .step p {
            margin: 5px 0;
        }

        .step ul {
            margin: 0;
            padding-left: 20px;
        }

        .step ul li {
            margin-bottom: 10px;
        }
    </style>
    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.getElementById('personal-details').style.display = 'none';
            document.getElementById('document-details').style.display = 'none';
            document.getElementById('enrollement-process').style.display = 'none';
            // Show the selected section
            document.getElementById(sectionId).style.display = 'block';
        }

        window.onload = function() {
            showSection('personal-details');

            // Check for status and message in the URL
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            const message = urlParams.get('message');
            const uid = urlParams.get('uid'); // Retrieve uid from URL

            if (status && message) {
                Swal.fire({
                    icon: status === 'success' ? 'success' : 'error',
                    title: status === 'success' ? 'Success' : 'Error',
                    text: decodeURIComponent(message),
                }).then(() => {
                    // Refresh the form/page after the alert is closed
                    if (status === 'success' && uid) {
                        // Clear the URL parameters except for uid to prevent the alert from showing again on refresh
                        window.history.replaceState({}, document.title, window.location.pathname + '?uid=' + encodeURIComponent(uid));
                        location.reload();
                    }
                });
            }
        };
    </script>

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->

                    <li class="breadcrumb-item">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Edit Students Information</h1>
                    </li>

                    <!-- <li class="breadcrumb-item text-muted"><img src="assets/media/stock/etc/live.png" width="60px"> </li> -->
                    <!--end::Item-->
                </ul>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">Students</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">Edit Students Information</li>
                </ul>
                <!--end::Breadcrumb-->

            </div>

        </div>
        <!--end::Toolbar container-->
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-8 mb-xl-6">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3 mb-4">
                        <div class="sidebar">
                            <h4 class="mb-4">Navigation</h4>
                            <!-- <?php // print_r($user);
                                    ?> -->
                            <a href="#" onclick="showSection('personal-details')">
                                <i class="fas fa-user"></i> Personal
                            </a>
                            <a href="#" onclick="showSection('document-details')">
                                <i class="fas fa-file-alt"></i> Document
                            </a>
                            <?php if ($_SESSION['usertype'] === 'radmin') { ?>
                                <a href="#" onclick="showSection('enrollement-process')">
                                    <i class="fas fa-file"></i> Enrollement Process
                                </a>
                            <?php } ?>

                        </div>
                    </div>

                    <!-- Main content -->
                    <div class="col-md-9">
                        <!-- Personal Details Section -->
                        <div id="personal-details">
                            <h2>Personal Details</h2>
                            <div class="custom-header">
                                <h3 class="text-light">My Details</h3>
                            </div>
                            <form class="mt-5" method="POST" action="./phpdata/update_user.php">
                                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($user['uid']); ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" id="name" name="fname" value="<?php echo htmlspecialchars($user['fname']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name">Last Name</label>
                                        <input type="text" class="form-control" id="name" name="lname" value="<?php echo htmlspecialchars($user['lname']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                    echo "disabled";
                                                                                                                                                                } ?>>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mobileNo">Mobile No.</label>
                                        <input type="text" class="form-control" id="mobileNo" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                        echo "disabled";
                                                                                                                                                                    } ?>>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                        echo "disabled";
                                                                                                                                                                    } ?>>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($user['address_one']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                                echo "disabled";
                                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="completionYear">12th Year Of Completion</label>
                                        <select class="form-control" id="completionYear" name="12_year_of_completeion" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                            echo "disabled";
                                                                                                                        } ?>>
                                            <?php
                                            // Example range of years
                                            for ($year = 2010; $year <= date('Y'); $year++) {
                                                $selected = ($user['12_year_of_completeion'] == $year) ? 'selected' : '';
                                                echo "<option value=\"$year\" $selected>$year</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="totalMarks12th">12th Total Marks Scored</label>
                                        <input type="text" class="form-control" id="totalMarks12th" name="12_total_marks_scored" value="<?php echo htmlspecialchars($user['12_total_marks_scored']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                                                                echo "disabled";
                                                                                                                                                                                                            } ?>>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="neetYear">NEET Qualification Year</label>
                                        <select class="form-control" id="neetYear" name="neet_qualification_year" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                        echo "disabled";
                                                                                                                    } ?>>
                                            <?php
                                            // Example range of years
                                            for ($year = 2010; $year <= date('Y'); $year++) {
                                                $selected = ($user['neet_qualification_year'] == $year) ? 'selected' : '';
                                                echo "<option value=\"$year\" $selected>$year</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="neetMarks">NEET Total Marks Scored</label>
                                        <input type="text" class="form-control" id="neetMarks" name="neet_total_marks_scored" value="<?php echo htmlspecialchars($user['neet_total_marks_scored']); ?>" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                                                                                            echo "disabled";
                                                                                                                                                                                                        } ?>>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="itlsQualification">ITLS Exam Qualification</label>
                                        <select class="form-control" id="itlsQualification" name="ilt_exam_qualification" <?php if ($_SESSION['usertype'] === 'radmin') {
                                                                                                                                echo "disabled";
                                                                                                                            } ?>>
                                            <option value="Passed" <?php if ($user['ilt_exam_qualification'] == 'Passed') echo 'selected'; ?>>Passed</option>
                                            <option value="Failed" <?php if ($user['ilt_exam_qualification'] == 'Failed') echo 'selected'; ?>>Failed</option>
                                            <option value="Not Attempted" <?php if ($user['ilt_exam_qualification'] == 'Not Attempted') echo 'selected'; ?>>Not Attempted</option>
                                        </select>
                                    </div>

                                </div>
                                <?php if ($_SESSION['usertype'] !== 'radmin') { ?>
                                    <button type="submit" class="btn btn-primary" name="update_personal" style="background-color: #166572;">Update</button>
                                <?php            } ?>

                            </form>
                        </div>

                        <!-- Document Details Section -->
                        <div id="document-details" style="display: none;">
                            <h2>Document Details</h2>
                            <div class="custom-header">
                                <h3 class="text-light">My Documents</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mt-5">
                                    <thead>
                                        <tr>
                                            <th>My Documents</th>
                                            <th>Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo !empty($user['hsc_marksheet_pdf']) ? htmlspecialchars($user['hsc_marksheet_pdf']) : 'HSC Marksheet'; ?></td>
                                            <td><span class="pdf-type">PDF</span></td>
                                            <td>
                                                <div style="display: flex; gap: 10px;">
                                                    <?php if (!empty($user['hsc_marksheet_pdf'])) : ?>
                                                        <a href="<?php echo './uploads/' . htmlspecialchars($user['hsc_marksheet_pdf']); ?>" class="btn btn-primary btn-sm" title="Download HSC Marksheet" download>
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if ($_SESSION['usertype'] !== 'radmin') : ?>
                                                        <form id="uploadFormHsc" action="./phpdata/upload_user_docs.php" method="POST" enctype="multipart/form-data" style="display: flex;">
                                                            <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
                                                            <input type="hidden" name="file_type" value="hsc_marksheet_pdf">
                                                            <input type="file" name="file" id="fileInputHsc" accept="application/pdf" style="display: none;">
                                                            <button type="button" class="btn btn-secondary btn-sm" title="Upload" onclick="document.getElementById('fileInputHsc').click();">
                                                                <i class="fas fa-upload"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>

                                                <script>
                                                    document.getElementById('fileInputHsc').addEventListener('change', function() {
                                                        document.getElementById('uploadFormHsc').submit();
                                                    });
                                                </script>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><?php echo !empty($user['neet_marksheet_pdf']) ? htmlspecialchars($user['neet_marksheet_pdf']) : 'Neet marksheet'; ?></td>
                                            <td><span class="pdf-type">PDF</span></td>
                                            <td>
                                                <div style="display: flex; gap: 10px;">
                                                    <?php if (!empty($user['neet_marksheet_pdf'])) : ?>
                                                        <a href="<?php echo './uploads/' . htmlspecialchars($user['neet_marksheet_pdf']); ?>" class="btn btn-primary btn-sm" title="Download NEET Marksheet" download>
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if ($_SESSION['usertype'] !== 'radmin') : ?>
                                                        <form id="uploadFormNeet" action="./phpdata/upload_user_docs.php" method="POST" enctype="multipart/form-data" style="display: flex;">
                                                            <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
                                                            <input type="hidden" name="file_type" value="neet_marksheet_pdf">
                                                            <input type="file" name="file" id="fileInputNeet" accept="application/pdf" style="display: none;">
                                                            <button type="button" class="btn btn-secondary btn-sm" title="Upload" onclick="document.getElementById('fileInputNeet').click();">
                                                                <i class="fas fa-upload"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>

                                                <script>
                                                    document.getElementById('fileInputNeet').addEventListener('change', function() {
                                                        document.getElementById('uploadFormNeet').submit();
                                                    });
                                                </script>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td><?php echo !empty($user['passport_pdf']) ? htmlspecialchars($user['passport_pdf']) : 'Passport'; ?></td>
                                            <td><span class="pdf-type">PDF</span></td>
                                            <td>
                                                <div style="display: flex; gap: 10px;">
                                                    <?php if (!empty($user['passport_pdf'])) : ?>
                                                        <a href="<?php echo './uploads/' . htmlspecialchars($user['passport_pdf']); ?>" class="btn btn-primary btn-sm" title="Download Passport" download>
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if ($_SESSION['usertype'] !== 'radmin') : ?>
                                                        <form id="uploadFormPassport" action="./phpdata/upload_user_docs.php" method="POST" enctype="multipart/form-data" style="display: flex;">
                                                            <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
                                                            <input type="hidden" name="file_type" value="passport_pdf">
                                                            <input type="file" name="file" id="fileInputPassport" accept="application/pdf" style="display: none;">
                                                            <button type="button" class="btn btn-secondary btn-sm" title="Upload" onclick="document.getElementById('fileInputPassport').click();">
                                                                <i class="fas fa-upload"></i>
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div>

                                                <script>
                                                    document.getElementById('fileInputPassport').addEventListener('change', function() {
                                                        document.getElementById('uploadFormPassport').submit();
                                                    });
                                                </script>
                                            </td>

                                        </tr>
                                        <!-- Add more rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?php if ($_SESSION['usertype'] === 'radmin') { ?>
                            <div id="enrollement-process" style="display: none;">
                                <div class="custom-header">
                                    <h3 class="text-light">Enrollment Process</h3>
                                </div>
                                <div class="step">
                                    <h4>Step 1: Log in to Your Personal Dashboard</h4>
                                    <p>Begin your journey by logging in to your Personal Dashboard on the Doctor's Inspiration website. Here, you will register yourself and submit the necessary documents required to obtain your offer letter. Please note that a registration fee of <b>INR 10,000</b> is required for university registration.</p>
                                </div>
                                <div class="step">
                                    <h4>Step 2: Receive Your Offer Letter</h4>
                                    <p>Once we process your documents, you will receive your personal offer letter, delivered directly to your email, WhatsApp, and available on your Personal Dashboard. This is an important milestone in your educational journey! After receiving your offer letter, you will need to pay <b>INR 50,000</b> to unlock your invitation letter and proceed with the next steps.</p>
                                </div>
                                <div class="step">
                                    <h4>Step 3: Await Your Invitation Letter</h4>
                                    <p>After receiving your offer letter, please be prepared to wait for your invitation letter, which usually takes <b>20-40 days</b> to arrive. This invitation letter is crucial for your visa application process. Upon receiving your invitation letter, you will be required to pay <b>INR 50,000</b> for visa assistance. We are pleased to inform you that almost <b>85% of your customer service needs are covered </b>before your departure.</p>
                                </div>
                                <div class="step">
                                    <h4>Step 4: Pre-Departure Seminar</h4>
                                    <p>As your departure date approaches, you’ll receive an invitation to a pre-departure seminar. This event will include your fellow classmates who will be traveling with you, providing a fantastic opportunity to make friends and connect with your future peers!</p>
                                </div>
                                <div class="step">
                                    <h4>Step 5: Post-Departure Instructions</h4>
                                    <p>Upon your arrival in your chosen country, you will need to complete a few essential tasks. This includes paying your university fees, registering for your hostel, and settling any customs services, as briefly outlined in your Personal Dashboard. At this stage, you will take care of payments for your dedicated university fees, hostel arrangements, and any outstanding customer service charges.</p>
                                    <p>We are committed to supporting you every step of the way in your academic journey! If you have any questions or need assistance, don’t hesitate to reach out.</p>
                                </div>
                            </div>


                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>