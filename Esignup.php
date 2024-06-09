<?php

include("db.php");

if (isset($_POST["submit"])) {
    $firstname = $_POST['Fname'];
    $lastname = $_POST['Lname'];
    $Cname = $_POST['company'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
   
    $duplicate = $con->prepare("SELECT * FROM form WHERE company = ? OR email = ?");
    $duplicate->bind_param("ss", $Cname, $email);
    $duplicate->execute();
    $result = $duplicate->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Company name or email is already taken');</script>";
    } else {
       
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
       
        $query = $con->prepare("INSERT INTO form (firstname, lastname, company, email, password) VALUES ('Fname', Lname', 'company', 'email', 'password')");
        $query->bind_param("sssss", $firstname, $lastname, $Cname, $email, $hashed_password);
        
        if ($query->execute()) {
            echo "<script>alert('Registration successful');</script>";
        } else {
            echo "<script>alert('Error: Could not execute the query');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="Esignup.css">
   
</head>
<body>
    <div class="container">
        <a href="HTMLPage1.html"><img src="img/image (2).png" class="brand-logo" alt="Brand Logo"></a>
        <form id="signup-form">
            <h2>Sign up</h2>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="Fname" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="Lname" required>
            </div>
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
            <button type="submit" id="submit">Sign up</button>
        </form>
        <div class="account">
            <span>Already have an account? <a href="Elogin.php">Sign in</a></span>
        </div>
    </div>
</body>
</html>
