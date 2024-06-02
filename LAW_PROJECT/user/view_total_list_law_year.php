<?php
include('../conn_db.php');

session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: ../index.php");
    exit();
}

// Retrieve the current user's user ID from the session
$current_user_id = $_SESSION['user_id'];

// Query to get the total number of cases
$queryTotal = "SELECT COUNT(*) AS total_cases FROM form_project WHERE user_id = $current_user_id";

// Query to get the yearly number of cases
$queryYearly = "SELECT COUNT(*) AS yearly_cases FROM form_project WHERE user_id = $current_user_id AND YEAR(fromDate) = YEAR(NOW())";

// Query to get the monthly number of cases
$queryMonthly = "SELECT COUNT(*) AS monthly_cases FROM form_project WHERE user_id = $current_user_id AND MONTH(fromDate) = MONTH(NOW())";

// Execute the queries
$resultTotal = $conn->query($queryTotal);
$resultYearly = $conn->query($queryYearly);
$resultMonthly = $conn->query($queryMonthly);

// Check for errors in the queries
if (!$resultTotal || !$resultYearly || !$resultMonthly) {
    die("Query failed: " . $conn->error);
}

// Fetch the results
$rowTotal = $resultTotal->fetch_assoc();
$rowYearly = $resultYearly->fetch_assoc();
$rowMonthly = $resultMonthly->fetch_assoc();
?>




<!doctype html>
    <html lang="en">
        <head>
            <title>SEND LAW </title>
            <!-- Required meta tags -->
            <meta charset="utf-8" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1, shrink-to-fit=no"
            />
            
            <link rel="icon" href="img/Copy-of-Stamp-KSIT.png"/>
            <!-- Bootstrap CSS v5.2.1 -->
            <link
                href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
                rel="stylesheet"
                integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
                crossorigin="anonymous"
            />
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
                        <!-- <div class="sidebar-am"> -->
                        <ul class="menu-list">
                            <li><a href="index.php" class="menu"><i class="bi bi-house-door"></i> ទំព័រដើម</a></li>
                            <li><a href="send_law.php" class="menu"><i class="bi bi-file-earmark-text"></i> ពាក្យសុំច្បាប់</a></li>
                            <li><a href="view_list_law.php" class="menu"><i class="bi bi-file-earmark-text"></i> បញ្ជីច្បាប់</a></li>
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
                    <a href="#"><span class="icon">&#128100;</span> View Profile</a>
                    <!-- Option 2: Logout with sign-out icon -->
                    <a href="../index.php"><span class="icon">&#128076;</span> Logout</a>
                </div>
            </div>
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
                                <p style="color: #0970d1;">ផ្ទាំងបង្ហាញព៍ត័មាននៅក្នុងឆ្នាំនេះ</p>
                                                </header>
                                            <div class="container-a">
                                                <table class="table table-success table-striped" id="data-table">
                                                    <thead>
                                                        <tr>
                                                            <th>ល.រ</th>
                                                            <th>ឈ្មោះ</th>
                                                            <th>ចំនួនថ្ងៃ</th>
                                                            <th>ចាប់ពី ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                                                            <th>ដល់ ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                                                            <th>មូលហេតុ</th>
                                                            <th>ស្ថានភាព</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php

$current_user_id = $_SESSION['user_id'];

// Get the current year
$current_year = date('Y');

// Retrieve user's requests and their status from the database for the current user for this year
$sql = "SELECT id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date FROM form_project WHERE user_id = ? AND YEAR(fromDate) = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ss", $current_user_id, $current_year);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// Display the table
if ($result->num_rows > 0) {
    $i = 1;

    while ($row = $result->fetch_assoc()) {
        // Check if the status is 'អនុញ្ញាត'
        if ($row['status'] == 'អនុញ្ញាត') {
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";

            // Combine first and last name
            echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";

            echo "<td>" . htmlspecialchars($row['num_days']) . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['fromDate'])) . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['toDate'])) . "</td>";
            echo "<td>" . htmlspecialchars($row['becuse']) . "</td>";
            echo "<td>";

            // Output status with appropriate styling
            echo "<span class='" . getStatusClass($row['status']) . "'>" . htmlspecialchars($row['status']) . "</span>";

            echo "</td>";

            // View, Edit, and Delete actions
            echo "<td>";

            if ($row["status"] == 'រង់ចាំការអនុញ្ញាត') {
                echo "<a href='cancel.php?id=" . $row['id'] . "' onclick='return confirm(\"តើអ្នកពីតជាចង់បោះបង់ការអនុញ្ញាតនេះមែនទេ?\");' style='color: red;'>Cancel</a>";
            } else {
                echo "ការស្នើសុំបានទទួលជោគជ័យ";  
            }

            echo "</td>";
            echo "</tr>";
        }
    }
} else {
    echo "No records found for the current user this year.";
}

// Function to determine status class based on the status value
function getStatusClass($status) {
    switch ($status) {
        case 'រង់ចាំការអនុញ្ញាត':
            return 'status-red';
        case 'អនុញ្ញាត':
            return 'status-green';
        case 'មិនអនុញ្ញាត':
            return 'status-black';
        case 'បោះបង់ការស្នើសុំ':
            return 'status-gray';
        default:
            return 'status-black';
    }
}
?>

                                    </thead>
                                    <tbody>
                    
                                    </tbody>
                                </table>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- New box element -->


            <!-- Bootstrap JavaScript Libraries -->
            <script
                src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
                integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
                crossorigin="anonymous"
            ></script>

            <script
                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
                integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
                crossorigin="anonymous"
            ></script>
            <!-- Include Bootstrap JS and Popper.js -->
            <script src="path/to/popper.min.js"></script>
            <script src="path/to/bootstrap.min.js"></script>
            <!-- Include Bootstrap JS and Popper.js from CDN -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
    </html>
