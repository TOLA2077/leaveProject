<?php
include ('../conn_db.php');

// Get input data from the registration form
$username = $_POST['username'];
$password = $_POST['password'];

// Hash the password for security (use password_hash() function)
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO user_login (username, password) VALUES ('$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "User registered successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
