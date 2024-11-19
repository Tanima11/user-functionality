<?php
session_start();
include('connection.php'); // Include your DB connection

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the user_id from session

// Fetch the current profile data
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}

if (isset($_POST['update'])) {
    // Get the updated data from the form
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Update the user profile in the database
    $update_query = "UPDATE user SET email = '$new_email', password = '$new_password ' WHERE user_id = '$user_id'"; 
    if (mysqli_query($conn, $update_query)) {
        echo "Profile updated successfully!";
        header('Location: profile.php'); // Redirect to profile page after update
    } else {
        echo "Error updating profile!";
    }
}
?>

<!-- Edit Profile Form -->
<h1>Edit Profile</h1>
<form method="POST" action="">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    
    <label for="password">Password:</label>
    <input type="text" name="password"  required><br>

    <input type="submit" name="update" value="Update Profile">
</form>