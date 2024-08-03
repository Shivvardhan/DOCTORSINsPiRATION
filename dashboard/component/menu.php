<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Logo-->
        <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
            <!--begin::Logo image-->
            <a href="index.php">
                <img alt="Logo" src="assets/media/stock/etc/logo_w.png" class="h-30px app-sidebar-logo-default" />
            </a>
            <!--end::Logo image-->
            <!--begin::Sidebar toggle-->
            <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-sm h-30px w-30px rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                <span class="svg-icon svg-icon-2 rotate-180">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                        <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </div>
            <!--end::Sidebar toggle-->
        </div>
        <!--end::Logo-->
        <!--begin::sidebar menu-->
        <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
            <!--begin::Menu wrapper-->
            <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
                <!--begin::Menu-->

                <?php if ($_SESSION['usertype'] == "admin") {
                ?>
                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!-- Status Section -->
                        <div class="menu-item">
                            <a class="menu-link" href="dash.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Status</span>
                            </a>
                        </div>

                        <!-- Students Section -->
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Students</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="students.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-user-graduate"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Students List</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="student_info.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-info-circle"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Students Information</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="student_status.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-tasks"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Students Status</span>
                            </a>
                        </div>

                        <!-- Letter Processing Section -->
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Letter Processing</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="invitation_letter_dash.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-envelope"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Letter Processing Dash</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="offer_letter.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-envelope-open"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Offer Letter</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="invitation_letter.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Invitation Letter</span>
                            </a>
                        </div>

                        <!-- Visa Processing Section -->
                        <div class="menu-item pt-5">
                            <div class="menu-content">
                                <span class="menu-heading fw-bold text-uppercase fs-7">Visa Processing</span>
                            </div>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pre-depart.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-passport"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Visa Processing Dash</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="visa_status.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-check-square"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Visa Status</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="passport_courier.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-shipping-fast"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Passport Courier</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link" href="pre_departure_detail.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-plane-departure"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Pre Departure Details</span>
                            </a>
                        </div>

                        <!-- Sign Out Section -->
                        <div style="position:absolute;bottom:0;">
                            <div class="menu-item">
                                <a class="menu-link" href="logout.php">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fa-solid fa-sign-out-alt"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Sign Out</span>
                                </a>
                            </div>
                        </div>
                    </div>


                <?php } else { ?>


                    <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">

                        <div class="menu-item">
                            <a class="menu-link <?php if ($mode['register'] != 'paid') {
                                                    echo "disabled";
                                                }; ?>" href="dash.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-chart-column"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Status
                                </span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link <?php if ($mode['register'] != 'paid') {
                                                    echo "disabled";
                                                }; ?>" href="admission.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-building-columns"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Admission</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link <?php if ($mode['application'] != 'paid') {
                                                    echo "disabled";
                                                }; ?>" tabindex="-1" aria-disabled="true" href="invitation-letter.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-envelope-open-text"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Invitation Letter</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link <?php if ($mode['invitation_letter'] != 'paid') {
                                                    echo "disabled";
                                                }; ?>" href="pre-depart.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-person-walking-luggage"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Pre - Departure</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a class="menu-link <?php if ($mode['pre_depart'] != 'paid') {
                                                    echo "disabled";
                                                }; ?>" href="post-depart.php">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fa-solid fa-plane-departure"></i>
                                    </span>
                                </span>
                                <span class="menu-title">Post - Departure</span>
                            </a>
                        </div>
                        <div style="position:absolute;bottom:0;">
                            <div class="menu-item">
                                <a class="menu-link" href="logout.php">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">Sign Out</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end::Menu-->
                <?php } ?>
            </div>
            <!--end::Menu wrapper-->
        </div>
        <!--end::sidebar menu-->
        <!--begin::Footer-->

        <!--end::Footer-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">