<?php
// Include necessary files, database connection, and session start
include('../conn_db.php');
include('include/index_staff.php');

// Check if user_id is set in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $currentMonth = date("m"); // Current month
    $currentYear = date("Y"); // Current year

    // Fetch total cases and total days for the current month
    $queryTotal = "SELECT COUNT(*) AS monthly_cases, SUM(num_days) AS total_month FROM form_project WHERE user_id = ? AND MONTH(fromDate) = ? AND YEAR(fromDate) = ?";
    $stmtTotal = $conn->prepare($queryTotal);
    $stmtTotal->bind_param("sii", $user_id, $currentMonth, $currentYear);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $rowTotal = $resultTotal->fetch_assoc();
    $stmtTotal->close();

    // Fetch user details
    $queryUserData = "SELECT * FROM user_info WHERE user_id = ?";
    $stmtUserData = $conn->prepare($queryUserData);
    $stmtUserData->bind_param("i", $user_id);
    $stmtUserData->execute();
    $resultUserData = $stmtUserData->get_result();
    $userData = $resultUserData->fetch_assoc();
    $stmtUserData->close();

    // Fetch all cases for the user for the current month
    $queryCases = "SELECT * FROM form_project WHERE user_id = ? AND MONTH(fromDate) = ? AND YEAR(fromDate) = ?";
    $stmtCases = $conn->prepare($queryCases);
    $stmtCases->bind_param("sii", $user_id, $currentMonth, $currentYear);
    $stmtCases->execute();
    $resultCases = $stmtCases->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Law List</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Inline CSS for quick styling */
        .container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 800px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Add more styles as needed */
    </style>
</head>
<body> <div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                    <h1 style="color:#F4F6F6";">KSIT</h1>
                </div><br>
                <!-- <div class="sidebar-am"> --> 
                <ul class="menu-list">
                    <li><a href="index.php" class="menu"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
                    <li><a href="view_list_law.php" class="menu"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
                    <li ><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    <li><a href="view_list_teacher.php" class="menu"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
                </ul>

                                <!-- Dropdown container -->
            <div class="dropdown">
                <!-- Dropdown button with icon -->
                <button class="dropdown-btn">
                    <span class="icon">&#128100;</span> Profile
                </button>

                <!-- Dropdown content with icons -->
                <div class="dropdown-content">
                    <!-- Option 1: View Profile with user icon -->
                    <a href="view_profile.php"><span class="icon">&#128100;</span> View Profile</a>
                    <!-- Option 2: Logout with sign-out icon -->
                    <a href="?logout=true" class="logout-link">Logout</a>
                </div>
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
        <h4>បញ្ជីឈ្មោះសុំច្បាប់សរុប</h4>
        <!-- <p>User: <?php echo $userData['first_name'] . ' ' . $userData['last_name']; ?></p>
        <p>Total Cases: <?php echo $rowTotal['total_cases']; ?></p>
        <p>Total Days: <?php echo $rowTotal['total_days']; ?></p> -->
        <div class="container-a">
        <div class="search2">
        <button><a href="export_data_user.php?user_id=<?php echo $user_id; ?>">export_to_excel</a></button>

</form>

    </div>
        <table class="table table-bordered" id="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ឈ្មោះ</th>
                    <th>ចំនួនថ្ងៃ</th>
                    <th>ចាប់ពីថ្ងៃ</th>
                    <th>ដល់ថ្ងៃ</th>
                    <th>មូលហេតុ</th>
                    <th>សកម្មភាព  </th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            if ($resultCases->num_rows > 0) {
                while ($row = $resultCases->fetch_assoc()) {
                    if($row['status'] == "អនុញ្ញាត"){
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['first_name'] . " " . $row['last_name']) . "</td>";
    
                        echo "<td>" . htmlspecialchars($row['num_days']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fromDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['toDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['becuse']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        // Add more columns as needed
                        echo "</tr>";
                    }
                   
                }
            } else {
                echo "<tr><td colspan='4'>No records found for the current user.</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <!-- Add any additional content or elements here -->
    </div>
</body>
</html>

<?php
} else {
    echo "User ID not provided.";
}

// Close the database connection
$conn->close();
?>


