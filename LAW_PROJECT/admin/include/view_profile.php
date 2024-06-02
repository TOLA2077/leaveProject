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

<?php
// Include database connection
include '../conn_db.php';

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

// Close the database connection
$conn->close();
?>
<!doctype html>
<html lang="en">
<head>
    <title>SEND LAW</title>
    <link rel="icon" href="img/Copy-of-Stamp-KSIT.png"/>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
     <!-- Include Bootstrap CSS and Bootstrap Icons CSS from CDN -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-g6Zs3eWMVm8x5Uu7Z3V58MxgFcPFKgcXr/gALi1LebIab3ZM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/main_index.css">
    <style>
        /* Your custom CSS for the logout button */
        .btn-logout {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            position: fixed;
            top: 85%;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
        <div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                  <h1 style="color:#F4F6F6";">KSIT</h1>
                </div><br>
                <!-- <div class="sidebar-am"> -->
                <ul>
                    <li><a href="index.php" class="menu"><i class="fas fa-home"></i> ទំព័រដើម</a></li>
                    <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    
                    <li class="active"><a href="add_staff.php" class="menu"><i class="fas fa-user-plus"></i> បន្ថែមអ្នកអនុញ្ញាត</a></li>
                    
                    <li><a href="add_user.php" class="menu"><i class="fas fa-user-graduate"></i> បន្ថែមគ្រូបង្រៀន</a></li>
                    
                    <li class="menu">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-users"></i> បញ្ជីអ្នកប្រើប្រាស់
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="view_staff.php"><i class="fas fa-list"></i> បញ្ជីអ្នកអនុញ្ញាត</a>
                            <a class="dropdown-item" href="view_user.php"><i class="fas fa-list"></i> បញ្ជីគ្រូបង្រៀន</a>
                            <!-- Add more dropdown items if needed -->
                        </div>
                         
                    </li>
                    <li>
                    <a class="btn btn-danger btn-logout" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                   
                       

                </ul>

                
            </div>
            <!-- And Sidebar -->
            <!-- Nav bar -->
            <div class="navbar-header1">
                <div class="text_navbar">
                    <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
                </div>
                <div class="containera">
                    <div class="contenta1">
                        <div style="color: #3498DB ;">
                            
