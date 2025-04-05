<?php
// Step 1: Database connection
$servername = "localhost";
$username = "root";  // Default for XAMPP
$password = "";  // No password by default
$database = "student_db"; 

$conn = new mysqli($servername, $username, $password, $database);

// Step 2: Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Retrieve Data from Database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        body { font-family: Arial, sans-serif; background-color:rgb(234, 245, 222); }
        .container { width: 60%; margin: 50px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px gray; background-color:rgb(204, 240, 175) }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid black; text-align: left;background-color:rgb(196, 240, 145) }
      
    </style>
</head>
<body>

<div class="container">
    <h2>Student Records</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
        </tr>

        <?php
        // Step 4: Display Data in an HTML Table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }
        ?>

    </table>
</div>

</body>
</html>

<?php
// Step 5: Close the Connection
$conn->close();
?>
