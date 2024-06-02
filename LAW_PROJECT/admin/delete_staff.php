<?php

// Include the database connection file
include '../conn_db.php';

// Function to delete a staff member
function deleteStaffMember($user_id, $conn) {
    $stmt = $conn->prepare("DELETE FROM user_info WHERE user_id = ?");
    
    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Deletion successful
        return true;
    } else {
        // Deletion failed
        die("Error executing statement: " . $stmt->error);
        return false;
    }
}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the 'user_id' parameter is present in the URL
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        // Call the deleteStaffMember function
        if (deleteStaffMember($user_id, $conn)) {
            // Redirect to the staff listing page after successful deletion
            header("Location: view_user.php");
            exit();
        } else {
            // Handle deletion failure (optional)
            echo "Failed to delete staff member.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}

?>
