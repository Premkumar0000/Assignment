<?php
include_once('Data_base.php');

// Initialize search and sort variables
$searchQuery = '';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc'; // Default order is ascending
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default sort column

// Validate and sanitize the sort column
$validSortColumns = ['id', 'Date_Time', 'First_name', 'Last_name', 'Email', 'contact'];
if (!in_array($sort, $validSortColumns)) {
    $sort = 'id'; // Default to 'id' if invalid sort column
}

// Validate and sanitize the sort order
$order = ($order === 'desc') ? 'desc' : 'asc'; // Default to ascending if invalid order

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

// Pagination variables
$recordsPerPage = 5; // Number of records per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page number
$offset = ($currentPage - 1) * $recordsPerPage; // Calculate offset

// Count total records for pagination
$totalRecordsQuery = "SELECT COUNT(*) as total FROM Employee $searchQuery";
$totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['total'];
$totalPages = ceil($totalRecords / $recordsPerPage); // Calculate total pages

// Fetch records with limit, offset, and sorting for pagination
$sql = "SELECT * FROM Employee $searchQuery ORDER BY $sort $order LIMIT $offset, $recordsPerPage";
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
        <input type="text" name="First_name" id="in" placeholder="SEARCH WITH FIRST NAME">
        <button type="submit" name="ser" id="serc"><i class="fa-solid fa-magnifying-glass"></i></button>
        <button type="submit" name="show_all" id="show_all">All</button>
        <button type="button" id="add" onclick="window.location.href='Add_user.php';"><i class="fa-solid fa-plus"></i></button>
    </div>
</form>
<form method="post" action="download.php">
    <button type="submit" id="down" name="download">
        <i class="fa-solid fa-download"></i>
    </button>
</form>

<div class="table">
    <div class="inside">
        <table>
            <tr>
                <th><a href="?sort=id&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>">ID</a></th>
                <th><a href="?sort=Date_Time&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>">Data & Time</a></th>
                <th><a href="?sort=First_name&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>">FIRST NAME</a></th>
                <th><a href="?sort=Last_name&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>">LAST NAME</a></th>
                <th><a href="?sort=Email&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>">EMAIL</a></th>
                <th><a href="?sort=contact&order=<?php echo $order === 'asc' ? 'desc' : 'asc'; ?>">CONTACT</a></th>
                <th>ACTION</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                $i = $offset + 1; // Start ID from the offset number
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                             <td>$i</td>
                             <td>".$row['Date_Time']."</td>
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
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<!-- Pagination Controls -->
<div class="pagination">
    <?php if ($currentPage > 1): ?>
        <a href="?page=<?php echo $currentPage - 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">Previous</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>" <?php if ($i == $currentPage) echo 'class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?php echo $currentPage + 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">Next</a>
    <?php endif; ?>
</div>

</body>
</html>
