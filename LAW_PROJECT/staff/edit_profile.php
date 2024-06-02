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
    die('Error: ' . $conn->error);
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



<?php include ('include/index_staff_profile.php');?>
<div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                    <h1 style="color:#F4F6F6";">KSIT</h1>
                </div><br>
                <!-- <div class="sidebar-am"> --> 
                <ul class="menu-list">
                    <li><a href="index.php" class="menu"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
                    <li class="active"><a href="view_list_law.php" class="active"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
                    <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    <li><a href="view_list_teacher.php" class="menu"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
                </ul>

                <div class="profile-details">
                <a class="btn btn-danger btn-logout" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
</div>

            </div>
            <!-- And Sidebar -->
            <!-- Nav bar -->
            <div class="navbar-header1" >
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
                                        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover;">';
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
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form id="profileForm" action="process_edit_profile.php" method="POST">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputUsername">Username</label>
                                            <input class="form-control" name="inputUsername" id="inputUsername" type="text" placeholder="Enter your username" value="<?php echo $userData['username']; ?>">
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">First name</label>
                                                <input class="form-control" name="inputFirstName" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $userData['first_name']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Last name</label>
                                                <input class="form-control" name="inputLastName" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userData['last_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputDepartment">Department</label>
                                                <input class="form-control" name="inputDepartment" id="inputDepartment" type="text" placeholder="Enter your department" value="<?php echo $userData['department']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputSkills">Skills</label>
                                                <input class="form-control" name="inputSkills" id="inputSkills" type="text" placeholder="Enter your skills" value="<?php echo $userData['skills']; ?>">
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputEmail">Email</label>
                                                <input class="form-control" name="inputEmail" id="inputEmail" type="email" placeholder="Enter your email" value="<?php echo $userData['gmail']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPhoneNumber">Phone Number</label>
                                                <input class="form-control" name="inputPhoneNumber" id="inputPhoneNumber" type="tel" placeholder="Enter your phone number" value="<?php echo $userData['phone_number']; ?>">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">save Profile</button>
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
                }
            </script>
            <!-- Bootstrap JavaScript Libraries -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
