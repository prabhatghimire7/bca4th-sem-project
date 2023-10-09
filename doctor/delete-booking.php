<?php

if (isset($_GET['id'])) {

    include '../connection.php';


    $booking_id = mysqli_real_escape_string($con, $_GET['id']);


    $sql = "DELETE FROM bookings WHERE b_id = $booking_id";

  
    if (mysqli_query($con, $sql)) {
      
        echo "Booking with ID $booking_id has been deleted successfully.";
        
       
        header("Location:booking.php");
        exit(); 
    } else {
  
        echo "Error: " . mysqli_error($con);
    }

   
    mysqli_close($con);
} else {
 
    echo "Invalid request. Booking ID not specified.";
}
?>
