<!-- Header for home page -->
<?php include("include/index_staff.php"); ?>

<?php
// Database connection parameters
include('../conn_db.php');


// Constants
$recordsPerPage = 10; // Adjust this based on your preference
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Processing form submission (if form submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the button is clicked and update the status accordingly
    if (isset($_POST['status']) && isset($_POST['staff_id'])) {
        $staff_id = $_POST['staff_id'];
        $newStatus = ($_POST['status'] == 'អនុញ្ញាត') ? 'អនុញ្ញាត' : 'មិនអនុញ្ញាត';

        // Update the status in the database or your data source
        // Assuming you have a function like updateStatus($staffId, $newStatus)
        // You need to implement this function according to your database structure
        $sql = "UPDATE form_project SET status = '$newStatus' WHERE id = '$staff_id'";
        if (!$conn->query($sql) === TRUE) {
            die('Failed to update status.');
        }
    }
}

// Calculate total number of records
$totalRecordsQuery = "SELECT COUNT(id) as total FROM form_project";
$totalRecordsResult = $conn->query($totalRecordsQuery);
$totalRecords = $totalRecordsResult->fetch_assoc()['total'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Check if $totalPages is properly calculated
if (!isset($totalPages)) {
    // Handle the case where $totalPages is not set properly
    die('Failed to calculate total pages.');
}

// Calculate the offset for the current page
$offset = ($current_page - 1) * $recordsPerPage;

// Modify your SQL query to include LIMIT
$sql = "SELECT id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date FROM form_project LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);

// Retrieve user data from the database
$user_id = $_SESSION['user_id'];
$queryUserData = "SELECT * FROM user_info WHERE user_id = ?";
$stmt = $conn->prepare($queryUserData);

if (!$stmt) {
    die('Error: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();

if (!$stmt) {
    die('Error: ' . $stmt->error);
}

$resultUserData = $stmt->get_result();
$userData = $resultUserData->fetch_assoc();
$stmt->close();

// Close the database connection
$conn->close();

?>

<!-- Your HTML and table display code goes here -->


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
<style>
         
         .table {  
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px; /* Adjust the top margin as needed */
    
}

.table th,
.table td {
    border: 1px solid #bfc1c2;
    background: #e1ecf3;
    text-align: left;
    padding: 8px;
    font-family: Khmer OS Siemreap;
    text-align: center;
    color: #1A5276;
    
}

.table th {
    background-color: #5f9cd9  ; /* Set the background color for table header cells */
    color: #ffffff; /* Set the text color for table header cells */
    

}
.contenta {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        

    .save-button {
        background-color: #4CAF50; /* Green background */
        border: none; /* Remove borders */
        color: white; /* White text */
        padding: 2px 4px; /* Some padding */
        text-align: center; /* Center text */
        text-decoration: none; /* No text decoration */
        display: inline-block; /* Make it an inline element */
        font-size: 16px; /* Increase font size */
        margin: 4px 2px; /* Add some margin */
        cursor: pointer; /* Add a pointer cursor on hover */
        border-radius: 4px; /* Rounded corners */
        font-size: 13px;
    }

    .save-button:hover {
        background-color: #45a049; /* Darker green on hover */
    }

        </style>
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
            <p style="font-family: Khmer OS Siemreap;">ផ្ទាំងបង្ហាញអំពីបញ្ជីការស្នើសុំច្បាប់</p>
        </div>
        <div class="container-a">
            <table class="table table-bordered" id="my-data-table" >
                <thead>
                    <tr>
                        <th>ល.រ</th>
                        <th>ឈ្មោះ</th>
                        <th>ចាប់ពី ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                        <th>ដល់ ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                        <th>ចំនួនថ្ងៃ</th>
                        <th>មូលហេតុ</th>
                        <th>សកម្មភាព</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
$i = 1;
// Display the table
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['status'] != 'រង់ចាំការអនុញ្ញាត' && $row['status'] != 'បោះបង់ការស្នើសុំ') {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row['first_name'] . $row['last_name'] . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['fromDate'])) . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['toDate'])) . "</td>";
            echo "<td>" . $row['num_days'] . "</td>";
            echo "<td>" . $row['becuse'] . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>";
            echo "<form action='update_status.php' method='post'>";
            echo "<input type='hidden' name='staff_id' value='" . $row['id'] . "'>";
            echo "<select name='status'>";
            echo "<option value='អនុញ្ញាត'>អនុញ្ញាត</option>";
            echo "<option value='មិនអនុញ្ញាត'>មិនអនុញ្ញាត</option>";
            echo "</select>";
            echo "<input type='submit' value='រក្សាទុក' class='save-button'>";

            echo "</form>";
            echo "</td>";
           
            echo "</tr>";
        }
    }
} else {
    echo "No records found for the current user.";
}
?>
</tbody>

            </table>
        
<div class="container">
    <ul class="pagination">
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#my-data-table').DataTable();
    });
</script>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
