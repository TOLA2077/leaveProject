<?php
// Start the session
session_start();

// Include sidebar and navbar
include("include/sidebar_navbar_view.php");

// Database connection parameters
include('../conn_db.php');

// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
    exit();
}

// Constants
$recordsPerPage = 10; // Adjust this based on your preference
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$user_id = $_SESSION['user_id']; // Get the user ID from the session

// Calculate total number of records
$totalRecordsQuery = "SELECT COUNT(id) as total FROM form_project WHERE user_id = $user_id";
$totalRecordsResult = $conn->query($totalRecordsQuery);

if (!$totalRecordsResult) {
    die("Error executing total records query: " . $conn->error);
}

$totalRecordsRow = $totalRecordsResult->fetch_assoc();
$totalRecords = $totalRecordsRow['total'];

// Calculate total number of pages
$totalPages = ceil($totalRecords / $recordsPerPage);

// Calculate the offset for the current page
$offset = ($current_page - 1) * $recordsPerPage;

$start = $offset + 1;

// Modify your SQL query to include a condition for the user ID and limit records
$sql = "SELECT id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date, comment FROM form_project WHERE user_id = $user_id LIMIT $offset, $recordsPerPage";

// Execute the SQL query
$result = $conn->query($sql);

if (!$result) {
    die("Error executing SQL query: " . $conn->error);
}

?>

<!-- Your HTML and table display code goes here -->

<?php
if ($result->num_rows > 0) {
    // Display user data
} else {
    echo "No login records found for the current user.";
}
?>
<style>/* Style for the green status button */
.status-green {
    background-color: #58a5c7; /* Green */
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    border-radius: 25px;
    cursor: pointer;
}

/* Style for the red status button */
.status-red {
    background-color: #c72e7f; /* Red */
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    border-radius: 25px;
    cursor: pointer;
}

/* Style for the blue status button */
.status-blue {
    background-color: #2196F3; /* Blue */
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    border-radius: 25px;
    cursor: pointer;
}

/* Style for the black status button */
.status-black {
    background-color: #333; /* Black */
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 12px;
    border-radius: 25px;
    cursor: pointer;
}
</style>
<div class="containera">
    <div class="contenta">
        <div style="color: #3498DB ;">
            <p style="font-family: Khmer OS Siemreap;">ផ្ទាំងបង្ហាញអំពីបញ្ជីការស្នើសុំច្បាប់</p>
        </div>
        <div class="container-a">
            <table class="table table-bordered" id="my-data-table">
                <thead>
                    <tr>
                        <th>ល.រ</th>
                        <th>ឈ្មោះ</th>
                        <th>ចំនួនថ្ងៃ</th>
                        <th>ចាប់ពី ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                        <th>ដល់ ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                        <th>មូលហេតុ</th>
                        <th>ផ្ដល់មតិ</th>
                        <th>សកម្មភាព</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = $start;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                            echo "<td>" . $row['num_days'] . "</td>";
                            echo "<td>" . $row['fromDate'] . "</td>";
                            echo "<td>" . $row['toDate'] . "</td>";
                            echo "<td>" . $row['becuse'] . "</td>";
                            echo "<td>" . $row['comment'] . "</td>";
                            echo "<td>";

                            // Display status button with different styles based on status
                            switch ($row['status']) {
                                case 'អនុញ្ញាត':
                                    echo "<button class='status-green'>បានអនុញ្ញាត</button>";
                                    break;
                                case 'មិនអនុញ្ញាត':
                                    echo "<button class='status-red'>មិនអនុញ្ញាត</button>";
                                    break;
                                case 'រង់ចាំ':
                                    echo "<button class='status-blue'>រង់ចាំ</button>";
                                    break;
                                default:
                                    echo "<button class='status-black'>" . $row['status'] . "</button>";
                                    break;
                            }

                            echo "</td>";
                            // Adding a Cancel action button/link
                            echo "<td>";

                                                            
                          // Check the status of the row
if ($row["status"] == 'រង់ចាំការអនុញ្ញាត') {
    // If the status is 'រង់ចាំការអនុញ្ញាត', display a link to cancel the task
    echo "<a href='cancel.php?id=" . $row['id'] . "' onclick='return confirm(\"តើអ្នកពីតជាចង់បោះបង់ការស្នើសុំច្បាប់នេះមែនទេ?\");' style='color: red;'>Cancel</a>";
} elseif ($row["status"] == 'អនុញ្ញាត') {
    // If the status is 'អនុញ្ញាត', indicate that the task has been successfully completed
    echo "ការស្នើសុំបានទទួលជោគជ័យ";  
} elseif ($row["status"] == 'បោះបង់ការស្នើសុំ') {
    echo "បានបោះបង់";
   
} elseif ($row["status"] == 'មិនអនុញ្ញាត') {
    // If the status is 'មិនអនុញ្ញាត', indicate that the task is not approved or not available
    echo "មិនអនុញ្ញាត";  // Adjust this part based on your requirement
}
                          
                            

                            echo "</td>";
                            
                        }
                    } else {
                        echo "No login records found for the current user.";
                    }
                    ?>
                </tbody>
            </table>

            <div class="container" style="justify-content: center; display:flex;">
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvR
