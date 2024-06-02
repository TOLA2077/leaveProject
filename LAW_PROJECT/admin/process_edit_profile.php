<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Include database connection
include '../conn_db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['inputUsername'];
    $firstName = $_POST['inputFirstName'];
    $lastName = $_POST['inputLastName'];
    $department = $_POST['inputDepartment'];
    $skills = $_POST['inputSkills'];
    $email = $_POST['inputEmail'];
    $phoneNumber = $_POST['inputPhoneNumber'];

    // Update user data in the database
    $query = "UPDATE user_info SET username=?, first_name=?, last_name=?, department=?, skills=?, gmail=?, phone_number=? WHERE user_id=?";
    $stmt = $conn->prepare($query);

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die('Error: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssi", $username, $firstName, $lastName, $department, $skills, $email, $phoneNumber, $_SESSION['user_id']);

    // Execute the update query
    if ($stmt->execute()) {
        // Set alert message for success
        $alertType = 'success';
        $alertMessage = 'Profile updated successfully.';
        // Redirect to the profile page after successful update
        header("Location: view_profile.php");
        exit();
    } else {
        die('Error: ' . $stmt->error);
    }

}

// Close the database connection
$conn->close();
?>
