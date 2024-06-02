<?php
// Establish database connection
include ('connect_db.php');

// Retrieve form data
$name = $_POST['name'];
$number = $_POST['number'];
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$becuse = $_POST['becuse'];

// Prepare and execute SQL query to insert data into the database
$sql = "INSERT INTO user_requests (name, number, fromDate, toDate, becuse) VALUES ('$name', $number, '$fromDate', '$toDate', '$becuse')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
