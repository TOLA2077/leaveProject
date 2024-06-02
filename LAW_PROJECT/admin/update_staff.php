<?php
include('../conn_db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $skills = $_POST['skills'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Note: Passwords should be hashed in a real application
    $gmail = $_POST['gmail'];
    $phone_number = $_POST['phone_number'];

    // Update the database
    $sql = "UPDATE user_info 
            SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                role = '$role', 
                department = '$department', 
                skills = '$skills', 
                username = '$username', 
                password = '$password', 
                gmail = '$gmail', 
                phone_number = '$phone_number' 
            WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the view_staff.php page after successful update
        header("Location: index.php");
        exit();
    } else {
        // Handle the error (you might want to improve error handling)
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Handle non-POST requests (optional)
    echo "Invalid request method.";
}

// Close the connection when you're done
$conn->close();
?>
