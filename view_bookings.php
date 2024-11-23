<?php
session_start();
// Include database connection file
include 'connection.php';

// Retrieve bookings from database
$query = "SELECT b.book_id, b.request_id, b.paystatus, b.assign_id, 
                 s.service_name, t.name AS technician_name
          FROM book b
          INNER JOIN `all services` s ON b.service_id = s.s_no
          INNER JOIN technician t ON b.technician_id = t.technician_id
          WHERE b.user_id = '".$_SESSION['user_id']."'";
          $result = mysqli_query($conn, $query);

// Display bookings
if($result){
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p><b>Booking ID:</b> " . $row['book_id'] . "<br>";
    echo "<b>Service Name:</b> " . $row['service_name'] . "<br>";
    echo "<b>Technician Assigned:</b> " . $row['technician_name'] . "<br>";
    echo "<b>Pay Status:</b> " . $row['paystatus'] . "<br>";
    echo "<a href='cancel_booking.php?booking_id=" . $row['book_id'] . "'>Cancel Booking</a></p>";
    
}
echo '<a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>'; // Output HTML as a string


}

else {
    // Query failed, print the error message
    echo "Error executing query: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);


?>
