
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
    <form action="signin.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Sign In</button>
    </form>
</body>
</html>

<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "Staff";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get email and password from the form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare the SQL statement to prevent SQL injection
$sql = $conn->prepare("SELECT * FROM Employee WHERE email = ? AND password = ?");
$sql->bind_param("ss", $email, $password);

// Execute the statement
$sql->execute();

// Store the result
$result = $sql->get_result();

// Check if a matching record was found
if ($result->num_rows > 0) {
    // Success: Redirect to the landing page
    header("Location: landing_page.php");
    exit();
} else {
    // Failure: Show an error message
    echo "Invalid email or password.";
}

// Close the connection
$sql->close();
$conn->close();
?>
