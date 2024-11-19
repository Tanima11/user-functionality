<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $type = $_POST['user_type'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone = $_POST['phone'];

    
    $sql = "INSERT INTO user (user_id, user_name, user_type, email, password, phone) 
            VALUES ('$id', '$name', '$type', '$email', '$password', '$phone')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

