<?php
session_start();
include('connection.php'); // Include your DB connection

// Check if user_id is set in POST request
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Get the user_id from POST
} else {
    echo "User ID not provided!";
    exit();
}

// Fetch the user's profile details from the database
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}
?>

<!-- Display the technician's profile -->
<h1>Your Profile</h1>

<p><strong>id:</strong> <?php echo $user['user_id']; ?></p>
<p><strong>Name:</strong> <?php echo $user['user_name']; ?></p>
<p><strong>Type:</strong> <?php echo $user['user_type']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>
<p><strong>Password:</strong> <?php echo $user['password']; ?></p>
<p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>


<!-- Link to edit profile -->
<a href="edit.php">Edit Profile</a>