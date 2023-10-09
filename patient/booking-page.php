<?php
include '../connection.php';

session_start();

function sendEmail($recipientEmail, $subject, $message) {
 

    $senderEmail = 'prabhatghimire99@gmail.com';

    // Compose the email headers
    $headers = "From: $senderEmail\r\n";
    $headers .= "Reply-To: $senderEmail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    try {
        // Send the email
        if (!mail($recipientEmail, $subject, $message, $headers, "-f $senderEmail")) {
            echo "Failed to send email";
        } 
    } catch (Exception $e) {
        echo "An error occurred while sending the email: " . $e->getMessage();
    }
}
//mycode
// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $preferred_date = $_POST['date'];
  $d_id = $_POST['docid'];
  // $b_id-$_POST['b_id'];

  // Validate form data (add more validation if needed)
  if (empty($full_name) || empty($email) || empty($preferred_date) || empty($d_id)) {
      // Display an error message if any field is empty
      $error = "Please fill in all the fields.";
  } else {
      // Call the function to send the email
      $subject = 'Doctor Appointment Booking Successfully!';
      $message = "Dear $full_name,\n \nYou have successfully booked an appointment with an Online Doctor.\n\nVisit Your Doctor on the scheduled date. YOUR BOOKING ID IS $b_id";
      sendEmail($email, $subject, $message);

  }
}


?>
<?php
include '../connection.php';

// session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
  // Redirect to the login page
  header('Location: ../login.php');
  exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the form data

  // $doctor_name = $_POST['docname'];
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $preferred_date = $_POST['date'];
  $d_id = $_POST['docid'];

  // Validate form data (add more validation if needed)
  if (empty($full_name) || empty($email) || empty($preferred_date) || empty($d_id)) {
    // Display an error message if any field is empty
    $error = "Please fill in all the fields.";
  } else {
    // Prepare and execute the SQL query to insert the booking
    $query = "INSERT INTO bookings (patient_name, email, preferred_date, d_id) VALUES ('$full_name', '$email', '$preferred_date', $d_id)";
    
    if (mysqli_query($con, $query)) {

      if (mysqli_affected_rows($con) > 0) {

        // Redirect to the bookings page
        header('Location: bookings.php');
        exit();
      } else {
        // Failed to insert the booking
        $error = "Failed to insert the booking.";
      }
    } else {
      // Error executing the query
      $error = "Error: " . mysqli_error($con);
    }
  }
}

// Retrieve the doctor ID from the query string
$d_id = isset($_GET['d_id']) ? $_GET['d_id'] : '';

// Retrieve the doctor details based on the doctor ID
$doctor = null;
if (!empty($d_id)) {
  $query = "SELECT * FROM doctors WHERE d_id = $d_id";
  $result = mysqli_query($con, $query);

  if ($result) {
    $doctor = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
  }
}
?>
<?php
include '../connection.php';


// Check if the user is not logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
  // Redirect to the login page
  header('Location: ../login.php');
  exit();
}
$full_name = isset($_GET['name']) ? $_GET['name'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Doctor Appointment System</title>
  <script src="https://kit.fontawesome.com/be7d3971df.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/displaydoctor.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wgRSQh65w1Wvca0ElzgBlkZ7G1e0YL9p1q0jbZFYBn3e1sLneN9ghePL9O4JH5hRSf7Rx5aUIV6BCR56EBU2Zg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* .container{
      background-color: blue;
    } */
    body {
      background-color: blue;
    }

    .container-pdash {
      background-color: crimson;
      /* padding: 5px; */
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
      text-decoration: none;
    }

    .card-icon {
      font-size: 20px;
      cursor: pointer;
    }

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
    }

    .dropdown-menu li a {
      color: #333;
      text-decoration: none;
      display: inline-block;
    }

    .dropdown-menu.show {
      display: block;
    }

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
  </style>
</head>

