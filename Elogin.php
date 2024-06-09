<?php
include("db1.php");


if (isset($_POST["login"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
   
    $duplicate = $con->prepare("SELECT * FROM form WHERE email = ?");
    $duplicate->bind_param("s", $email);
    $duplicate->execute();
    $result = $duplicate->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["company"] = $row["company"];
            $_SESSION["email"] = $row["email"];
            header("Location: Shop.php");
            exit();
        } else {
            echo "<script>alert('Wrong password');</script>";
        }
    } else {
        echo "<script>alert('User not registered');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Elogin.css">
   
</head>
<body>
    <div class="container">
        <a href="HTMLPage1.html"><img src="img/image (2).png" class="brand-logo" alt="Brand Logo"></a>
        <form id="login-form">
            <h2>Login</h2>
            <div class="form-group">
                <label for="company">Company Name:</label>
                <input type="text" id="company" name="company" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" id="submit">Login</button>
        </form>
        <div class="create-account">
            <span>Don't have an account? <a href="Esignup.php">Create one</a></span>
            <p>Login as a <a href="login.php">Customer</a>.</p>
        </div>
    </div>
</body>
</html>
