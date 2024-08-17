<?php
// Database connection parameters
$servername = "localhost";  // Replace with your database server hostname
$username = "root";         // Replace with your MySQL username
$password = "";             // Replace with your MySQL password
$dbname = "pay_rolls";      // Replace with your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement for inserting employee details
$sqlEmployeeDetails = "INSERT INTO employee_details (Employee_id, Fname, Lname, Emp_age, Employee_phoneno, Address)
                       VALUES (?, ?, ?, ?, ?, ?)";

// Prepare SQL statement for inserting employee salary details
$sqlEmployeeSalary = "INSERT INTO employee_salary (Employee_id, Designation, Employee_salary, Joining_date)
                      VALUES (?, ?, ?, ?)";

// Prepare SQL statement for inserting employee account details
$sqlEmployeeAccount = "INSERT INTO employee_account_details (Employee_id, Bank_name, Account_number, IFSC_CODE)
                       VALUES (?, ?, ?, ?)";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $employee_id = isset($_POST["employee_id"]) ? $_POST["employee_id"] : null;
    $fname = isset($_POST["fname"]) ? $_POST["fname"] : null;
    $lname = isset($_POST["lname"]) ? $_POST["lname"] : null;
    $emp_age = isset($_POST["emp_age"]) ? $_POST["emp_age"] : null;
    $employee_phoneno = isset($_POST["employee_phoneno"]) ? $_POST["employee_phoneno"] : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;
    $designation = isset($_POST["designation"]) ? $_POST["designation"] : null;
    $employee_salary = isset($_POST["employee_salary"]) ? $_POST["employee_salary"] : null;
    $joining_date = isset($_POST["joining_date"]) ? $_POST["joining_date"] : null;
    $bank_name = isset($_POST["bank_name"]) ? $_POST["bank_name"] : null;
    $account_number = isset($_POST["account_number"]) ? $_POST["account_number"] : null;
    $ifsc_code = isset($_POST["ifsc_code"]) ? $_POST["ifsc_code"] : null;

    // Check if employee ID is not null
    if ($employee_id !== null) {
        // Use prepared statements to prevent SQL injection
        $stmt1 = $conn->prepare($sqlEmployeeDetails);
        $stmt1->bind_param("sssiis", $employee_id, $fname, $lname, $emp_age, $employee_phoneno, $address);

        $stmt2 = $conn->prepare($sqlEmployeeSalary);
        $stmt2->bind_param("ssds", $employee_id, $designation, $employee_salary, $joining_date);

        $stmt3 = $conn->prepare($sqlEmployeeAccount);
        $stmt3->bind_param("ssss", $employee_id, $bank_name, $account_number, $ifsc_code);

        // Execute prepared statements
        $stmt1->execute();
        $stmt2->execute();
        $stmt3->execute();

        // Check for successful insertion
        if ($stmt1->affected_rows > 0 && $stmt2->affected_rows > 0 && $stmt3->affected_rows > 0) {
            echo "<script>alert('Employee data inserted successfully.'); window.location.href = 'insert_employee.html';</script>";
        } else {
            echo "<script>alert('Error: Unable to insert employee data. Please try again later.'); window.location.href = 'insert_employee.html';</script>";
        }

        // Close prepared statements
        $stmt1->close();
        $stmt2->close();
        $stmt3->close();
    } else {
        echo "<script>alert('Error: Missing or null Employee ID'); window.location.href = 'insert_employee_form.html';</script>";
    }
}

// Close database connection
$conn->close();
?>
