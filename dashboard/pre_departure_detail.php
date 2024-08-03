<?php
require "./component/d_head.php";

// Check invitation letter status
if ($mode['invitation_letter'] != 'paid') {
    echo '<script type="text/javascript">window.location.href = "dash.php";</script>';
    exit();
}

// Check user token and session validity
$stmt = $conn->prepare("SELECT l_token FROM users WHERE username = ?");
$stmt->bind_param('s', $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user['l_token'] === $_SESSION['token'] && isset($_SESSION['username']) && session_status() === PHP_SESSION_ACTIVE && $_SESSION['usertype']) {
    require "./component/menu.php";
?>

    <style>
        .info-head {
            color: #151D48;
            font-weight: 600;
            font-size: 32px;
            margin-bottom: 2rem;
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

        .icon {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #166572;
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }

        .icon i {
            color: white;
            font-size: 24px;
        }

        @media (max-width: 600px) {
            .info-text {
                font-size: 18px;
            }

            .info-text-a {
                font-size: 16px;
            }

            .info-subtext {
                font-size: 14px;
            }

            .info-status {
                font-size: 11px;
            }

            .icon {
                width: 50px;
                height: 50px;
            }

            .icon i {
                font-size: 20px;
            }
        }

        @media (min-width: 768px) and (max-width: 1024px) {
            .info-text {
                font-size: 20px;
            }

            .info-text-a {
                font-size: 18px;
            }

            .info-subtext {
                font-size: 15px;
            }

            .info-status {
                font-size: 12px;
            }

            .icon {
                width: 55px;
                height: 55px;
            }

            .icon i {
                font-size: 22px;
            }
        }
    </style>

    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            Pre Departure Details
                        </h1>
                    </li>
                </ul>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="dash.php" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item text-muted">Pre Departure Details</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-3 mb-3">

                <!-- Session Details -->
                <div class="col-md-12 col-lg-12 mb-md-6 mb-xl-3">
                    <div class="info-head text-center mb-4">Session Details:</div>
                    <div class="border border-gray-300 border-dashed rounded p-4 mb-3" style="background-color:#DFE7E8;">
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center justify-content-center ">
                                <div class="info-text text-center">Session Date: 19/02/1256</div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-center ">
                                <div class="info-text text-center">Session Time: 11:00 am</div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Session Address -->
                <div class="col-md-12 col-lg-12 mt-2">
                    <div class="border border-gray-300 border-dashed rounded p-4" style="background-color:#DFE7E8;">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <div class="icon" style="background-color: #166572; display: inline-flex; justify-content: center; align-items: center; height: 55px; width: 55px; border-radius: 50%;">
                                    <i class="fa-solid fa-location-dot" style="color: white; font-size: 30px;"></i>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="info-text-a">
                                    <strong>Session Address:</strong><br>1234 Elm Street, Springfield, IL 62704, United States
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-md-12 col-lg-12 d-flex justify-content-between mt-4 p-4">
                    <button type="button" class="btn d-flex align-items-center justify-content-center" style="width: 48%; background-color: #166572; color: white; border: none; padding: 10px;">
                        <i class="fa-solid fa-trash me-2" style="font-size: 16px; color:white;"></i> Delete
                    </button>
                    <button type="button" class="btn d-flex align-items-center justify-content-center" style="width: 48%; background-color: #166572; color: white; border: none; padding: 10px;">
                        <i class="fa-solid fa-pencil me-2" style="font-size: 16px;color:white;"></i> Update
                    </button>
                </div>

            </div>
        </div>
    </div>

<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>