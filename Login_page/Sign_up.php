<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://kit.fontawesome.com/51ef45e87a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
       <a href="Home_page.php"><i class="fa-solid fa-circle-xmark" id="wrong"></i></a>
    <h1> Sign up</h1>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <input type="text" name="First" placeholder=" Enter First name">
        <input type="text" name="second" placeholder=" Enter Last name">
        <input type="email" name="mail" placeholder=" Enter Email">
        <input type="number" name="contact" placeholder=" Enter Contact number">
        <input type="password" name="pass" placeholder=" Enter Password"><br><br>
        <button type="submit" name="reg">Register</button><br><br>
        <p>Do You Have an Account? <a href="Sign_in.php" id="so">Sign In</a></p>
    </form>
    <?php
    if (isset($message)) {
        echo "<p style='color: green; text-align: center;'>" . $message . "</p>";
    }
    ?>
    </div>
</body>
</html>
<?php
include_once('Data_base.php');


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $First = filter_input(INPUT_POST,"First",FILTER_SANITIZE_SPECIAL_CHARS);
    $second = filter_input(INPUT_POST,"second",FILTER_SANITIZE_SPECIAL_CHARS);
    $mail = filter_input(INPUT_POST,"mail",FILTER_SANITIZE_SPECIAL_CHARS);
    $contact = filter_input(INPUT_POST,"contact",FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST,"pass",FILTER_SANITIZE_SPECIAL_CHARS);
    $ps1=password_hash($pass,PASSWORD_DEFAULT);

    if(empty($First)){
        echo "enter First_name";
    }
    elseif(empty($second)){
        echo "enter Second_name";
    }
    elseif(empty($mail)){
        echo "enter Mail";
    }
    elseif(empty($contact)){
        echo "enter contact";
    }
    elseif(empty($pass)){
        echo "enter password";
    }
    else{
        $sql="INSERT INTO Employee (First_name, Last_name, Email, contact, password) 
              VALUES('$First','$second','$mail','$contact','$ps1')";

        mysqli_query($conn,$sql);
        $message="You can Loggin now";
        header('location:Sign_in.php');
    }

}
?>