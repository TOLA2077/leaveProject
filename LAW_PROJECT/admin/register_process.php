<?php
// Include database connection
include '../conn_db.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and sanitize
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);

    // Insert user data into the database
    $sql = "INSERT INTO user_info (first_name, last_name, department, skills, username, password, gmail, phone_number)
            VALUES ('$first_name', '$last_name', '$department', '$skills', '$username', '$password', '$gmail', '$phone_number')";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('User registered successfully');</script>";
        echo "<script>window.location.href = 'add_user.php';</script>";
        exit();
    } else {
        // Print SQL query for debugging purposes
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
