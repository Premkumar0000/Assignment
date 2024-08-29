<?php
include_once('Data_base.php');

// Initialize search variable
$searchQuery = '';

// Check if search is performed
if (isset($_POST['ser']) && !empty($_POST['First_name'])) {
    $First_name = mysqli_real_escape_string($conn, $_POST['First_name']);
    $searchQuery = "WHERE First_name LIKE '%$First_name%'";
} elseif (isset($_POST['show_all'])) {
    // Reset search query to show all records
    $searchQuery = '';
}

// Delete record if delete button is clicked
if (isset($_POST['delete'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];

    $deleteSql = "DELETE FROM Employee WHERE First_name = '$firstName' AND Last_name = '$lastName' AND Email = '$email'";
    if (mysqli_query($conn, $deleteSql)) {
        // Record deleted successfully
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Fetch all records with search query
$sql = "SELECT * FROM Employee $searchQuery";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="Admin_data.css">
    <script src="https://kit.fontawesome.com/51ef45e87a.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="dashboard_header">
    <h1>Welcome Back to DashBoard</h1>
    <a href="Home_page.php"><button id="but"><i class="fa-solid fa-right-from-bracket"></i></button></a>
</div>
<form method="post">
    <div class="search">
        <input type="text" name="First_name" id="in" placeholder="SEARCH WITH FIRST_NAME">
        <button type="submit" name="ser" id="serc"><i class="fa-solid fa-magnifying-glass"></i></button>
        <button type="submit" name="show_all" id="show_all">All</button>
        <button type="submit" name="" id="add"><i class="fa-solid fa-plus"></i></button>
    </div>
</form>
<div class="table">
    <div class="inside">
        <table>
            <tr>
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>EMAIL</th>
                <th>CONTACT</th>
                <th>ACTION</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                             <td>$i</td>
                             <td>" . $row['First_name'] . "</td>
                             <td>" . $row['Last_name'] . "</td>
                             <td>" . $row['Email'] . "</td>
                             <td>" . $row['contact'] . "</td>
                             <td>
                                <form method='post' action='Update.php' style='display: inline;'>
                                    <input type='hidden' name='first_name' value='" . $row['First_name'] . "'>
                                    <input type='hidden' name='last_name' value='" . $row['Last_name'] . "'>
                                    <input type='hidden' name='email' value='" . $row['Email'] . "'>
                                    <input type='hidden' name='contact' value='" . $row['contact'] . "'>
                                    <button type='submit' name='edit' id='boom' style='background-color: blue;
                                    color: white;
                                    border: none;
                                    cursor: pointer;
                                    font-size: large;
                                    height: 5vh;
                                     width: auto;
                                     margin-right: 5px;
                                     padding: 0 10px;
                                     border-radius: 5px; '>
                                        <i class='fa-solid fa-pen-to-square'></i>
                                    </button>
                                </form>
                                <form method='post' action='' style='display: inline;'>
                                    <input type='hidden' name='first_name' value='" . $row['First_name'] . "'>
                                    <input type='hidden' name='last_name' value='" . $row['Last_name'] . "'>
                                    <input type='hidden' name='email' value='" . $row['Email'] . "'>
                                    <button type='submit' name='delete' id='boom' style='background-color: red;
    color: white;
    border: none;
    cursor: pointer;
    font-size: large;
    height: 5vh;
    width: auto;
    margin-right: 5px;
    padding: 0 10px;
    border-radius: 5px; '>
                                        <i class='fa-solid fa-trash'></i>
                                    </button>
                                </form>
                             </td>
                          </tr>";
                    $i++;
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