<body>
  <div class="container-pdash">
    <nav>
      <h3>Welcome, <?php echo $_SESSION['full_name']; ?></h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="mybooking.php">My Bookings</a></li>
        <li><a href="../contact.php">Contact us</a></li>

        <li>
   
          <div class="form-group w-25">
            <input type="text" id="searchInput" class="search form-control" placeholder="Search Doctor" style="outline: none; padding: 4px;">

          </div>
        </li>
        <div class="logoutpanel" style="align-items: center; justify-content:center; display:flex; text-align:right;">
          <a href="patient-logout.php">Logout</a>
        </div>
      </ul>
      <ul>
      </ul>
    </nav>
  </div>

  <?php
  $doctors = [];
  $query = "SELECT * FROM doctors";
  $result = mysqli_query($con, $query);

  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $doctors[] = $row;
    }
  }
  ?>
  <div class="box doctor-box">
    <div class="container">
      <?php foreach ($doctors as $doctor) : ?>
        <div class="box">
          <div class="image">
            <img src="../doctor-images/<?php echo $doctor['image_path']; ?>">
          </div>
          <div class="name_job"><?php echo $doctor['full_name']; ?></div>
          <p><i class="fa-solid fa-user-doctor p-1"></i> <?php echo $doctor['specialist']; ?></p>
          <p><i class="fa-solid fa-phone p-1"></i> <?php echo $doctor['phone']; ?></p>
          <div class="btns">
            <button type="submit" onclick="show(<?php echo $doctor['d_id']; ?>);"> Book Now</button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="modal my-modal" id="popup">
    <div class="modal-dialog my-modal-dialog">
      <div class="modal-content my-modal-content">
        <div class="modal-header my-modal-header">
          <h1 class="modal-title my-modal-title">Book Appointment</h1>
          <button type="button" class="close my-close-button" data-dismiss="modal" aria-label="Close" onclick="hide()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body my-modal-body">
          <form method="post" action="booking-page.php">
            <input type="hidden" id="docid" name="docid" value="<?php echo $doctor['full_name']; ?>">
            <div class="form-group">
              <label for="full_name">Name:</label>
              <input type="text" id="full_name" name="full_name" value="<?php echo $_SESSION['full_name']; ?>" placeholder="Enter your name" class="my-input">

            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo $_SESSION['email']; ?>" class="my-input">
            </div>
            <div class="form-group">
              <label for="date">Preferred Date:</label>
              <input type="date" id="date" name="date" class="my-input">
            </div>
            <button type="submit" class="my-button" style="width: 100%;">Book Now</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  const userIcon = document.getElementById('user-icon');
  const dropdownMenu = document.getElementById('dropdown-menu');

  userIcon.addEventListener('click', function() {
    dropdownMenu.classList.toggle('show');
  });

  // Close the dropdown menu if the user clicks outside
  window.addEventListener('click', function(event) {
    if (!event.target.matches('.card-icon')) {
      if (dropdownMenu.classList.contains('show')) {
        dropdownMenu.classList.remove('show');
      }
    }
  });
</script>

<script>
  function show(dname) {
    document.getElementById('docid').value = dname;
    document.getElementById("popup").style.display = "block";


  }

  function hide() {
    document.getElementById("popup").style.display = "none";
  }
</script>


</html>
<!-- search working -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Function to handle search input changes
    $("#searchInput").on("input", function() {
      var searchTerm = $(this).val().toLowerCase();

      $(".container").each(function() {
        var container = $(this);
        var doctorNames = container.find(".name_job");

        // Check if any doctor name matches the search term
        var isMatchFound = false;
        doctorNames.each(function() {
          var doctorName = $(this).text().toLowerCase();
          if (doctorName.includes(searchTerm)) {
            isMatchFound = true;
            $(this).closest(".box").show(); // Show the matched doctor box
          } else {
            $(this).closest(".box").hide(); // Hide the non-matching doctor boxes
          }
        });

        // Show/hide the container based on the match result
        if (isMatchFound) {
          container.show();
        } else {
          container.hide();
        }
      });
    });
  });
</script>
