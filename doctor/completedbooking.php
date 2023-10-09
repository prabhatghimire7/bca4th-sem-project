
<?php
if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    $bookingQuery = "SELECT * FROM bookings WHERE b_id = $bookingId";
    $bookingResult = mysqli_query($con, $bookingQuery);
    $bookingData = mysqli_fetch_assoc($bookingResult);

    // Retrieve the doctor's ID from the booking
    $doctorId = $bookingData['d_id'];


    $insertQuery = "INSERT INTO booking_history (patient_name, email, preferred_date, status, d_id) VALUES (
        '" . $bookingData['patient_name'] . "',
        '" . $bookingData['email'] . "',
        '" . $bookingData['preferred_date'] . "',
        'Completed',
        $doctorId
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

// Check if the query was executed successfully
if (!$historyResult) {
    die("Query failed: " . mysqli_error($con));
}
?>

