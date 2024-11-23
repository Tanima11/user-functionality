<?php
// Include database connection file
include 'connection.php';

// Get booking ID from URL
$booking_id = $_GET['booking_id'];

// Update booking status to cancelled
$query = "UPDATE book SET paystatus = 'cancelled' WHERE book_id = '$booking_id'";
mysqli_query($conn, $query);

// Display cancellation confirmation
echo "Booking cancelled successfully!";

echo '<a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>'; // Output HTML as a string


?>