<?php
session_start(); // Start the session

include_once('Data_base.php');

// Retrieve user details from session
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Guest';
$lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="landing.css">
</head>
<body>
    <a href="./Profile.php"><div class="box">
    <img src="https://cdn-icons-png.flaticon.com/512/9187/9187604.png" alt="" srcset="" width="4%">
    </div></a><br>
    <!-- Greet the user with their first and last name -->
    <h1>Welcome Back Mr/Ms<br> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>!</h1>
     <div class="container"></div>


</body>
</html>
