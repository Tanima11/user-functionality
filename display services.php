<?php
include('connection.php');

// Retrieve services from database
$query = "SELECT * FROM `all services`"; // Correct table name syntax if it has spaces
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Display services
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p><b>Service Name:</b> " . htmlspecialchars($row['service_name']) . "<br>";
        echo "<b>Price:</b> " . htmlspecialchars($row['price']) . "<br>";
        echo "<b>Description:</b> " . htmlspecialchars($row['description']) . "<br>";
        echo "<a href='book_service.php?service_id=" . urlencode($row['s_no']) . "'>Book Service</a></p>";
    }
} else {
    echo "<p>No services available.</p>";
}

// Close the database connection
mysqli_close($conn);
?>

   