<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <div id="kt_app_header" class="app-header" style="background-color:#DFE7E8;">
            <!--begin::Header container-->
            <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
                id="kt_app_header_container">
                <!--begin::sidebar mobile toggle-->
                <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                    <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                    fill="currentColor" />
                                <path opacity="0.3"
                                    d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                </div>
                <!--end::sidebar mobile toggle-->
                <!--begin::Mobile logo-->
                <!--end::Mobile logo-->
                <!--begin::Header wrapper-->
                <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                    id="kt_app_header_wrapper">
                    <!--begin::Menu wrapper-->
                    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                        data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                        data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end"
                        data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                        data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                        data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                        <!--begin::Menu-->
                        <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                            id="kt_app_header_menu" data-kt-menu="true">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                data-kt-menu-placement="bottom-start"
                                class="menu-item here show menu-here-bg menu-lg-down-accordion me-0 me-lg-2 ">
                                <!--begin:Menu link-->

                                <div class="poppins" style="color: #151D48;font-weight: 700;font-size: 34px;">
                                    Dashboard
                                </div>
                            </div>

                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Navbar-->
                    <div class="app-navbar flex-shrink-0">
                        <!--begin::Search-->

                        <!--end::Theme mode-->
                        <!--begin::User menu-->
                        <!-- <div class="notification-container">
                            <a href="#">
                                <div class="notification-button">
                                    <div class="bell-icon">
                                        <i style="color:#FFA412;font-size:25px;" class="fa-regular fa-bell"></i>
                                    </div>
                                    <div class="notification-dot"></div>
                                </div>
                            </a>
                        </div> -->
                        <div class="profile-component">
                            <img src="https://cdn-icons-png.flaticon.com/512/5987/5987424.png" alt="Profile Image"
                                class="profile-image" onclick="redirectToEditPage()">
                            <div class="profile-info">
                                <div class="profile-name" onclick="redirectToEditPage()">
                                    <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?>
                                </div>
                                <div class="profile-role">
                                    <?php if ($_SESSION['usertype'] == "admin") {
                                        echo "Staff";
                                    } else {
                                        echo "Student";
                                    }; ?>
                                </div>
                            </div>
                        </div>

                        <script>
                        function redirectToEditPage() {
                            var userType = '<?php echo $_SESSION['usertype']; ?>';
                            if (userType === 'radmin') {
                                window.location.href = 'edit_student_info.php?uid=<?php echo $_SESSION['uid'] ?>';
                            }
                        }
                        </script>

                        <style>
                        .profile-image,
                        .profile-name {
                            cursor: pointer;
                        }
                        </style>



                        <!--end::User menu-->
                        <!--begin::Header menu toggle-->
                        <!--end::Header menu toggle-->
                    </div>
                    <!--end::Navbar-->
                </div>
                <!--end::Header wrapper-->
            </div>
            <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Wrapper-->