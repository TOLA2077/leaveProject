<?php
// Include the database connection file
include('../conn_db.php');

// Check if user_id and active parameters are set in the URL
if (isset($_GET['user_id']) && isset($_GET['active'])) {
    // Sanitize input to prevent SQL injection
    $user_id = intval($_GET['user_id']);
    $active = intval($_GET['active']);

    // Update the active status in the database
    $stmt = $conn->prepare("UPDATE user_info SET active = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $active, $user_id);

    if ($stmt->execute()) {
        // Redirect back to the previous page after toggling the active status
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // If update fails, display an error message
        echo "Error updating active status: " . $conn->error;
    }
} else {
    // If user_id or active parameter is missing from the URL, display an error message
    echo "Error: user_id and active parameters are required.";
}

// Close the database connection
$conn->close();
?>
