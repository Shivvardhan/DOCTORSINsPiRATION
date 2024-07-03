<?php
require "./component/d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {

    require "./component/menu.php";
    require "chart.php";
    require "function.php";
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

        <?php
            if ($_SESSION['usertype'] == 'admin') {

            ?>
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="totaladmin"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Admins</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" id="totalradmins" data-kt-countup="true"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Restaurent Admins</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="totaltacc"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Tables Users</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="notlogged"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Users Not Logged Once</div>
                    <!--end::Label-->
                </div>
            </div>



        </div>
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="todayordercount"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Orders Today</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" id="totalorders" data-kt-countup="true"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Orders Till Now</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="totalmenuitems"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Menu Items</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="ttotalmenuitems"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Menu Items added today</div>
                    <!--end::Label-->
                </div>
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

            ?>




        <!-- for radmin analyticc start -->

        <?php
            if ($_SESSION['usertype'] == 'radmin') {

            ?>
        <div class="row g-3 g-xl-10 mb-3 me-6 m mb-xl-3">

            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-12 mb-md-6 mb-xl-3">
                <div style="background-color:#FFF4DE;"
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
                    <div class="icont" style="background-color:#5D5FEF;">
                        <div class="icon-circle">
                            <i class="icon-t fa-solid fa-download"></i>
                        </div>
                    </div>
                </div>
                <div class="px-8">
                    <div class="poppins info-text">
                        Download Offer Letter
                    </div>
                </div>
            </div>

            <div class="d-flex" style="align-items:center;">
                <div class="icon-container" style="justify-content:left;">
                    <div class="icont" style="background-color:#5D5FEF;">
                        <div class="icon-circle">
                            <i class="icon-t fa-brands fa-whatsapp"></i>
                        </div>
                    </div>
                </div>
                <div class="px-8">
                    <div class="poppins info-text">
                        Chat with Councellor
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
        <!-- for radmin analyticc end -->

    </div>


</div>
<!-- Whatsapp Floating Button -->
<div class=" d-flex">
    <div class="text-float px-12" style="background-color:#AEAFF7;font-size:20px;">
        Pay Fees for Access Invitation Letter
    </div>
    <a href="https://wa.me/7223859729" style="background-color:#5D5FEF;" class="whatsapp-float" target="_blank">
        <i style="color:white;font-size:25px;" class="fa-solid fa-money-bill-wave"></i>
    </a>
</div>


<script>
$(document).ready(function() {
    // Make AJAX request to retrieve data

    $.ajax({
        url: 'phpdata/live_a_u.php',
        dataType: 'json',
        success: function(data) {
            // Update data placeholders
            $('#totalradmins').text(data.totalradmin);
            $('#totaladmin').text(data.totaladmin);
            $('#totaltacc').text(data.totaltacc);
            $('#notlogged').text(data.notlogged);
            $('#todayordercount').text(data.todayordercount);
            $('#totalorders').text(data.totalorders);
            $('#totalmenuitems').text(data.totalmenuitems);
            $('#ttotalmenuitems').text(data.ttotalmenuitems);
            $('#utable').text(data.utable);
            $('#rmenu').text(data.rmenu);
            $('#todayorderu').text(data.todayorderu);
            $('#todayallorderu').text(data.todayallorderu);






        }
    });

    // Refresh data every 5 seconds
    setInterval(function() {
        $.ajax({
            url: 'phpdata/live_a_u.php',
            dataType: 'json',
            success: function(data) {
                // Update data placeholders
                $('#totalradmins').text(data.totalradmin);
                $('#totaladmin').text(data.totaladmin);
                $('#totaltacc').text(data.totaltacc);
                $('#notlogged').text(data.notlogged);
                $('#todayordercount').text(data.todayordercount);
                $('#totalorders').text(data.totalorders);
                $('#totalmenuitems').text(data.totalmenuitems);
                $('#ttotalmenuitems').text(data.ttotalmenuitems);
                $('#utable').text(data.utable);
                $('#rmenu').text(data.rmenu);
                $('#todayorderu').text(data.todayorderu);
                $('#todayallorderu').text(data.todayallorderu);

            }
        });
    }, 5000);
});
</script>

<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>