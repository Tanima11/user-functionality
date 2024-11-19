<?php
session_start();
include('connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if($result){

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['password'] = $user['password'];
        header("Location: dashboard.php");
    } else {

        echo "Invalid email or password.";
    }
}else{
    echo "no user found with this email";
}
}

mysqli_close($conn);
?>

<form action="login.php" method="POST">
<label for="id">Id:</label><br>
        <input type="text"  name="user_id" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit" name="login">Login</button>
    </form>