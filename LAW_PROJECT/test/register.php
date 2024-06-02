<?php
// Connect to the database
include '../conn_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle user registration form submission
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Hash the password
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Insert user data into the database
    $query = "INSERT INTO users (username, password, name) VALUES ('$username', '$password', '$name')";
    mysqli_query($conn, $query);

    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!-- HTML form for user registration -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <button type="submit">Register</button>
    </form>
</body>
</html>
