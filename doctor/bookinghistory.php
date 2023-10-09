<?php
include '../connection.php';

if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    
    $bookingQuery = "SELECT * FROM bookings WHERE b_id = $bookingId";
    $bookingResult = mysqli_query($con, $bookingQuery);
    $bookingData = mysqli_fetch_assoc($bookingResult);

    $doctorId = $bookingData['d_id'];

    $insertQuery = "INSERT INTO booking_history (patient_name, email, preferred_date, status, d_id) VALUES (
        '" . $bookingData['patient_name'] . "',
        '" . $bookingData['email'] . "',
        '" . $bookingData['preferred_date'] . "',
        'Completed',
        '$doctorId'
    )";
    
    
    mysqli_query($con, $insertQuery);

    // Delete the booking entry from the current bookings table
    $deleteQuery = "DELETE FROM bookings WHERE b_id = $bookingId";
    mysqli_query($con, $deleteQuery);

    // Redirect back to the original page (optional)
    header("Location: doctor-view-history.php");
    exit();
}
?>
<?php
include '../connection.php'; 

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch booking history records based on search
$historyQuery = "SELECT * FROM booking_history 
                 WHERE patient_name LIKE '%$search%' OR email LIKE '%$search%' OR preferred_date LIKE '%$search%'";
$historyResult = mysqli_query($con, $historyQuery);
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/be7d3971df.js" crossorigin="anonymous"></script>
<head>
    
</head>
<body>
    <div class="container" >
        <h1 class="mt-4">Booking History</h1>
        
 
        <div id="datatable">
            <table class="table table-bordered" id="BookingHistory">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Preferred Date</th>
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
                        echo "<td><span style='background-color:green; color:white; padding:4px;'>Completed</span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#BookingHistory').DataTable();
            });
        </script>
