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
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $('#addDoctorButton').on('click', function() {

                $('#addDoctorModal').modal('show');
            });
        });
    </script>
    <style>
        * {
            font-family: poppins;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 15px;
        }


        .label-field {
            margin-top: 3px;
            width: 80%;
            margin-bottom: 3px;
            text-align: left;
            font-size: 14px;
        }

        .input-field {
            font-size: 14px;
            border-radius: 8px;
            position: relative;
            width: 100%;
            padding: 8px;
            outline: none;
            border: 1px solid crimson;
        }

        .signup-btn {
            margin-top: 8px;
            width: 80%;
            background-color: rgb(226, 52, 87);
            cursor: pointer;
            color: #fff;
            transition: all ease 0.5s;
            border: 1px solid crimson;
            outline: none;
            border-radius: 6px;
            padding: 8px;
        }

        .signup-btn:hover {
            background-color: crimson;
        }

        .close-btn {
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
            padding: 8px;
            border: none;
            position: absolute;
            padding: 8px;
            color: #000;
            opacity: 0.5;
            transition: opacity 0.3s ease;

        }

        .close-btn:hover {
            opacity: 1;
        }

        .my-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            /* Add backdrop-filter property to apply blur */
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
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
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
                        <a class="nav-link" href="admin-viewbooking.php">
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
                    <h2 class="mt-4">Patients</h2>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Patients</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Patients Data
                            <a href="#" id="addDoctorButton" class="btn btn-primary btn-block" style="width: 15%; float: right;">
                                <i class="fas fa-user-plus mr-2"></i> Add Patient
                            </a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../connection.php';
                                    $sql = "SELECT * FROM patients";
                                    $result = mysqli_query($con, $sql);
                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['p_id'];
                                            $full_name = $row['full_name'];
                                            $address = $row['address'];
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $dob = $row['dob'];

                                            echo '<tr>
                            <td>' . $id . '.</td>
                            <td>' . $full_name . '</td>
                            <td>' . $address . '</td>
                            <td>' . $email . '</td>
                            <td>' . $phone . '</td>
                            <td>' . $dob . '</td>
                            <td>
                                <a class="btn btn-secondary p-1 ml-1" href="update-patient.php?id=' . $id . '" role="button">Update</a>
                                <a class="btn btn-danger p-1 ml-1" href="delete-patients.php?id=' . $id . '" role="button">Delete</a>
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

    <!-- Add Doctor Modal -->
    <div class="modal fade my-modal" id="addDoctorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Add Doctor Form Content -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="span-close" aria-hidden="true">&times;</span>
                </button> -->
                    <button type="button" class="close close-btn" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <center>
                        <div class="signup-box">
                            <form action="add-patient.php" method="post">
                                <div class="label-field">
                                    <label for="full_name">Full Name:</label>
                                    <input type="text" class="input-field" placeholder="Full Name" name="full_name" id="full_name" autocomplete="off">
                                </div>
                                <div class="label-field">
                                    <label for="address">Address:</label>
                                    <input type="text" class="input-field" placeholder="Address" name="address" id="address" autocomplete="off">
                                </div>
                                <div class="label-field">
                                    <label for="email">Email:</label>
                                    <input type="email" class="input-field" placeholder="Email" name="email" id="email" autocomplete="off">
                                </div>
                                <div class="label-field">
                                    <label for="phone">Mobile Number:</label>
                                    <input type="text" class="input-field" placeholder="Mobile Number" name="phone" id="phone" autocomplete="off">
                                </div>
                                <div class="label-field">
                                    <label for="dob">Date of Birth:</label>
                                    <input type="date" class="input-field" placeholder="Date" name="dob" id="dob">
                                </div>
                                <div class="label-field">
                                    <label for="password">Create Password:</label>
                                    <input type="password" class="input-field" placeholder="Create Password" name="password" id="password">
                                </div>
                                <div class="label-field">
                                    <label for="confirm_password">Confirm Password:</label>
                                    <input type="password" class="input-field" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                                </div>
                                <button type="submit" class="signup-btn">Add Patient</button>
                                <br>
                                <br>


                            </form>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../js/datatables-simple-demo.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</body>

</html>
<script>
    $(document).ready(function() {
        $('.close-btn').on('click', function() {

            $('#addDoctorModal').modal('hide');
        });

    });
</script>