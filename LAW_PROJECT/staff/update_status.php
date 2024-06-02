<?php
// Database connection parameters
include('../conn_db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the status and staff_id are set
    if (isset($_POST['status']) && isset($_POST['staff_id'])) {
        // Sanitize and store the values
        $staff_id = $_POST['staff_id'];
        $newStatus = ($_POST['status'] == 'អនុញ្ញាត') ? 'អនុញ្ញាត' : 'មិនអនុញ្ញាត';

        // Update the status in the database
        $sql = "UPDATE form_project SET status = '$newStatus' WHERE id = '$staff_id'";
        if ($conn->query($sql) === TRUE) {
            // Status updated successfully, redirect back to the page where the form was submitted
            header("Location: ".$_SERVER['HTTP_REFERER']."?success=Status updated successfully");
            exit();
        } else {
            // Error occurred while updating status
            header("Location: ".$_SERVER['HTTP_REFERER']."?error=Failed to update status");
            exit();
        }
    } else {
        // Redirect back to the page where the form was submitted with an error message
        header("Location: ".$_SERVER['HTTP_REFERER']."?error=Invalid request");
        exit();
    }
} else {
    // Redirect back to the page where the form was submitted with an error message
    header("Location: ".$_SERVER['HTTP_REFERER']."?error=Invalid request");
    exit();
}
?>
