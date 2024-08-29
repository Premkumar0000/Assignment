<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://kit.fontawesome.com/51ef45e87a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <i class="fa-solid fa-circle-xmark" id="wrong"></i>
    <h1> Sign In</h1>
    <form method="post">
        <input type="email" name="mail" placeholder=" Enter Email">
        <input type="password" name="pass" placeholder=" Enter Password"><br><br>
        <button type="submit" name="sig">Sign In</button><br><br>
        <p>New to this page?<a href="Sign_up.php" id="so">Resiger Now</a></p>

    </form>
    </div>
</body>
</html>
<?php
session_start(); // Start the session

include_once('Data_base.php');

// Check if the form is submitted
if (isset($_POST['sig'])) {

    $mail = $_POST['mail'];
    $pass = $_POST['pass'];

    $stmt = $conn->prepare("SELECT * FROM Employee WHERE Email = ?");
    $stmt->bind_param("s", $mail);
    
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($pass, $user['password'])) { 
            // Store user details in session variables
            $_SESSION['first_name'] = $user['First_name'];
            $_SESSION['last_name'] = $user['Last_name'];

            // Redirect to the landing page
            header("Location: landing.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid email address.";
    }

    $stmt->close();
    $conn->close();
}
?>


