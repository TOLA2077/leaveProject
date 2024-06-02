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

<?php include ('include/index_admin3.php');?>
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
    
                            <div class="card-header">ព៍ត័មានលម្អិតរបស់អ្នក</div>
                                <div class="card-body">
                                <form id="profileForm" action="process_edit_profile.php" method="POST" onsubmit="displaySuccessAlert()">
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputUsername">ឈ្មោះអ្នកប្រើប្រាស់</label>
                                            <input class="form-control" name="inputUsername" id="inputUsername" type="text" placeholder="Enter your username" value="<?php echo $userData['username']; ?>">
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">គោត្តនាម</label>
                                                <input class="form-control" name="inputFirstName" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $userData['first_name']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">នាម</label>
                                                <input class="form-control" name="inputLastName" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userData['last_name']; ?>">
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputDepartment">ដេប៉ាតឹម៉ង</label>
                                                <input class="form-control" name="inputDepartment" id="inputDepartment" type="text" placeholder="Enter your department" value="<?php echo $userData['department']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputSkills">ដំណេង</label>
                                                <input class="form-control" name="inputSkills" id="inputSkills" type="text" placeholder="Enter your skills" value="<?php echo $userData['skills']; ?>">
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputEmail">អ៊ីម៊ែល</label>
                                                <input class="form-control" name="inputEmail" id="inputEmail" type="email" placeholder="Enter your email" value="<?php echo $userData['gmail']; ?>">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPhoneNumber">លេខទូរស័ព្ទ</label>
                                                <input class="form-control" name="inputPhoneNumber" id="inputPhoneNumber" type="tel" placeholder="Enter your phone number" value="<?php echo $userData['phone_number']; ?>">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">រក្សាទុក</button>
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
