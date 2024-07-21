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
.input-group {
    width: 60% !important;
}


.icon-container {
    display: flex;
    justify-content: center;
    align-items: center;
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

@media (max-width: 600px) {

    .info {
        margin-right: 0 !important;
    }

    .icon {
        width: 50px !important;
        height: 50px !important;
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
                        Students Information</h1>
                </li>

                <!-- <li class="breadcrumb-item text-muted"><img src="assets/media/stock/etc/live.png" width="60px"> </li> -->
                <!--end::Item-->
            </ul>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Students</li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Students Information</li>
                <!--end::Item-->
                <!--begin::Item-->

                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->



        </div>

    </div>
    <!--end::Toolbar container-->
</div>

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div class="col-12 mb-8" style="border:1px solid black;"></div>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row mt-5 mb-4">
            <div class="input-group col-8">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" id="search-input" placeholder="Search" onkeyup="filterTable()">
                <div class="input-group-append ms-4">
                    <button class="btn" style="background-color:#245E8E;color:white;" type="button"
                        onclick="filterTable()">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="px-8 table-responsive">
        <table class="table table-bordered text-center align-middle" id="data-table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">Status</th>
                    <th scope="col">Fees Paid</th>
                    <th scope="col">Date of Registration</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Rodríguez Mendoza</th>
                    <td>000000000</td>
                    <td><button type="button" style="width:70%" class="btn">Primary</button></td>
                    <td>2,310.00</td>
                    <td>01-02-2021</td>
                    <td>
                        <button type="button" class="btn btn-light">
                            <span><i class="fa-solid fa-pen"></i></span>Edit
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Rodríguez Mendoza</th>
                    <td>000000000</td>
                    <td><button type="button" style="width:70%" class="btn btn-primary">Post Departure</button></td>
                    <td>2,310.00</td>
                    <td>01-02-2021</td>
                    <td>
                        <button type="button" class="btn btn-light">
                            <span><i class="fa-solid fa-pen"></i></span>Edit
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Rodríguez Mendoza</th>
                    <td>000000000</td>
                    <td><button type="button" style="width:70%" class="btn btn-primary">Visa Processing</button></td>
                    <td>2,310.00</td>
                    <td>01-02-2021</td>
                    <td>
                        <button type="button" class="btn btn-light">
                            <span><i class="fa-solid fa-pen"></i></span>Edit
                        </button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Rodríguez Mendoza</th>
                    <td>000000000</td>
                    <td><button type="button" style="width:70%" class="btn btn-primary">Offer Letter</button></td>
                    <td>2,310.00</td>
                    <td>01-03-2021</td>
                    <td>
                        <button type="button" class="btn btn-light">
                            <span><i class="fa-solid fa-pen"></i></span>Edit
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Pagination -->
<div class="mb-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item"><a class="page-link" href="#">7</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

<style>
#sub-1 {
    display: block !important;
}
</style>
<script>
function filterTable() {
    const input = document.getElementById('search-input');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('data-table');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        let match = false;
        const td = tr[i].getElementsByTagName('td');
        for (let j = 0; j < td.length; j++) {
            if (td[j]) {
                const txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    match = true;
                    break;
                }
            }
        }
        tr[i].style.display = match ? '' : 'none';
    }
}
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php require "./component/footer.php";
} else {
    echo "<script>window.location.href = 'index.php'; </script>";
}
?>