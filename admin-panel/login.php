<?php
    $err = false;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $password_hashed = md5($password);

        include ("../globals.php");

        $result = mysqli_query($con, "SELECT * FROM $users WHERE username='$username' AND password='$password_hashed'");

        if(mysqli_num_rows($result)){
            session_start();
            $_SESSION["login"] = true;
            $_SESSION["username"] = $username;
            header("location: index.php");
        }else{
            $err = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/admin-login.css">
</head>
<body>
    <div class="main-container">
        <div class="logo-container">
            <a style="text-decoration: none;" href="../"><img src="../logo/gold.png" class="logo">
            <h1>Shree Krishna Art</h1>
            </a>
        </div>
        <h1 class="heading">Login to Admin Panel</h1>
        <form method="POST" class="form">
            <p class="field-label">Username</p>
            <input type="text" name="username" id="username" placeholder="Enter Username" required>
            <p class="field-label label-pw">Password</p>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
