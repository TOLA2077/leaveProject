<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: ../index.php');
    exit();
}

// Check if the logout button is clicked
if (isset($_GET['logout'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page after logout
    header('Location: ../index.php');
    exit();
}

// Include necessary files and establish a database connection
include("include/index_admin1.php");
include('../conn_db.php');

// Placeholder database queries
$sqlTotal = "SELECT COUNT(*) AS total_cases, SUM(num_days) AS total_days FROM form_project";
$sqlYearly = "SELECT COUNT(*) AS yearly_cases, SUM(num_days) AS total_days FROM form_project WHERE YEAR(fromDate) = YEAR(NOW())";
$sqlMonthly = "SELECT COUNT(*) AS monthly_cases, SUM(num_days) AS total_days FROM form_project WHERE YEAR(toDate) = YEAR(NOW()) AND MONTH(status_date) = MONTH(NOW())";

// Execute SQL queries
$resultTotal = $conn->query($sqlTotal);
$resultYearly = $conn->query($sqlYearly);
$resultMonthly = $conn->query($sqlMonthly);

// Check for errors
if (!$resultTotal || !$resultYearly || !$resultMonthly) {
    die("Error executing SQL queries: " . $conn->error);
}

// Fetch data
$rowTotal = $resultTotal->fetch_assoc();
$rowYearly = $resultYearly->fetch_assoc();
$rowMonthly = $resultMonthly->fetch_assoc();

// Close connection
$conn->close();
?>

<!-- Rest of your HTML and PHP code -->
<div class="navbar-header1">
    <div class="containera">
        <div class="contenta">
            <div class="iteme">
                <a href="view_total_list_law.php">
                    <div class="item-content bg-red">
                        <p class="text_box">ចំនួនសុំច្បាប់សរុប: &nbsp; <?php echo $rowTotal['total_cases']; ?></p>
                        <p class="text_box">ចំនួនថ្ងៃសរុប: &nbsp; <?php echo $rowTotal['total_days']; ?></p>
                    </div>
                </a>
                <a href="view_total_law_in_year.php">
                    <div class="item-content bg-dak">
                        <p class="text_box">ចំនួនសុំច្បាប់ក្នុងឆ្នាំនេះ: &nbsp; <?php echo $rowYearly['yearly_cases']; ?></p>
                        <p class="text_box">ចំនួនថ្ងៃសរុប: &nbsp; <?php echo $rowYearly['total_days']; ?></p>
                        <!-- Display the total number of days for the current year here -->
                    </div>
                </a>
               
                <a href="view_total_law_in_month.php">
                    <div class="item-content bg-dak">
                        <p class="text_box">ចំនួនសុំច្បាប់ក្នុងខែនេះ:  &nbsp;<?php echo $rowMonthly['monthly_cases']; ?></p>
                        <p class="text_box">ចំនួនថ្ងៃសរុប: &nbsp; <?php echo $rowMonthly['total_days']; ?></p>
                        <!-- Display the total number of days for the current month here -->
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


</body>
</html>
