<?php
include('../conn_db.php');

// Assuming you have retrieved details from the database and stored them in $row
$user_id = $_GET['id']; // Assuming you are passing the ID through the URL

// Fetch details from the database using $id
$sql = "SELECT * FROM user_info WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();  // Fetch user details
} else {
    // Handle case where user doesn't exist
    echo "User not found.";
    exit;
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $skills = $_POST['skills'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gmail = $_POST['gmail'];

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
 

    // Update the user data in the database
    $update_sql = "UPDATE user_info SET first_name=?, last_name=?, role=?, department=?, skills=?, phone_number=?, username=?, password=?, gmail=?, images=? WHERE user_id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssssssi", $first_name, $last_name, $role, $department, $skills, $phone_number, $username, $password, $gmail, $imagePaths, $user_id);
    
    if ($stmt->execute()) {
        
    } else {
        echo "Error updating user data: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!-- And Sidebar -->
<?php include('include/index_admin.php'); ?>
<!-- Nav bar -->
<div style="color: #3498DB ;">
    <p>កែប្រែអ្នកប្រើប្រាស់</p>
</div>
<div class="container-a">
    <div class="input-box">
        <form action="" method="post" enctype="multipart/form-data"> <!-- Added enctype="multipart/form-data" for file uploads -->
            <!-- Populate form fields with existing user data -->
            <div class="input_field">
                <label for="firstName">នាម:</label>
                <input type="text" id="firstName" name="first_name" value="<?php echo $row['first_name']; ?>" required>

                <label for="lastName">គោត្តនាម:</label>
                <input type="text" id="lastName" name="last_name" value="<?php echo $row['last_name']; ?>" required>
            </div>

            <div class="input_field">
                <label for="role">តំណែង:</label>
                <select id="role" name="role" required>
                    <option value="admin" <?php if ($row['role'] == 'admin') echo 'selected'; ?>>មន្រ្តីរដ្ឋាបាល</option>
                    <option value="staff" <?php if ($row['role'] == 'staff') echo 'selected'; ?>>នាយក/នាយករង</option>
                </select>

                <label for="department">ដេប៉ាតឺម៉ង់/បុគ្គលិកការរិយាល័យ:</label>
                <select id="department" name="department" required>
                    <option value="នាយក">នាយក</option>
                    <option value="នាយករង">នាយករង</option>
                    <option value="បុគ្គលិកការរិយាល័យរដ្ឋបាល">បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
                </select>
            </div>

            <div class="input_field">
                <label for="">តួនាទី:</label>
                <select id="skills" name="skills" required>
                    <option>គ្រូបង្រៀន</option>
                    <option>ប្រធានដេប៉ាតឹម៉ង់</option>
                    <option value="computer">បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
                </select>

                <label for="phoneNumber">លេខទូរស័ព្ទ:</label>
                <input type="tel" id="phoneNumber" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>
            </div>

            <div class="input_field">
                <label for="username">ឈ្មោះអ្នកប្រើប្រាស់:</label>
                <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>

                <label for="password">ពាក្យសម្ងាត់:</label>
                <input type="password" id="password" name="password" value="<?php echo $row['password']; ?>" required>
            </div>

            <div class="input_field">
                <label for="gmail">អ៊ីម៉ែល:</label>
                <input type="email" id="gmail" name="gmail" value="<?php echo $row['gmail']; ?>" required>

                <label for="password">បញ្ចូលរូបភាពរបស់អ្នក:</label>
                <input type="file" name="images[]" accept="image/*" multiple>
            </div>

            <button type="submit" class="btn" style="float: right;">កែប្រែអ្នកប្រើប្រាស់</button>
        </form>
    </div>
</div>
</body>
</html>
