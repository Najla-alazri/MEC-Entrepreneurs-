<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and execute the SQL statement to fetch user data
        $stmt = $con->prepare("SELECT email, password FROM form WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

           
            if (password_verify($password, $user_data['password'])) {
               
                header("Location: Shop.php");
                exit();
            } else {
                header("Location: Shop.php");
            }
        } else {
            $error = "User not found.";
        }
    } else {
        $error = "Please enter both email and password.";
    }
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>

    <div class="login-box">
        <a href="HTMLPage1.html"><img src="img/image (2).png" class="brand-logo" alt=""></a>
        <h2>Login</h2>
        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" id="submit" value="Login">
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="signup.php">Create one here</a>.</p>
            <p>Login as a <a href="Elogin.html">business owner</a>.</p>
        </div>
    </div>
</body>
</html>



