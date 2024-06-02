<?php
// Connect to the database
include 'conn_db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle user login form submission
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Retrieve user data from the database including the role and active status
    $query = "SELECT user_id, username, password, first_name, last_name, role, department, images, active FROM user_info WHERE username = ?";

    $stmt = $conn->prepare($query);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die('Error: ' . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    // Check if the execution was successful
    if (!$stmt) {
        die('Error: ' . $stmt->error);
    }

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    // Verify password and role
    if ($user && password_verify($password, $user['password'])) {
        // Check if the user is active
        if ($user['active'] == 1) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['images'] = $user['images'];
            
            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header("Location: admin/index.php");
            } elseif ($user['role'] === 'staff') {
                header("Location: staff/index.php");
            } else {
                header("Location: user/index.php");
            }
            exit();
        } else {
            // Redirect with error message if the user is inactive
            header("Location: index.php?error=Your account is inactive");
            exit();
        }
    } else {
        // Redirect with error message for invalid username or password
        header("Location: index.php?error=Invalid username or password");
        exit();
    }
}
?>
