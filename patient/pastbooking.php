<?php
include '../connection.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect to the login page
    header('Location: ../login.php');
    exit();
}
$email=$_SESSION['email'];
$full_name = isset($_GET['name']) ? $_GET['name'] : '';


// Fetch booking history records for the current logged-in user
// $historyQuery = "SELECT * FROM booking_history 
//                  WHERE email = '$email'"; // Only fetch records for the current user's email
$historyQuery = "SELECT bh.*, d.full_name
                 FROM booking_history bh
                 LEFT JOIN doctors d ON bh.d_id = d.d_id
                 WHERE bh.email = '$email'"; // Only fetch records for the current user's email

$historyResult = mysqli_query($con, $historyQuery);
$historyResult = mysqli_query($con, $historyQuery);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Doctor Appointment System</title>
    <script src="https://kit.fontawesome.com/be7d3971df.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="../css/header.css"> -->
    <!-- <link rel="stylesheet" href="../css/displaydoctor.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wgRSQh65w1Wvca0ElzgBlkZ7G1e0YL9p1q0jbZFYBn3e1sLneN9ghePL9O4JH5hRSf7Rx5aUIV6BCR56EBU2Zg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <style>
        body {

      background-image: url(../images/b4.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-attachment: fixed;
      height: 100%;
        }

        .container-pdash {
            background-color: crimson;
            padding: 10px;
  margin-bottom: 5px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        ul li {
            margin-right: 20px;
        }

        a {
            color: white;
            /* text-decoration: none; */
        }
       

        .card-icon {
            font-size: 20px;
            cursor: pointer;
        }
/* 
        .dropdown-menu {
            position: absolute;
            transform: translateX(-50%);
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: none;
        } */

        /* .dropdown-menu li a {
            color: #333;
            text-decoration: none;
            display: inline-block;
        }

        .dropdown-menu.show {
            display: block;
        } */

        /* Add styling for the search input */
        .search-input {
            border: none;
            /* background-color: transparent; */
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px;
            border-radius: 4px;
            outline: none;
            transition: background-color 0.3s ease;
            width: 200px;
        }

        .search-input:focus {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .search-input::placeholder {
            color: white;
        }

        .search-button {
            background-color: transparent;
            border: none;
            padding: 8px;
            cursor: pointer;
        }

        .search-icon {
            color: white;
        }

        #myInput {
            padding: 20px;
            margin-top: -6px;
            border: 0;
            border-radius: 0;
            background: #f1f1f1;
        }

        /* Popup Booking Form CSS  */
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



        .my-modal-dialog {
            position: relative;
            margin: 10% auto;
            width: 80%;
            max-width: 500px;
        }

        .my-modal-content {
            background-color: #fff;
            border-radius: 4px;
            width: 70%;
            /* Adjust the width as desired */
            margin: 0 auto;
            /* Center the modal horizontally */
        }



        .my-modal-header {
            padding: 15px;
            background-color: #f2f2f2;
            border-bottom: 1px solid #ddd;
        }

        .my-modal-title {
            margin: 0;
            font-size: 24px;
        }

        .my-modal-body {
            padding: 20px;
        }

        .my-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .my-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .my-button:hover {
            background-color: #0056b3;
        }

        .my-close-button {
            position: absolute;
            top: 0;
            right: 75px;
            padding: 10px;
            color: #000;
            opacity: 0.5;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .my-close-button:hover {
            opacity: 1;
        }

        .section {
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container-pdash">
        <nav>
            <h3></h3>
            <ul>
                <li><a href="patient-dashboard.php">Home</a></li>
                <li><a href="mybooking.php">My Bookings</a></li>
                <li><a href="pastbooking.php">Booking History</a></li>
                <div class="logoutpanel" style="align-items: center; justify-content:center; display:flex; text-align:right;">
                    <a href="patient-logout.php">Logout</a>
                </div>
            </ul>
            <ul>
            </ul>
        </nav>
    </div>


      <div class="section">
    <div class="table-container">
        <table id="BookingHistory" class="table table-striped table-bordered">
        <h2 class="text-center">Booking History</h2>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Email</th>
                    <th>Preferred Date</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($historyRow = mysqli_fetch_assoc($historyResult)) {
                    echo "<tr>";
                    echo "<td>" . $historyRow['history_id'] . "</td>";
                    echo "<td>" . $historyRow['patient_name'] . "</td>";
                    echo "<td>" . $historyRow['email'] . "</td>";
                    echo "<td>" . $historyRow['preferred_date'] . "</td>";
                    echo "<td>" . $historyRow['full_name'] . "</td>";
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
</div>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#appointmentsTable').DataTable();
            });
        </script>
</body>

</html>

<!-- <php
include '../connection.php'; // Include your database connection

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch booking history records based on search
$historyQuery = "SELECT * FROM booking_history 
                 WHERE patient_name LIKE '%$search%' OR email LIKE '%$search%' OR preferred_date LIKE '%$search%'";
$historyResult = mysqli_query($con, $historyQuery);
?>
 -->

    <!-- Include your scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#BookingHistory').DataTable();
        });
    </script>
