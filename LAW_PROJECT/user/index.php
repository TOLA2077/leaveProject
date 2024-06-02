<?php
include('../conn_db.php');

// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: ../index.php");
    exit();
}

// Retrieve the current user's user ID from the session
$current_user_id = $_SESSION['user_id'];

// Query to get the total number of cases and total number of days
$queryTotal = "SELECT COUNT(*) AS total_cases, SUM(num_days) AS total_days FROM form_project WHERE user_id = $current_user_id AND status = 'អនុញ្ញាត'";

// Query to get the yearly number of cases
$queryYearly = "SELECT COUNT(*) AS yearly_cases, SUM(num_days) AS total_year FROM form_project WHERE user_id = $current_user_id AND status = 'អនុញ្ញាត' AND YEAR(fromDate) = YEAR(NOW())";

// Query to get the monthly number of cases
$queryMonthly = "SELECT COUNT(*) AS monthly_cases, SUM(num_days) AS total_month FROM form_project WHERE user_id = $current_user_id AND status = 'អនុញ្ញាត' AND MONTH(fromDate) = MONTH(NOW())";

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
            <!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
            <!-- Include Bootstrap CSS and Bootstrap Icons CSS from CDN -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link rel="stylesheet" href="style/main2.css">
            
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
                            <li class="active"><a href="index.php" class="active"><i class="fas fa-home"></i> ទំព័រដើម</a></li>
                            <li><a href="send_law.php" class="menu"><i class="fas fa-file-alt"></i> ស្នើសុំច្បាប់</a></li>
                            <li><a href="view_list_law.php" class="menu"><i class="fas fa-list"></i> បញ្ជីច្បាប់</a></li>
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
        </div>
        <div class="navbar-header1">
            <div class="text_navbar">
                <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
            </div>
           
            <div class="containera">
                <div class="contenta">
                <div class="iteme">
    <a href="view_total_list_law.php">
        <div class="item-content bg-red">
            <p class="input_box"><i class="fas fa-chart-pie"></i> ចំនួនសុំច្បាប់សរុប: &nbsp; <?php echo $rowTotal['total_cases']; ?> &nbsp; ដង</p>
            <p class="input_box"><i class="fas fa-calendar-alt"></i> ចំនួនថ្ងៃសរុប: &nbsp; <?php echo $rowTotal['total_days']; ?></p>
        </div>
    </a>
    <a href="view_total_list_law_year.php">
        <div class="item-content bg-dak">
            <p class="input_box"><i class="fas fa-calendar-alt"></i> ចំនួនសុំច្បាប់ក្នុងឆ្នាំនេះ: &nbsp; <?php echo $rowYearly['yearly_cases']; ?> &nbsp; ដង</p>
            <p class="input_box"><i class="fas fa-calendar-alt"></i> ចំនួនថ្ងៃសរុប:   &nbsp; <?php echo $rowYearly['total_year']; ?></p>
        </div>
    </a>
    <div id="yearly_cases_table" style="display:none;">
        <!-- Your yearly cases table content goes here -->
    </div>
    <a href="view_total_list_law_month.php">
        <div class="item-content bg-dak">
            <p class="input_box"><i class="fas fa-calendar-alt"></i> ចំនួនសុំច្បាប់ក្នុងខែនេះ:  &nbsp;<?php echo $rowMonthly['monthly_cases']; ?> &nbsp; ដង</p>
            <p class="input_box"><i class="fas fa-calendar-alt"></i> ចំនួនថ្ងៃសរុប:  &nbsp;<?php echo $rowMonthly['total_month']; ?></p>
        </div>
    </a>
</div>
           