<?php
require "./component/d_head.php";
//Code for checking the mode status
if($mode['application']!='paid'){
    echo '<script type="text/javascript">';
    echo 'window.location.href = "dash.php";';
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
.form-group label {
    font-weight: bold;
    color: #1d2951;
    font-size: 1.3rem;
}

.submit-btn {
    background-color: #18618E;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #164662;
    color: white;
}

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
    background-color: #166572;
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

.info-text-a {
    color: #151D48;
    font-weight: 600;
    font-size: 21px;
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

    .info-text-a {
        color: #151D48;
        font-weight: 600;
        font-size: 14px;
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

    .info-text-a {
        color: #151D48;
        font-weight: 600;
        font-size: 16px !important;
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
                <li class="breadcrumb-item text-muted">Invitation Letter</li>

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
                                <div class="icon">
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
                    <div class="poppins info-text">
                        Download Invitation Letter
                    </div>
                </div>
            </div>


            <!-- if payment is paid then shown only -->
            <?php 
            //Code for checking the mode status
            if($mode['invitation_letter']=='paid'){
                {
            }
            ?>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12">
                <div style="background-color:#DFE7E8;"
                    class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 ">
                    <!--begin::Label-->
                    <div class="row" style="align-items:center;">
                        <div class="col-2">
                            <div class="icon-container">
                                <div class="icon" style="height:55px;width:55px;">
                                    <div class="icon-circle">
                                        <i class="icon-i fa-regular fa-file-lines"
                                            style="font-size:20px !important;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 mln">
                            <div class="poppins info-text-a">
                                Address : 1234 Elm Street Springfield, IL 62704 United States
                            </div>
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
            </div>

            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-6 mb-xl-3 mt-3">
                <div style="background-color:#DFE7E8;"
                    class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                    <!--begin::Label-->
                    <?php
                    $uid = $_SESSION['uid'];
                    $sql = "SELECT COUNT(uid) as submit FROM courier WHERE uid = ?";
                            
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param('i', $uid); 
                        $stmt->execute();
                        $stmt->bind_result($submit);
                        if ($stmt->fetch()) {
                            if ($submit >= 1) { ?>

                    <div class="row text-center" style="align-items:center;">
                        <div class="poppins info-text-a">
                            Courier Tracking Details Already Filled.
                        </div>
                    </div>

                    <?php
                    } else { ?>
                    <div class="row" style="align-items:center;">
                        <form action="#" method="POST">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="courierBy">Courier By:</label>
                                    <input type="text" class="form-control" id="courierBy" name="courierBy" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="trackingId">Tracking ID:</label>
                                    <input type="text" class="form-control" id="trackingId" name="trackingId" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="dateOfCourier">Date of Courier:</label>
                                    <input type="date" class="form-control" id="dateOfCourier" name="dateOfCourier"
                                        required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-8">
                                <button style="width:30%;" type="submit" name="courier_submit"
                                    class="btn submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                    <?php
                    }} else {
                        echo 'Fetch Error: ' . $stmt->error;
                    }
                    $stmt->close();
                    } else {
                    echo 'Prepare Error: ' . $conn->error;
                    }
                    ?>
                </div>
            </div>

            <?php };?>
        </div>

    </div>

    <?php
if (isset($_POST['courier_submit'])) {
    // Retrieve form data
    $uid = $_SESSION['uid'];
    $courierBy = $_POST['courierBy'];
    $trackingId = $_POST['trackingId'];
    $dateOfCourier = $_POST['dateOfCourier'];

   // Insert data into the database
   $sql = "INSERT INTO courier (uid, courier_by, tracking_id, date) VALUES (?, ?, ?, ?)";
   if ($stmt = $conn->prepare($sql)) {
       $stmt->bind_param('ssss', $uid, $courierBy, $trackingId, $dateOfCourier);
       $stmt->execute();
       echo '<script type="text/javascript">';
       echo 'window.location.href = "invitation-letter.php";';
       echo '</script>';
       $stmt->close();
   } else {
       echo 'Error: ' . $conn->error;
   }
}
?>
</div>
<!-- Note section -->
<div class="d-flex fs-4 px-8 text-center"
    style="justify-content:center;align-items:center;font-weight:600;margin-top:25rem;">
    <p>
        Note: For Pre Departure Session Student are required to reach the location, Dostorinspration is not liable for
        any
        tickets or transport help
    </p>
</div>

<?php 
//Code for checking the mode status
if($mode['invitation_letter']!='paid'){
    {
}
?>
<!-- Payment Floating Button -->
<div class=" d-flex">
    <div class="text-float px-12" style="background-color:#AEAFF7;font-size:20px;">
        Pay Fees for Further Processing
    </div>
    <a href="https://wa.me/7223859729" style="background-color:#5D5FEF;" class="whatsapp-float" target="_blank">
        <i style="color:white;font-size:25px;" class="fa-solid fa-money-bill-wave"></i>
    </a>
</div>
<?php };?>
<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>