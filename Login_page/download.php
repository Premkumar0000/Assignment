<?php
include_once('Data_base.php');

header('Content-Type:text/csv;charset=uft-8');
header('Content-disposition:attchment;filename=Employee_data.php');
$output=("php://output",'w');

fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Contact'));

$query = "SELECT * FROM Employee";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        
        fputcsv($output, array($i, $row['First_name'], $row['Last_name'], $row['Email'], $row['contact']));
        $i++;
    }
}
mysqli_close($conn);
exit();
?>
