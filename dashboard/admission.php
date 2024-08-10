<?php
require "./component/d_head.php";
//Code for checking the mode status
if($mode['register']!='paid'){
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
.icon-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.mln {
    margin-left: -40px;
}

.icon {
    position: relative;
    width: 80px;
    height: 80px;
    background-color: #ff8a65;
    /* Icon circle background color */
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.icont {
    position: relative;
    width: 70px;
    height: 70px;
    background-color: #ff8a65;
    /* Icon circle background color */
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.icon-inner {
    position: relative;
    width: 50%;
    height: 50%;
}

.info-text {
    color: #151D48;
    font-weight: 600;
    font-size: 24px;
}

.info-subtext {
    color: #425166;
    font-weight: 500;
    font-size: 16px;
}

.info-status {
    color: #4079ED;
    font-weight: 500;
    font-size: 12px;
}

.icon-i {
    color: white !important;
    font-size: 40px !important;
}

.icon-t {
    color: white !important;
    font-size: 30px !important;
}

@media (max-width: 600px) {
    .text-float {
        display: none !important;
    }

    .mln {
        margin-left: 0px;
    }

    .icont {
        width: 50px !important;
        height: 50px !important;
    }

    .icon-t {
        color: white !important;
        font-size: 20px !important;
    }

    .info {
        margin-right: 0 !important;
    }

    .icon {
        width: 40px !important;
        height: 40px !important;
    }

    .icon-i {
        color: white !important;
        font-size: 20px !important;
    }

    .info-text {
        color: #151D48;
        font-weight: 600;
        font-size: 16px;
    }

    .info-subtext {
        color: #425166;
        font-weight: 500;
        font-size: 13px;
    }

    .info-status {
        color: #4079ED;
        font-weight: 500;
        font-size: 11px;
    }
}

/* Medium devices (landscape tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 1024px) {

    .mln {
        margin-left: -20px;
    }

    .icon {
        width: 60px !important;
        height: 60px !important;
    }

    .icon-i {
        color: white !important;
        font-size: 30px !important;
    }

    .info-text {
        color: #151D48;
        font-weight: 600;
        font-size: 18px !important;
    }

    .info-subtext {
        color: #425166;
        font-weight: 500;
        font-size: 14px !important;
    }

    .info-status {
        color: #4079ED;
        font-weight: 500;
        font-size: 11px !important;
    }
}

.link:hover {
    text-decoration: underline;
}
</style>


<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->

                <li class="breadcrumb-item">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Admission</h1>
                </li>

                <!-- <li class="breadcrumb-item text-muted"><img src="assets/media/stock/etc/live.png" width="60px"> </li> -->
                <!--end::Item-->
            </ul>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="dash.php" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Admission</li>

                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->



        </div>

    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">

    <div id="kt_app_content_container" class="app-container container-fluid">
        <!-- for radmin analyticc start -->
        <div class="row g-3 g-xl-10 mb-3 me-6 m mb-xl-3">

            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-6 mb-xl-3">
                <div style="background-color:#DFE7E8;"
                    class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                    <!--begin::Label-->
                    <div class="row" style="align-items:center;">
                        <div class="col-2">
                            <div class="icon-container">
                                <div class="icon" style="background-color:#166572;">
                                    <div class="icon-circle">
                                        <i class="icon-i fa-regular fa-file-lines"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 mln">
                            <div class="poppins info-text">
                                Application
                                Submitted
                            </div>
                            <div class="info-subtext">(DATE
                                Of
                                Submission)
                            </div>
                            <div class="info-status">(Approved)
                            </div>
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
                <div class="col-12 mt-10 mb-4" style="border:1px solid black;">
                </div>
            </div>



            <div class="d-flex" style="align-items:center;">
                <div class="icon-container" style="justify-content:left;">
                    <div class="icont" style="background-color:#18618E;">
                        <div class="icon-circle">
                            <i class="icon-t fa-solid fa-download"></i>
                        </div>
                    </div>
                </div>
                <div class="px-8">
                    <a href="<?php
            
                    $sql = "SELECT `file` FROM letters WHERE uid='".$_SESSION['uid']."' AND letter_type='OFFER_LETTER'";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        while($row = $result->fetch_assoc()) {
                            echo "./uploads/";
                            echo $row['file'];
                        }
                    } else {
                        echo "#";
                    }

                    ?>" target="_blank">
                        <div class="link poppins info-text">
                            Download Offer Letter
                        </div>
                    </a>
                </div>
            </div>


            <div class="d-flex" style="align-items:center;">
                <div class="icon-container" style="justify-content:left;">
                    <div class="icont" style="background-color:#18618E;">
                        <div class="icon-circle">
                            <i class="icon-t fa-brands fa-whatsapp"></i>
                        </div>
                    </div>
                </div>
                <div class="px-8">
                    <a href="https://wa.me/7223859729">
                        <div class="link poppins info-text">
                            Chat with Councellor
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <!-- for radmin analyticc end -->

    </div>


</div>
<?php 
//Code for checking the mode status
if($mode['application']!='paid'){
?>

<!-- Whatsapp Floating Button -->
<div class=" d-flex">
    <div class="text-float px-12" style="background-color:#A4CBE3;font-size:20px;">
        Pay Fees for Access Invitation Letter
    </div>
    <a href="#" data-bs-toggle="modal" data-bs-target="#payment" style="background-color:#18618E;"
        class="whatsapp-float">
        <i style="color:white;font-size:25px;" class="fa-solid fa-money-bill-wave"></i>
    </a>
</div>

<div class="modal fade" id="payment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Offer Letter Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Readonly field for displaying student ID -->
                    <h3 class="d-flex justify-content-center">Offer Letter Fee - 25,000 Rs</h3>
                    <div class="mb-3 d-flex" style="justify-content:center;">
                        <img src="./assets/image/QR.jpg" alt="QR" height="300px">
                    </div>

                    <div class="mb-3">
                        <label for="studentId" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="studentId" name="uid"
                            value="<?php echo $_SESSION['uid'];?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="Name" class="form-label">Name</label>
                        <input type="Text" class="form-control" id="Name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="Amount" class="form-label">Amount</label>
                        <input type="text" class="form-control" id="Amount" name="amount" value="25000" disabled
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="Utr" class="form-label">UTR Number</label>
                        <input type="Text" class="form-control" id="Utr" name="utr" required>
                    </div>
                    <div class="mb-3">
                        <label for="TDate" class="form-label">Transaction Date</label>
                        <input type="date" class="form-control" id="TDate" name="tdate" required>
                    </div>
                    <div class="mb-3">
                        <label for="Ttime" class="form-label">Transaction Time</label>
                        <input type="time" class="form-control" id="Ttime" name="ttime" required>
                    </div>

                    <div class="mb-3">
                        <label for="upi" class="form-label">Your UPI ID</label>
                        <input type="text" class="form-control" id="upi" name="upi" required>
                    </div>
                </div>
                <h5 class="d-flex justify-content-center"><b>Note : Can only be paid once. Please be careful.</b></h5>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Pay</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php };?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data from the session and POST request
    $studentId = $_SESSION['uid'];
    $name = $_POST['name'];
    $amount = "25000"; // Fixed amount
    $utr = $_POST['utr'];
    $tdate = $_POST['tdate'];
    $ttime = $_POST['ttime'];
    $upi = $_POST['upi'];
    $payment_type = "application";

    // SQL statement
    $sql = "INSERT INTO payments (uid, name, amount, payment_type, utr_number, transaction_date, transaction_time, upi_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssssss", $studentId, $name, $amount, $payment_type, $utr, $tdate, $ttime, $upi);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Payment successfull!',
            }).then(() => {
            window.location.href = './admission.php';
            });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error inserting payment record: " . $stmt->error . "',
            });
            </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Database Error',
            text: 'Error preparing the statement: " . $conn->error . "',
        });
        </script>";
    }
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>