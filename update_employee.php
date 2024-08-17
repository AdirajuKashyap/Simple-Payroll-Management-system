<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pay_rolls";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data) {
    // Remove leading and trailing whitespace
    $data = trim($data);
    // Remove special characters
    $data = htmlspecialchars($data);
    return $data;
}

// Function to update employee details
function update_employee_details($conn, $employee_id, $new_fname, $new_lname, $new_age, $new_phone, $new_address, $new_designation, $new_salary, $new_joining_date, $new_bank_name, $new_account_number, $new_ifsc_code) {
    $employee_id = sanitize_input($employee_id);
    $new_fname = sanitize_input($new_fname);
    $new_lname = sanitize_input($new_lname);
    $new_age = sanitize_input($new_age);
    $new_phone = sanitize_input($new_phone);
    $new_address = sanitize_input($new_address);
    $new_designation = sanitize_input($new_designation);
    $new_salary = sanitize_input($new_salary);
    $new_joining_date = sanitize_input($new_joining_date);
    $new_bank_name = sanitize_input($new_bank_name);
    $new_account_number = sanitize_input($new_account_number);
    $new_ifsc_code = sanitize_input($new_ifsc_code);

    // Update employee details in employee_details table
    $sql_employee_details = "UPDATE employee_details SET Fname='$new_fname', Lname='$new_lname', Emp_age='$new_age', Employee_phoneno='$new_phone', address='$new_address' WHERE Employee_id='$employee_id';";

    // Update employee details in employee_salary table
    $sql_salary = "UPDATE employee_salary SET Designation='$new_designation', Employee_salary='$new_salary', Joining_date='$new_joining_date' WHERE Employee_id='$employee_id';";

    // Update employee details in employee_account_details table
    $sql_account_details = "UPDATE employee_account_details SET Bank_name='$new_bank_name', Account_number='$new_account_number', IFSC_CODE='$new_ifsc_code' WHERE Employee_id='$employee_id';";

    // Execute queries
    if ($conn->multi_query($sql_employee_details . $sql_salary . $sql_account_details) === TRUE) {
        // JavaScript code for popup alert and redirect
        echo '<script>alert("Employee details updated successfully."); window.location.href = "update_employee.html";</script>';
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST["employee_id"];
    $new_fname = $_POST["new_fname"];
    $new_lname = $_POST["new_lname"];
    $new_age = $_POST["new_age"];
    $new_phone = $_POST["new_phone"];
    $new_address = $_POST["new_address"];
    $new_designation = $_POST["new_designation"];
    $new_salary = $_POST["new_salary"];
    $new_joining_date = $_POST["new_joining_date"];
    $new_bank_name = $_POST["new_bank_name"];
    $new_account_number = $_POST["new_account_number"];
    $new_ifsc_code = $_POST["new_ifsc_code"];

    // Update employee details
    update_employee_details($conn, $employee_id, $new_fname, $new_lname, $new_age, $new_phone, $new_address, $new_designation, $new_salary, $new_joining_date, $new_bank_name, $new_account_number, $new_ifsc_code);
}

// Close connection
$conn->close();

?>
