<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: beige;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: blanchedalmond;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: lightgreen;
            color: #fff;
            font-weight: bold;
            border-top: 2px solid #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
            margin-top: 20px;
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
    <div class="container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pay_rolls";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT 
                    ed.Employee_id,
                    ed.Fname,
                    ed.Lname,
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
                    employee_account_details ead ON ed.Employee_id = ead.Employee_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
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
                echo "<tr>
                        <td>" . $row["Employee_id"]. "</td>
                        <td>" . $row["Fname"]. " " . $row["Lname"]. "</td>
                        <td>" . $row["Emp_age"]. "</td>
                        <td>" . $row["Employee_phoneno"]. "</td>
                        <td>" . $row["address"]. "</td>
                        <td>" . $row["Designation"]. "</td>
                        <td>" . $row["Employee_salary"]. "</td>
                        <td>" . $row["Joining_date"]. "</td>
                        <td>" . $row["Bank_name"]. "</td>
                        <td>" . $row["Account_number"]. "</td>
                        <td>" . $row["IFSC_CODE"]. "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </div>

    <div class="back-button">
        <button onclick="goBack()">Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>
