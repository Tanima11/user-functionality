<?php
session_start();
include('connection.php');


// Check if user_id is set in POST request
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the user_id from POST
} else {
    echo "User ID not provided!";
    exit();
}


// Check if service ID is provided
if (!isset($_GET['service_id'])) {
    die("Service ID not provided!");
}

$service_id = intval($_GET['service_id']); // Ensure it's an integer

// Retrieve service details
$query = "SELECT * FROM `all services` WHERE s_no = '$service_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error retrieving service details: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $service_row = mysqli_fetch_assoc($result);
} else {
    die("Service not found!");
}

// Retrieve available technicians
$query = "SELECT * FROM technician WHERE availability = 'available'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error retrieving technicians: " . mysqli_error($conn));
}

// Check if any technicians are available
if (mysqli_num_rows($result) > 0) {
    $technician_row = mysqli_fetch_assoc($result);
    $technician_id = $technician_row['technician_id'];

    // Insert booking details into database
    $query = "INSERT INTO book (request_id, technician_id, paystatus, assign_id, service_id, user_id)
              VALUES ('', '$technician_id', 'pending', '', '$service_id', '$user_id')";

    if (mysqli_query($conn, $query)) {
        // Display booking confirmation
        echo "Service booked successfully!<br>";
        echo "Service Name: " . htmlspecialchars($service_row['service_name']) . "<br>";
        echo "Technician Assigned: " . htmlspecialchars($technician_row['name']) . "<br>";
        echo '<a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>'; // Output HTML as a string

    } else {
        die("Error inserting booking: " . mysqli_error($conn));
    }
} else {
    echo "Sorry, no technicians are available for this service.";
}

// Close the database connection
mysqli_close($conn);


?>