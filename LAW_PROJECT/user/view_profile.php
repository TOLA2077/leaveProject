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

// Retrieve user data from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user_info WHERE user_id = ?";
$stmt = $conn->prepare($query);

// Check if the statement was prepared successfully
if (!$stmt) {
    error_log('Prepare statement error: ' . $conn->error);
    die('An unexpected error occurred. Please try again later.');
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

// Check if the execution was successful
if (!$stmt) {
    die('Error: ' . $stmt->error);
}

$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();

// Close the database connection
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <title>SEND LAW</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    
    <link rel="icon" href="img/Copy-of-Stamp-KSIT.png"/>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- Include Bootstrap CSS and Bootstrap Icons CSS from CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style/main1.css">
</head>
<body>
    <header>
        <div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                    <h2 style="color: #FBFCFC;">KSIT</h2>
                </div><br>
                <ul class="menu-list">
                            <li class="active"><a href="index.php" class="active"><i class="fas fa-home"></i> ទំព័រដើម</a></li>
                            <li><a href="send_law.php" class="menu"><i class="fas fa-file-alt"></i> ស្នើសុំច្បាប់</a></li>
                            <li><a href="view_list_law.php" class="menu"><i class="fas fa-list"></i> បញ្ជីច្បាប់</a></li>

                            <a class="btn btn-danger btn-logout" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                        </ul>

                
            </div>
        </div>
        <div class="navbar-header1">
            <div class="text_navbar">
                <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
            </div>
            <div class="containera">
                <div class="contenta">
            </header>
            <div class="container-a">
                    <div class="container-xl px-4 mt-4">
                        <hr class="mt-0 ">
                        <div class="row">
                            <div class="col-xl-4">
                                <!-- Profile picture card-->
                                <div class="card mb-4 mb-xl-0"> 
                                    <div class="card-header">Profile Picture</div>
                                    <div class="card-body text-center">
                                    <?php
                                    // Assuming $userData['images'] contains the path or URL to the image
                                    $imagePath = $userData['images'];

                                    

                                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                                        // If it's a URL, directly display it
                                        echo '<img src="' . htmlspecialchars(__DIR__ . '/' . $imagePath) . '" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover;">';

                                    } elseif (file_exists($imagePath)) {
                                        // If it's a local file, display it
                                        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover;">';
                                    } else {
                                        // If the file doesn't exist or it's not a valid URL, display an error message
                                        echo "Image not found!";
                                    }
                                    ?>

                                </div>
  
                                </div>
                     
                            </div>
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">ព៍ត័មានលម្អិតរបស់អ្នក</div>
                                    <div class="card-body">
                                    <form id="profileForm">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUsername">ឈ្មោះអ្នកប្រើប្រាស់</label>
                                                <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="<?php echo $userData['username']; ?>">
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">គោត្តនាម</label>
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $userData['first_name']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLastName">នាម</label>
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userData['last_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputDepartment">ដេប៉ាតឺម៉ង</label>
                                                    <input class="form-control" id="inputDepartment" type="text" placeholder="Enter your department" value="<?php echo $userData['department']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputSkills">ដំណែង</label>
                                                    <input class="form-control" id="inputSkills" type="text" placeholder="Enter your skills" value="<?php echo $userData['skills']; ?>">
                                                </div>
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputEmail">អ៊ីម៉ែល</label>
                                                    <input class="form-control" id="inputEmail" type="email" placeholder="Enter your email" value="<?php echo $userData['gmail']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhoneNumber">លេខទូរស័ព្ទ</label>
                                                    <input class="form-control" id="inputPhoneNumber" type="tel" placeholder="Enter your phone number" value="<?php echo $userData['phone_number']; ?>">
                                                </div>
                                            </div>
                                            <a class="btn btn-primary" href="edit_profile.php">កែប្រែ</a>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function toggleEditMode() {
                        var formElements = document.querySelectorAll("form input, form select");
                        var editButton = document.querySelector(".btn-primary");

                        // Toggle disabled attribute for form elements
                        formElements.forEach(function (element) {
                            element.disabled = !element.disabled;
                        });

                        // Change button text based on edit mode
                        if (formElements[0].disabled) {
                            editButton.innerText = "Edit Profile";
                        } else {
                            editButton.innerText = "Save Changes";
                        }
                    }
                </script>
                <!-- Bootstrap JavaScript Libraries -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>
            </html>
