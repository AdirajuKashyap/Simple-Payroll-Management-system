<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pay_rolls";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$employee_id = $_GET['employee_id'];

$sql1 = "DELETE FROM employee_salary WHERE Employee_id='$employee_id'";
$sql2 = "DELETE FROM employee_details WHERE Employee_id='$employee_id'";
$sql3 = "DELETE FROM employee_account_details WHERE Employee_id='$employee_id'";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE) {
    echo "Record deleted successfully <br>";
} else {
    echo "Error deleting record from : " . $conn->error . "<br>";
}



$conn->close();
?>
