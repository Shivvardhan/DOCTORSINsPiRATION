<?php
require "./component/d_head.php";
//Code for checking the mode status
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

.glow {
    color: #fff;
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    padding: 5px 10px;
    /* Increase padding to make the tag wider */
    border-radius: 5px;
    background-color: #ff0000;
    box-shadow: 0 0 5px rgba(255, 0, 0, 0.6), 0 0 10px rgba(255, 0, 0, 0.4);
    display: inline-block;
    margin-left: 10px;
    min-width: 50px;
    /* Set a minimum width */
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
                        Status </h1>
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
                <li class="breadcrumb-item text-muted">Status </li>

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

        <?php
            if ($_SESSION['usertype'] == 'admin') {
                // Prepare and execute the SQL query
                $stmt = $conn->prepare("SELECT * FROM payment_status WHERE user_id = ?");
                $stmt->bind_param("i", $_SESSION['uid']);
                $stmt->execute();

                // Fetch the result
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {


            ?>

        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-6 mb-xl-3">
            <div style="background-color:#DFE7E8;"
                class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                <!--begin::Label-->
                <div class="row" style="align-items:center;">
                    <div class="col-2">
                        <div class="icon-container">
                            <div class="icon" style="background-color:#166572;">
                                <div class="icon-circle">
                                    <i class="icon-i fa-solid fa-user-large"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 mln">
                        <div class="poppins info-text">
                            Total Number Of Students
                        </div>
                        <div class="info-subtext">(<span id="totalRadminUsers">Loading...</span>)
                            <span class="glow">LIVE</span>
                        </div>
                    </div>
                </div>
                <!--end::Label-->
            </div>
        </div>

        <div class="col-12 mt-10 mb-8" style="border:1px solid black;">
        </div>

        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-8 mb-xl-6">
            <div style="background-color:#DFE7E8;"
                class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                <!--begin::Label-->
                <div class="row" style="align-items:center;">
                    <div class="col-2">
                        <div class="icon-container">
                            <div class="icon" style="background-color:#166572;">
                                <div class="icon-circle">
                                    <i class="icon-i fa-solid fa-envelope-open-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 mln">
                        <div class="poppins info-text">
                            Total Number Of Offer Letters
                        </div>
                        <div class="info-subtext">
                            (<?php 
                            
                            $sql = "SELECT COUNT(*) AS offer_letters FROM `letters` WHERE letter_type='offer_letter'";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                echo $row['offer_letters'];
                              }
                            } else {
                                echo "0";
                            }

                            ?>)
                        </div>
                    </div>
                </div>
                <!--end::Label-->
            </div>
        </div>

        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-8 mb-xl-6">
            <div style="background-color:#A4CBE3;"
                class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                <!--begin::Label-->
                <div class="row" style="align-items:center;">
                    <div class="col-2">
                        <div class="icon-container">
                            <div class="icon" style="background-color:#166572;">
                                <div class="icon-circle">
                                    <i class="icon-i fa-solid fa-envelope-open-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 mln">
                        <div class="poppins info-text">
                            Total Number Of Invitation Letters
                        </div>
                        <div class="info-subtext">(<?php 
                            
                            $sql = "SELECT COUNT(*) AS invitation_letters FROM `letters` WHERE letter_type='invitation_letter'";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                echo $row['invitation_letters'];
                              }
                            } else {
                                echo "0";
                            }

                            ?>)
                        </div>
                    </div>
                </div>
                <!--end::Label-->
            </div>
        </div>
        <div class="col-12 mt-10 mb-8" style="border:1px solid black;">
        </div>

        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-8 mb-xl-6">
            <div style="background-color:#DFE7E8;"
                class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                <!--begin::Label-->
                <div class="row" style="align-items:center;">
                    <div class="col-2">
                        <div class="icon-container">
                            <div class="icon" style="background-color:#166572;">
                                <div class="icon-circle">
                                    <i class="icon-i fa-solid fa-envelope-open-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 mln">
                        <div class="poppins info-text">
                            Total Number Of Passport Couriered
                        </div>
                        <div class="info-subtext">(<?php 
                            
                            $sql = "SELECT COUNT(*) AS Courier FROM `courier`";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                echo $row['Courier'];
                              }
                            } else {
                                echo "0";
                            }

                            ?>)
                        </div>
                    </div>
                </div>
                <!--end::Label-->
            </div>
        </div>

        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-8 mb-xl-6">
            <div style="background-color:#A4CBE3;"
                class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 mb-3">
                <!--begin::Label-->
                <div class="row" style="align-items:center;">
                    <div class="col-2">
                        <div class="icon-container">
                            <div class="icon" style="background-color:#166572;">
                                <div class="icon-circle">
                                    <i class="icon-i fa-solid fa-envelope-open-text"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 mln">
                        <div class="poppins info-text">
                            Total Number Of Visa Processed
                        </div>
                        <div class="info-subtext">(<?php 
                            
                            $sql = "SELECT COUNT(*) AS Visa FROM `visa_details` WHERE status='Processed'";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                echo $row['Visa'];
                              }
                            } else {
                                echo "0";
                            }

                            ?>)
                        </div>
                    </div>
                </div>
                <!--end::Label-->
            </div>
        </div>





        <!-- <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div id="kt_docs_google_chart_column" style="width:100%; margin: 35px auto;"></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 mb-md-5 mb-xl-10">

                        <div class="card card-bordered">
                            <div class="card-body">
                                <div id="kt_docs_google_chart_line" style="  width:100%;margin: 35px auto;"></div>
                            </div>
                        </div>
                    </div>

                </div> -->
        <?php
                }
            }

            ?>




        <!-- for radmin analyticc start -->

        <?php
            if ($_SESSION['usertype'] == 'radmin') {

            ?>
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-8 col-lg-6 col-xl-6 col-xxl-6 mb-md-6 mb-xl-3">
                <div style="background-color:#DFE7E8;"
                    class=" border border-gray-300 border-dashed rounded info min-w-125px py-10 px-4 me-6 mb-3">
                    <!--begin::Label-->
                    <div class="row" style="align-items:center;">
                        <div class="col-3">
                            <div class="icon-container">
                                <div class="icon" style="background-color:#166572;">
                                    <div class="icon-circle">
                                        <i class="icon-i fa-regular fa-file-lines"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 px-4">
                            <div class="poppins info-text">
                                Application
                                Submitted
                            </div>
                            <div class="info-subtext">(<?php 
                                $uid = $_SESSION['uid'];
                                            
                                $sql = "SELECT timestamp FROM `users` WHERE uid='$uid'";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        $timestamp = $row['timestamp'];
                                        $date = new DateTime($timestamp);
                                        echo $date->format('d-m-Y'); // Change the format as needed
                                    }
                                } else {
                                    echo "DATE Of Submission";
                                }
                                ?>)
                            </div>
                            <div class="info-status">(Approved)
                            </div>
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-6 col-xxl-6 mb-md-6 mb-xl-3">
                <div style="background-color:#A4CBE3;"
                    class=" border border-gray-300 border-dashed info rounded min-w-125px py-10 px-4 me-6 mb-3">
                    <!--begin::Label-->
                    <div class="row" style="align-items:center;">
                        <div class="col-3">
                            <div class="icon-container">
                                <div class="icon" style="background-color:#18618E;">
                                    <div class="icon-circle">
                                        <i class="icon-i fa-solid fa-envelope-open-text"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 px-4">
                            <div class="poppins info-text">Invitation Letter
                            </div>
                            <div class="info-subtext">
                                (<?php 
                                $uid = $_SESSION['uid'];
                                            
                                $sql = "SELECT timestamp FROM `letters` WHERE uid='$uid' AND letter_type='invitation_letter'";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        $timestamp = $row['timestamp'];
                                        $date = new DateTime($timestamp);
                                        echo $date->format('d-m-Y'); // Change the format as needed
                                    }
                                } else {
                                    echo "DATE Of Submission";
                                }
                                ?>)
                            </div>
                            <div class="info-status">
                                (<?php 
                                $uid = $_SESSION['uid'];
                                            
                                $sql = "SELECT status FROM `letters` WHERE uid='$uid' AND letter_type='invitation_letter'";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        
                                        echo $row['status'];
                                    }
                                } else {
                                    echo "Inprocess";
                                }
                                ?>)
                            </div>
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-6 col-xxl-6 mb-md-6 mb-xl-3">
                <div style="background-color:#A4CBE3;"
                    class=" border border-gray-300 border-dashed info rounded min-w-125px py-10 px-4 me-6 mb-3">
                    <!--begin::Label-->
                    <div class="row" style="align-items:center;">
                        <div class="col-3">
                            <div class="icon-container">
                                <div class="icon" style="background-color:#18618E;">
                                    <div class="icon-circle">
                                        <i class="icon-i fa-regular fa-envelope"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 px-4">
                            <div class="poppins info-text">Offer Letter
                            </div>
                            <div class="info-subtext">(<?php 
                                $uid = $_SESSION['uid'];
                                            
                                $sql = "SELECT timestamp FROM `letters` WHERE uid='$uid' AND letter_type='offer_letter'";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        $timestamp = $row['timestamp'];
                                        $date = new DateTime($timestamp);
                                        echo $date->format('d-m-Y'); // Change the format as needed
                                    }
                                } else {
                                    echo "DATE Of Submission";
                                }
                                ?>)
                            </div>
                            <div class="info-status">(<?php 
                                $uid = $_SESSION['uid'];
                                            
                                $sql = "SELECT status FROM `letters` WHERE uid='$uid' AND letter_type='offer_letter'";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        
                                        echo $row['status'];
                                    }
                                } else {
                                    echo "Inprocess";
                                }
                                ?>)
                            </div>
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-8 col-lg-6 col-xl-6 col-xxl-6 mb-md-6 mb-xl-3">
                <div style="background-color:#DFE7E8;"
                    class=" border border-gray-300 border-dashed info rounded min-w-125px py-10 px-4 me-6 mb-3">
                    <!--begin::Label-->
                    <div class="row" style="align-items:center;">
                        <div class="col-3">
                            <div class="icon-container">
                                <div class="icon" style="background-color:#166572;">
                                    <div class="icon-circle">
                                        <i class="icon-i fa-solid fa-plane-departure"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 px-4">
                            <div class="poppins info-text">Pre -
                                Departure
                            </div>
                            <div class="info-subtext">
                                (<?php 
                                            
                                $sql = "SELECT session_date AS date FROM `session_details`";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        
                                        echo $row['date'];
                                    }
                                } else {
                                    echo "Date Of Session";
                                }
                                ?>)
                            </div>
                            <div class="info-status">(<?php 
                                            
                                $sql = "SELECT COUNT(*) AS Session FROM `session_details`";
                                            
                                $result = $conn->query($sql);
                                            
                                if ($result->num_rows == 1) {
                                    while($row = $result->fetch_assoc()) {
                                        
                                        echo "Scheduled";
                                    }
                                } else {
                                    echo "Not Scheduled";
                                }
                                ?>)
                            </div>
                        </div>
                    </div>
                    <!--end::Label-->
                </div>
            </div>



        </div>

        <?php } ?>
        <!-- for radmin analyticc end -->


    </div>

</div>


</div>

<script>
// Function to fetch the count of radmin users
function fetchRadminCount() {
    $.ajax({
        url: './phpdata/fetch_total_radmin.php', // Path to your PHP file
        method: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
            $('#totalRadminUsers').text(data.totalRadminUsers);
        },
        error: function() {
            $('#totalRadminUsers').text('Error loading data');
        }
    });
}

// Fetch the count initially
fetchRadminCount();

// Set interval to fetch the count periodically (e.g., every 5 seconds)
setInterval(fetchRadminCount, 5000);
</script>

<?php
    if ($_SESSION['usertype'] == 'radmin') {

    ?>
<!-- Whatsapp Floating Button -->
<a href="https://wa.me/9813983808" class="whatsapp-float" target="_blank">
    <i style="color:white;font-size:35px;" class="fa-brands fa-whatsapp"></i>
</a>

<?php } ?>
<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>