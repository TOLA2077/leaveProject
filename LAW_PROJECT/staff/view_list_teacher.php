<?php
// Include necessary files, database connection, and session start
include("include/index_staff.php");
include('../conn_db.php');

// Check if the session variable is set
if (isset($_SESSION['user_id'])) {
    // Retrieve user data from the database
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM user_info WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die('Error: ' . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    if (!$stmt) {
        die('Error: ' . $stmt->error);
    }

    $result = $stmt->get_result();
    $userData = $result->fetch_assoc();
    $stmt->close();
} else {
    // Handle the case where the session variable is not set
    // Redirect the user to the login page or perform other actions
}

// Pagination variables
$recordsPerPage = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $recordsPerPage;

// Now perform your query with pagination
$sql = "SELECT user_id, first_name, last_name, role, department, username, gmail, phone_number FROM user_info LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);

// Calculate total number of records
$totalRecordsQuery = "SELECT COUNT(*) AS total FROM user_info";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head section content here -->
</head>

<body>
 
    <div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                    <h1 style="color:#F4F6F6";">KSIT</h1>
                </div><br>
                <!-- <div class="sidebar-am"> --> 
                <ul class="menu-list">
                    <li class=""><a href="index.php" class="menu"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
                    <li><a href="view_list_law.php" class="menu"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
                    <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    <li class="active"><a href="view_list_teacher.php" class="active"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
                </ul>

                <div class="profile-details">
            <a href="view_profile.php?user_id=<?php echo $userData['user_id']; ?>" class="profile-link" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <div class="profile-content">
                    <?php
                    // Assuming $userData['images'] contains the path or URL to the image
                    $imagePath = $userData['images'];

                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                        // If it's a URL, directly display it
                        echo '<img src="' . htmlspecialchars(__DIR__ . '/' . $imagePath) . '" alt="Profile Picture" style="width: 50px; height: 50px; align-items: center; object-fit: cover; border-radius: 50%;">';
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
            <div class="navbar-header1" >
                <div class="text_navbar">
                    <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
            </div>

    <div class="containera">
        <div class="contenta">
            <div style="color: #3498DB ;">
                <p  style="font-family: Khmer OS Siemreap;">បញ្ជីឈ្មោះគ្រូបង្រៀន</p>
            </div>
        </div>
        <div class="container-a">
        <table class="table table-bordered" id="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>first_name</th>
                    <th>last_name</th>
                    <th>role</th>
                    <th>department</th>
              
                    <th>gamil</th>
                    <th>phone_number</th>
                    <th>ព៍ត័មានលម្អិត</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        if ($row['role'] == 'user') {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                         
                            echo "<td>" . $row['gmail'] . "</td>";
                            echo "<td>" . $row['phone_number'] . "</td>";
                            echo "<td><a href='view_detail_teacher.php?user_id=" . urlencode($row['user_id']) . "' class='view-details'>View Details</a></td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='10'>0 results</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="container"  style="justify-content: center; display:flex;">
                <ul class="pagination" style="text-align: center;">
                    <?php
                    // Previous page link
                    if ($current_page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
                    }

                    // Page links
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }

                    // Next page link
                    if ($current_page < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
                    }
                    ?>
                </ul>
            </div>

    </div>
    </div>

    


    <!-- Your existing script for AJAX request -->

    <script>
        $(document).ready(function() {
            $('.view-details').on('click', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');

                $.ajax({
                    type: 'GET',
                    url: 'view_detail_teacher.php',
                    data: { user_id: userId },
                    success: function(response) {
                        alert(response);
                    },
                    error: function(error) {
                        console.error('Error fetching details:', error);
                    }
                });
            });
        });
   
    </script>
  
    </body>

</html>
