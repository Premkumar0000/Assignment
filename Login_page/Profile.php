<?php
include_once('Data_base.php');

// Initialize variables to avoid warnings
$firstName = $lastName = $email = $contact = $password = "";

// Check if the form is submitted for an update
if (isset($_POST['reg'])) {
    // Retrieve updated values from the form
    $firstName = $_POST['First'];
    $lastName = $_POST['second'];
    $email = $_POST['mail'];
    $contact = $_POST['contact'];
    $password = $_POST['pass'];
    $pro=password_hash($password,PASSWORD_DEFAULT);

    // Update query
    $updateSql = "UPDATE Employee 
                  SET First_name = '$firstName', Last_name = '$lastName', Email = '$email', contact = $contact, password = '$pro'
                  WHERE Email = '$email'";

    // Execute the query and check for success
    if (mysqli_query($conn, $updateSql)) {
        echo "Record updated successfully";
        // Redirect back to Admin_data.php after update
        header("Location: Sign_in.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Pre-fill form data if redirected from Admin_data.php
    $firstName = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $lastName = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $pro = isset($_POST['pass']) ? $_POST['pass'] : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://kit.fontawesome.com/51ef45e87a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <a href="Home_page.php"><i class="fa-solid fa-circle-xmark" id="wrong"></i></a>
        <h1>Update</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="First" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="Enter First name">
            <input type="text" name="second" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Enter Last name">
            <input type="email" name="mail" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter Email">
            <input type="number" name="contact" value="<?php echo htmlspecialchars($contact); ?>" placeholder="Enter Contact number">
           <br><br>
            <button type="submit" name="reg">Update</button><br><br>
        </form>
    </div>
</body>
</html>
