<?php
// Include database connection
include '../conn_db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $skills = mysqli_real_escape_string($conn, $_POST['skills']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
    $active = isset($_POST['active']) ? $_POST['active'] : 1;


    // Directory to store uploaded images
    $uploadDir = '../uploads/';

    // Array to store uploaded file paths
    $uploadedFiles = [];

    // Define allowed image types
    $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];

    // Loop through each uploaded file
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        // Process the file
        $file_name = $_FILES['images']['name'][$key];
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        $uploadPath = $uploadDir . $file_name;

        // Check for upload errors and validate file type
        if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK && in_array(exif_imagetype($file_tmp), $allowedTypes)) {
            // Move the uploaded file to the destination directory
            if (move_uploaded_file($file_tmp, $uploadPath)) {
                $uploadedFiles[] = $uploadPath;
            } else {
                echo "Error uploading file: $file_name";
            }
        } else {
            echo "Invalid file: $file_name";
        }
    }

    // Combine uploaded file paths into a comma-separated string
    $imagePaths = implode(',', $uploadedFiles);

    // Insert data into the database using prepared statements
    $query = "INSERT INTO user_info (first_name, last_name, role, department, skills, username, password, phone_number, gmail, images, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sssssssssss",
        $first_name,
        $last_name,
        $role,
        $department,
        $skills,
        $username,
        $password,
        $phone_number,
        $gmail,
        $imagePaths,
        $active
    );

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: view_staff.php');
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
