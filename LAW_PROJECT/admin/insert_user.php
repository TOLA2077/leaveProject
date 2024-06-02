<?php
// Include database connection
include '../conn_db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $skills = $_POST['skills'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $phone_number = $_POST['phone_number'];
    $gmail = $_POST['gmail'];
    $active = $_POST['active']; // Assuming you have a form field for the active status

// Prepare the SQL query

    // Directory to store uploaded images
    $uploadDir = '../uploads/';
    
    // Create the directory if it doesn't exist
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Array to store uploaded file paths
    $uploadedFiles = [];

    // Define allowed image types
    $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];

    // Loop through each uploaded file
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        // Check for upload errors
        if ($_FILES['images']['error'][$key] !== UPLOAD_ERR_OK) {
            echo "Error uploading file: " . $_FILES['images']['error'][$key];
            continue; // Skip to the next iteration if there's an error
        }

        // Process the file
        $file_name = $_FILES['images']['name'][$key];
        $file_tmp = $_FILES['images']['tmp_name'][$key];
        $uploadPath = $uploadDir . $file_name;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($file_tmp, $uploadPath)) {
            $uploadedFiles[] = $uploadPath;

            // Check the image type after successful upload
            $imageType = exif_imagetype($uploadPath);
            
            // Check if the image type is allowed
            if (!in_array($imageType, $allowedTypes)) {
                // Remove the invalid file if it doesn't match the allowed image types
                unlink($uploadPath);
                echo "Invalid image type for file: " . $_FILES['images']['name'][$key];
                continue; // Skip to the next iteration
            }
        } else {
            echo "Error uploading file: " . $_FILES['images']['error'][$key];
        }
    }

    // Combine uploaded file paths into a comma-separated string
    $imagePaths = implode(',', $uploadedFiles);

    // Insert data into the database
    $query = "INSERT INTO user_info (first_name, last_name, role, department, skills, username, password, phone_number, gmail, images, active ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssssssssss",
        $first_name,
        $last_name,
        $role,
        $department,
        $skills,
        $username,
        $password,
        $active,
        $phone_number,
        $gmail,
        $imagePaths
    );

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: view_user.php');
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
