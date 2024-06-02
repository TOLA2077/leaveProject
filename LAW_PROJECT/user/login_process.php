<?php
// Start a session
session_start();

// Include database connection
include ('../conn_db.php');
// Get form data
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from the database based on the provided username
    $sql = "SELECT * FROM user_info WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; // Start the session and store username
            $_SESSION['login_message'] = "Login successful"; // Store login message in session
            header("Location: index.php"); // Redirect to the index page
            exit(); // Ensure that no other code is executed after redirection
        } else {
            $_SESSION['login_message'] = "Invalid username or password"; // Store error message in session
            header("Location: index.php"); // Redirect back to the login page
            exit();
        }
    } else {
        $_SESSION['login_message'] = "Invalid username or password"; // Store error message in session
        header("Location:index.php"); // Redirect back to the login page
        exit();
    }
} else {
    $_SESSION['login_message'] = "Please provide both username and password"; // Store error message in session
    header("Location: index.php"); // Redirect back to the login page
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
