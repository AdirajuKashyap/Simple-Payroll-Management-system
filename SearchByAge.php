<!DOCTYPE html>
<html>
<head>
    <title>Employee Details Search</title>
    <link rel="stylesheet" href="table_css.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: beige;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="number"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: lightgreen;
            color: black;
            font-weight: bold;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        tr {
            background-color: bisque;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        td {
            padding: 12px;
        }

        tr:hover {
            background-color: lightskyblue;
            cursor: pointer;
        }

        td:hover {
            background-color: lightpink;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            text-align: right;
            margin-top: 20px;
            font-style: italic;
        }

        .back-button {
            text-align: center;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .back-button button {
            background-color: red;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .back-button button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Search Employee by Age</h2>
    <form method="post">
        <label for="age">Enter Age:</label>
        <input type="number" name="age" id="age">
        <input type="submit" value="Search">
    </form>

    <?php
    // Database connection parameters
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $username = "root"; // Replace with your actual username
    $password = ""; // Replace with your actual password
    $dbname = "Pay_rolls";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetching search term
    if(isset($_POST['age'])) {
        $age = $_POST['age'];

        // SQL query to join tables
        $sql = "SELECT 
                    ed.Fname,
                    ed.Lname,
                    ed.Employee_id,
                    ed.Emp_age,
                    ed.Employee_phoneno,
                    ed.address,
                    es.Designation,
                    es.Employee_salary,
                    es.Joining_date,
                    ead.Bank_name,
                    ead.Account_number,
                    ead.IFSC_CODE
                FROM 
                    employee_details ed
                INNER JOIN 
                    employee_salary es ON ed.Employee_id = es.Employee_id
                INNER JOIN 
                    employee_account_details ead ON ed.Employee_id = ead.Employee_id
                WHERE 
                    ed.Emp_age = $age";

        $result = $conn->query($sql);

        // Display search results
        if ($result->num_rows > 0) {
            echo "<h2>Search Results:</h2>";
            echo "<table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Employee ID</th>
                        <th>Age</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Designation</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
                        <th>Bank Name</th>
                        <th>Account Number</th>
                        <th>IFSC Code</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Fname'] . "</td>";
                echo "<td>" . $row['Lname'] . "</td>";
                echo "<td>" . $row['Employee_id'] . "</td>";
                echo "<td>" . $row['Emp_age'] . "</td>";
                echo "<td>" . $row['Employee_phoneno'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['Designation'] . "</td>";
                echo "<td>" . $row['Employee_salary'] . "</td>";
                echo "<td>" . $row['Joining_date'] . "</td>";
                echo "<td>" . $row['Bank_name'] . "</td>";
                echo "<td>" . $row['Account_number'] . "</td>";
                echo "<td>" . $row['IFSC_CODE'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    }

    // Close connection
    $conn->close();
    ?>

    <div class="back-button">
        <button onclick="goBack()">Back</button>
    </div>

    <script>
    function goBack() {
        window.location.href = "Search_main.html"; // Replace "your_file_name.php" with the actual file name
    }
</script>

</body>
</html>
