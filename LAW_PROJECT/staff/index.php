<?php
// Database connection parameters
include('../conn_db.php');



// Processing form submission (if form submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the button is clicked and update the status accordingly
    if (isset($_POST['status']) && isset($_POST['staff_id'])) {
        $staff_id = $_POST['staff_id'];
        $newStatus = ($_POST['status'] == 'អនុញ្ញាត') ? 'អនុញ្ញាត' : 'មិនអនុញ្ញាត';

        // Update the status in the database or your data source
        $sql = "UPDATE form_project SET status = '$newStatus' WHERE id = '$staff_id'";
        if (!$conn->query($sql) === TRUE) {
            die('Failed to update status.');
        }
    }
}

?>

<!-- Header for home page -->
<?php include("include/index_staff.php"); ?>
<div class="container1">
    <div class="sidebar">
        <div class="logo">
            <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
            <h1 style="color:#F4F6F6">KSIT</h1>
        </div><br>
        <ul class="menu-list">
            <li class="active"><a href="index.php" class="active"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
            <li><a href="view_list_law.php" class="menu"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
            <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
            <li><a href="view_list_teacher.php" class="menu"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
        </ul>

        <div class="profile-details">
            <a href="view_profile.php?user_id=<?php echo $userData['user_id']; ?>" class="profile-link" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <div class="profile-content">
                    <?php
                    // Include database connection
                    include '../conn_db.php';
                    // Retrieve user data from the database
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT * FROM user_info WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $userData = $result->fetch_assoc();
                    // Assuming $userData['images'] contains the path or URL to the image
                    $imagePath = $userData['images'];
                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                        // If it's a URL, directly display it
                        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Profile Picture" style="width: 50px; height: 50px; align-items: center; object-fit: cover; border-radius: 50%;">';
                    } elseif (file_exists($imagePath)) {
                        // If it's a local file, display it
                        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Profile Picture" style="width: 50px; height: 50px; align-items: center; object-fit: cover; border-radius: 50%;">';
                    } else {
                        // If the file doesn't exist or it's not a valid URL, display an error message
                        echo "Image not found!";
                    }
                    ?>
                </div>
                <div class="name">
                    <div class="profile_name" style="color:#FBFCFC; font-weight: bold; font-size: 14px;">
                        <?php
                        // Assuming $userData['first_name'] and $userData['last_name'] contain the first and last names
                        echo htmlspecialchars($userData['first_name'] . ' ' . $userData['last_name']);
                        ?>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- And Sidebar -->
    <!-- Nav bar -->
    <div class="navbar-header1">
        <div class="text_navbar">
            <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
        </div>
        <div class="containera">
            <div class="contenta">
                <div style="color: #3498DB;">
                    <p style="font-family: Khmer OS Siemreap;">ផ្ទាំងជូនដំណឹងអំពីរការសុំច្បាប់របស់បុគ្គលិក</p>
                </div>
                <br>
                <div class="container-a">
                    <table class="table table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th>ល.រ</th>
                                <th>ឈ្មោះ</th>
                                <th>ចំនួនថ្ងៃ </th>
                                <th>ចាប់ពីថ្ងៃទី​ ខែ​ ឆ្នាំ</th>
                                <th>ដល់ថ្ងៃទី​ ខែ​ ឆ្នាំ</th>
                                <th>មូលហេតុ</th>
                                <th>អំពីរការអនុញ្ញាត</th>
                                <th>ពេលស្នើសុំច្បាប់</th>
                                <th>ស្ថានភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $foundStaff = false;
                            // Retrieve staff information from the database
                            $sql = "SELECT id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date FROM form_project";
                            $result = $conn->query($sql);
                            // Check if the SQL query execution was successful
                            if ($result !== false) {
                                // Check if there are rows in the result set
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        // Only display rows where the status is 'រង់ចាំការអនុញ្ញាត'
                                        if ($row['status'] == 'រង់ចាំការអនុញ្ញាត') {
                                            echo "<tr>";
                                            echo "<td>" . $i . "</td>";
                                            // Combine first and last name
                                            echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['num_days']) . "</td>";
                                            echo "<td>" . date('d/m/Y', strtotime($row['fromDate'])) . "</td>";
                                            echo "<td>" . date('d/m/Y', strtotime($row['toDate'])) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['becuse']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                            echo "<td>" . date('H:i:s d/m/y ', strtotime($row['status_date'])) . "</td>";
                                            echo "<td>";
                                            echo "<form method='post'>";
                                            echo "<input type='hidden' name='staff_id' value='" . $row['id'] . "'>";
                                            if ($row['status'] == 'អនុញ្ញាត') {
                                                echo "<button class='btn btn-primary' style='margin-right: 5px;' disabled>បានអនុញ្ញាត</button>";
                                            } elseif ($row['status'] == 'មិនអនុញ្ញាត') {
                                                echo "<button class='btn btn-danger' style='margin-right: 5px;' disabled>មិនអនុញ្ញាត</button>";
                                            } else {
                                                echo "<button class='btn btn-primary' style='margin-right: 5px;' type='submit' name='status' value='អនុញ្ញាត'>អនុញ្ញាត</button>";
                                                echo "<button class='btn btn-danger' style='margin-right: 5px;' type='submit' name='status' value='អនុញ្ញាត'>
                                                    <a href='com_to_user.php?id=" . $row['id'] . "' style='color: white;'>មិនអនុញ្ញាត</a>
                                                </button>";
                                            }
                                            echo "</form>";
                                            echo "</td>";
                                            echo "</tr>";
                                            $i++; // Increment the variable
                                            $foundStaff = true;
                                        }
                                    }
                                    // Check if no staff were found
                                    if (!$foundStaff) {
                                        echo "<tr><td colspan='9'>មិនមានទិន្នន័យអំពីការសុំច្បាប់​ </td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='9'>មិនមានទិន្នន័យអំពីការសុំច្បាប់​ </td></tr>";
                                }
                            } else {
                                // Output or log the error message securely
                                echo "Error executing SQL query: " . htmlspecialchars($conn->error);
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
