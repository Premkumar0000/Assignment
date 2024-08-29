<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="signup.css">
    <script src="https://kit.fontawesome.com/51ef45e87a.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <i class="fa-solid fa-circle-xmark" id="wrong"></i>
    <h1>Admin</h1>
    <form method="post">
        <input type="text" name="text" placeholder=" Enter user Id">
        <input type="password" name="pass" placeholder=" Enter Password"><br><br>
        <button type="submit" name="sub">Login</button><br><br>

    </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['sub'])){
    $text=$_POST['text'];
    $pass=$_POST['pass'];
    if($text=='admin' && $pass == '123'){
        header("Location:Admin_data.php");
        exit();
    }
    else{
        echo "invalid user id or password";
    }
};
?>