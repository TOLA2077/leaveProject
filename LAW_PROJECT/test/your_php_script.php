<?php
 // Establish database connection
 $servername = "localhost";
 $username = "root";
 $password = "";
 $dbname = "new_project";

 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }

// Retrieve data from the registration form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$role = $_POST['role'];
$department = $_POST['department'];
$skills = $_POST['skills'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$gmail = $_POST['gmail'];
$phone_number = $_POST['phone_number'];


// SQL query to insert data into the database
$sql = "INSERT INTO user_info (first_name, last_name, role, department, skills, username, password, gmail, phone_number)
        VALUES ('$first_name', '$last_name', '$role', '$department', '$skills', '$username', '$password', '$gmail', '$phone_number')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
