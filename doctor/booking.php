<?php
include '../connection.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to the login page
    header('Location: index.php');
    exit();
}
$docemail=$_SESSION['email'];
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
            *{
                font-family: poppins;
              font-size: 15px;
            }
        </style>
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Welcome Doctor!</a>
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
                        <li><a class="dropdown-item" href="doctor-profile.php">Change Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="doctor-logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="doctor-dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="booking.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-book-medical"></i></div>
                              Bookings
                            </a>
                            <a class="nav-link" href="doctor-view-history.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                       Booking History
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bookings</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="doctor-dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                    <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        New Bookings
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Preferred Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Booking ID</th>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Preferred Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
            <?php
    include '../connection.php';
    $qry2="SELECT * FROM doctors WHERE email='$docemail' ";
    $result2 = mysqli_query($con, $qry2);
    $row2=mysqli_fetch_assoc($result2);
    $docid=$row2['d_id'];
    $sql = "SELECT * FROM bookings WHERE d_id=$docid";
    $result = mysqli_query($con, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
  
   
            echo "<tr>";
            echo "<td>" . $row['b_id'] . "</td>";
            echo "<td>" . $row['patient_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['preferred_date'] . "</td>";
            
            // echo "<td><a href='delete-booking.php?id=" . $row['b_id'] . "'><button>Delete</button></a></td>";

            echo "<td>
            <a href='bookinghistory.php?id=" . $row['b_id'] . "'><button class='btn btn-primary btn-sm'>Complete</button></a>
            <a href='absentbooking.php?id=" . $row['b_id'] . "'><button class='btn btn-danger btn-sm ml-2'>Absent</button></a>
          </td>";
    

            


}
}
?>

            </tbody>
        </table>
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
