
<?php
include '../connection.php'; // Include your database connection
session_start();


// Assuming you have the doctor's email stored in a session variable
$doctorEmail = $_SESSION['email'];

// Query to get the doctor's d_id based on their email
$doctorQuery = "SELECT d_id FROM doctors WHERE email = '$doctorEmail'";
$doctorResult = mysqli_query($con, $doctorQuery);

if (!$doctorResult) {
    die("Doctor query failed: " . mysqli_error($con));
}

$doctorData = mysqli_fetch_assoc($doctorResult);
$doctorId = $doctorData['d_id'];

// Fetch booking history records based on search and the retrieved doctor's d_id
$historyQuery = "SELECT * FROM booking_history 
                 WHERE d_id = $doctorId";
$historyResult = mysqli_query($con, $historyQuery);

// Check if the query was executed successfully
if (!$historyResult) {
    die("Booking history query failed: " . mysqli_error($con));
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
            *{
                font-family: poppins;
              font-size: 15px;
            }
            .badge-danger{
            background-color: #dc3545; 
            color: #fff; 
        }

        .badge-success{
            background-color: #28a745; 
            color: #fff; 
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
                        <h1 class="mt-4">Booking History</h1>
                        <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="doctor-dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Booking History</li>
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
                <th>Status</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Booking ID</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Preferred Date</th>
                <th>Status</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            while ($historyRow = mysqli_fetch_assoc($historyResult)) {
                echo "<tr>";
                echo "<td>" . $historyRow['history_id'] . "</td>";
                echo "<td>" . $historyRow['patient_name'] . "</td>";
                echo "<td>" . $historyRow['email'] . "</td>";
                echo "<td>" . $historyRow['preferred_date'] . "</td>";
                echo "<td>";
                if ($historyRow['status'] == 'Absent') {
                    echo "<span class='badge badge-danger'>Not Visited</span>";
                } else {
                    echo "<span class='badge badge-success'>Completed</span>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>


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
