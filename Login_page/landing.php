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
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            color: blue;
            margin: 0 auto; /* Center the navbar */
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow for navbar */
        }

        .logo {
            font-size: 2.5em; /* Slightly larger logo */
            font-weight: bold;
            color: #007BFF; /* Blue color for the logo */
        }

        .links {
            display: flex;
            gap: 20px;
        }

        .links a {
            text-decoration: none;
            color: blue;
            font-size: 1.2em; /* Slightly smaller text for links */
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .links a:hover {
            color: black;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); 
            gap: 20px; 
            padding: 40px 5%; 
            margin-top: 20px; 
        }

        .col {
            padding: 20px;
            border-radius: 10px; /* More rounded corners */
        }

        h1 {
            font-size: 2.7em;
            color: black; 
            margin-bottom: 20px; 
            padding-top:20%;
        }

        img {
            max-width: 100%; 
            height: auto; 
        }
        #ex{
            width: 30%;
            height:6vh;
            background-color:#007BFF;
            border:none;
            margin-top:5%;
            color:white;
            font-size:1em;
            cursor: pointer;

        }
        #ss{
            width: 30%;
            height:6vh;
            background-color:white;
            border:none;
            margin-top:5%;
            color:#007BFF;
            font-size:1em;
            border:1px solid #007BFF;
            margin-left:4%;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">Logo</div>
        <div class="links">
            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#services">Services</a>
            <a href="#contact">Contact</a>
            <a href="./Home_page.php">Logout</a>
        </div>
    </nav>
    <div class="container">
        <div class="col">
            <h1>Welcome Back Mr/Ms<br> <?php echo htmlspecialchars($firstName . ' ' . $lastName); ?>!</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis alias sequi blanditiis repudiandae aliquid quod repellat vitae amet facere aperiam. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus, voluptatem Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad, quae.</p>
            <button id="ex">Explore</button><button id="ss">Shop Now</button>

        </div>
        <div class="col">
            <p><img src="Landing page-rafiki.png" alt="" srcset=""></p>
        </div>
    </div>
</body>
</html>
