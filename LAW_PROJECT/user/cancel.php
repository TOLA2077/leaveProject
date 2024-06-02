<?php
include('../conn_db.php');

// Check if the ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Update the status to 'Cancelled' in the database
    $status = 'បោះបង់ការស្នើសុំ';
    $stmt = $conn->prepare("UPDATE form_project SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the page where the user made the cancellation
    header("Location: index.php");
    exit();
} else {
    // If ID parameter is not set, redirect to an error page or handle accordingly
    header("Location: error_page.php");
    exit();
}
?>
