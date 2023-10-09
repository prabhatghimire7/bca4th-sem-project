<?php
// delete-booking.php

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Include the connection file
    include '../connection.php';

    // Sanitize and retrieve the 'id' parameter from the URL
    $booking_id = mysqli_real_escape_string($con, $_GET['id']);

    // Create the SQL query to delete the booking record with the provided 'b_id'
    $sql = "DELETE FROM bookings WHERE b_id = $booking_id";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Deletion successful
        echo "Booking with ID $booking_id has been deleted successfully.";
        
        // Redirect to doctor dashboard
        header("Location: mybooking.php");
        exit(); // Make sure to exit after redirection
    } else {
        // Error occurred during deletion
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
} else {
    // 'id' parameter not found in the URL
    echo "Invalid request. Booking ID not specified.";
}
?>
