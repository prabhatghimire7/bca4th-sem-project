
<?php
include '../connection.php'; 

if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    // Fetch the booking information using the booking ID
    $bookingQuery = "SELECT * FROM bookings WHERE b_id = $bookingId";
    $bookingResult = mysqli_query($con, $bookingQuery);
    $bookingData = mysqli_fetch_assoc($bookingResult);

    // Retrieve the doctor's ID from the booking
    $doctorId = $bookingData['d_id'];

    // Insert the booking information into your booking history table
    $insertQuery = "INSERT INTO booking_history (patient_name, email, preferred_date, status, d_id) VALUES (
        '" . $bookingData['patient_name'] . "',
        '" . $bookingData['email'] . "',
        '" . $bookingData['preferred_date'] . "',
        'Absent',
        $doctorId
    )";
    mysqli_query($con, $insertQuery);

   
    $deleteQuery = "DELETE FROM bookings WHERE b_id = $bookingId";
    mysqli_query($con, $deleteQuery);

   
    header("Location: doctor-view-history.php");
    exit();
}
?>
<?php
include '../connection.php'; // Include your database connection

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch booking history records based on search
$historyQuery = "SELECT * FROM booking_history 
                 WHERE patient_name LIKE '%$search%' OR email LIKE '%$search%' OR preferred_date LIKE '%$search%'";
$historyResult = mysqli_query($con, $historyQuery);
?>
