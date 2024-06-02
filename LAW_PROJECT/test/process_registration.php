<?php
include '../conn_db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Prepare and execute SQL query with parameter binding
    $stmt = $conn->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $username, $password, $name);

        if ($stmt->execute()) {
            echo "User registered successfully!";
        } else {
            echo "Error registering user. Please try again.";
        }

        $stmt->close();
    } else {
        echo "Prepare statement failed.";
    }
}
// Close the database connection
$conn->close();
?>
