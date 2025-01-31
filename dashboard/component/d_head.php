<?php 
session_start();
require "dbcon.php";
$stmt = $conn->prepare("SELECT l_token FROM `users` WHERE `username` = ?");
	$stmt->bind_param('s', $_SESSION['username']);
	$stmt->execute();
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	if($user['l_token'] == isset($_SESSION['token'])) {
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Doctor's Inspiration</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <link rel="icon" type="image/x-icon" href="assets/image/logo_1.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="assets/css/all.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-xVVam1KS4+Qt2OrFa+VdRUoXygyKIuNWUUUBZYv+n27STsJ7oDOHJgfF0bNKLMJF" crossorigin="anonymous">

    <!-- <link href="https://rawcdn.githack.com/hung1001/font-awesome-pro/4cac1a6/css/all.css" rel="stylesheet" type="text/css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous">
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.13.4/b-2.3.6/sl-1.6.2/datatables.min.css" />


    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
    <script src="//www.google.com/jsapi"></script>
    <style>
    .menu-link .active {
        background-color: transparent !important;
        border: 1px solid #5D5FEF;
    }

    .menu-link.disabled {
        pointer-events: none !important;
        opacity: 0.4 !important;
        color: #6c757d !important;

    }

    .profile-component {
        display: flex;
        align-items: center;
        padding: 10px;
    }

    .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 5px;
        margin-right: 10px;
        object-fit: cover;
    }

    .profile-info {
        display: flex;
        flex-direction: column;
    }

    .profile-name {
        font-weight: bold;
        color: #2b3b54;
        display: flex;
        align-items: center;
    }

    .dropdown-arrow {
        font-size: 12px;
        margin-left: 5px;
        color: #2b3b54;
    }

    .profile-role {
        color: #888;
        font-size: 14px;
    }

    .notification-container {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .notification-button {
        position: relative;
        width: 40px;
        height: 40px;
        background-color: #ffa41221;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: ease-in 0.3s;
    }



    .notification-dot {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 12px;
        height: 12px;
        background-color: #EB5757;
        border-radius: 50%;
        border: 2px solid #fff;
    }
    </style>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">


    <!--begin::Theme mode setup on page load-->
    <script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
    </script>
    <?php require "top_head.php";
	
    date_default_timezone_set("Asia/Calcutta"); 
	}
    ?>