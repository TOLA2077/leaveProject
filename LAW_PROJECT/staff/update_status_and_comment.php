<?php
// Database connection parameters
include('../conn_db.php');

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the AJAX request
    $staff_id = $_POST['staff_id'];
    $status = $_POST['status'];
    $comment = $_POST['comment'];

    // Update the status and comment in the database
    $sql = "UPDATE form_project SET status = '$status', comment = '$comment' WHERE id = '$staff_id'";
    
    if ($conn->query($sql) === TRUE) {
        // Send a success response
        echo 'Status and comment updated successfully.';
    } else {
        // Send an error response
        echo 'Error updating status and comment: ' . htmlspecialchars($conn->error);
    }
} else {
    // Send an error response for invalid request method
    echo 'Invalid request method.';
}

// Close the database connection
$conn->close();
?>
