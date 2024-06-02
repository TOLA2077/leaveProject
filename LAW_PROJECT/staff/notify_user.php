<?php
include_once ('../conn_db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $reason = $_POST['reason'];
    $message = $_POST['message'];

    // Additional logic based on the reason
    if ($reason === 'មិនអនុញ្ញាត') {
        // Send a notification to the user or store the message in a database
        // Example: mail($userEmail, 'Action Not Allowed', $message);
        // Or save the message to a database table
        // ...

        // Redirect the user back to the original page or provide a success message
        header("Location: original_page.php?notification=success");
        exit();
    }
}
?>
