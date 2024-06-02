<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}

// Include your database connection file
include '../conn_db.php';

// Get user ID and name from the session
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Extract form data
$fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
$toDate = mysqli_real_escape_string($conn, $_POST['toDate']);
$because = mysqli_real_escape_string($conn, $_POST['because']);

// Prepare and execute SQL query for sending law to staff
$query = "INSERT INTO laws (user_id, user_name, from_date, to_date, because) VALUES ('$user_id', '$user_name', '$fromDate', '$toDate', '$because')";
mysqli_query($conn, $query);

// Redirect back to the previous page or any other page
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
