<?php
include '../connection.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to the login page
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin-Doctor Appointment Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>


* {
font-family: poppins;
margin: 0;
padding: 0;
box-sizing: border-box;
font-size: 15px;
}


    </style>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Admin Panel</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="admin-profile.php">Change Password</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="admin-logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="patient-details.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Patients
                    </a>
                    <a class="nav-link" href="doctor-details.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-doctor"></i></div>
                        Doctors
                    </a>
                    <a class="nav-link" href="contact-view.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-book-medical"></i></div>
                        Bookings
                    </a>
                    <a class="nav-link" href="bookinghistory.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                        Booking History
                    </a>
                    <a class="nav-link" href="contact-view.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-message"></i></div>
                        Contact
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h2 class="mt-4">Contact Page</h2>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Contact Page</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Contact us data
                    </div>
                    <div class="card-body">
    <table id="datatablesSimple" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../connection.php';
            $sql = "SELECT * FROM contactus";
            $result = mysqli_query($con, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['c_id'];
                    $c_name = $row['c_name'];
                    $c_email = $row['c_email'];
                    $c_message = $row['c_message'];

                    echo '<tr>
                            <td>' . $id . '.</td>
                            <td>' . $c_name . '</td>
                            <td>' . $c_email . '</td>
                            <td>' . $c_message . '</td>
                            <td>
                                <a class="btn btn-danger p-1 ml-1" href="delete-contact.php?id=' . $id . '" role="button">Delete</a>
                            </td>
                        </tr>';
                }
            }
            ?>
        </tbody>
    </table>
</div>


                </div>
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</body>
</html>
