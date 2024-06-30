<?php
require "d_head.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user['l_token'] == isset($_SESSION['token']) && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {

    require "menu.php";
    require "chart.php";
    require "function.php";
?>


<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->

                <li class="breadcrumb-item">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Dashboard </h1>
                </li>

                <li class="breadcrumb-item text-muted"><img src="assets/media/stock/etc/live.png" width="60px"> </li>
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
                <li class="breadcrumb-item text-muted">Dashboards </li>

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
        <div class="row g-3 g-xl-10 mb-3 mb-xl-3">

            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="utable"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Tables Added</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" id="rmenu" data-kt-countup="true"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total Menu Items Created</div>
                    <!--end::Label-->
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-3">
                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <span class="svg-icon fs-3 text-success me-2">

                        </span>
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="todayorderu"></div>
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
                        <div class="fs-2 fw-bold" data-kt-countup="true" id="todayallorderu"></div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 ">Total orders</div>
                    <!--end::Label-->
                </div>
            </div>



        </div>

        <?php } ?>
        <!-- for radmin analyticc end -->

    </div>

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

<?php require "footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>