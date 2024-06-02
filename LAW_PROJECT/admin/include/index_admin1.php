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
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-g6Zs3eWMVm8x5Uu7Z3V58MxgFcPFKgcXr/gALi1LebIab3ZM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="css/main_admin.css">
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
                    <li class="active"><a href="index.php" class="menu"><i class="fas fa-home"></i> ទំព័រដើម</a></li>
                    <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    
                    <li><a href="add_staff.php" class="menu"><i class="fas fa-user-plus"></i> បន្ថែមអ្នកអនុញ្ញាត</a></li>
                    
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
            <div class="navbar-header1">
                <div class="text_navbar">
                    <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
                </div>
                <div class="containera">
                    <div class="contenta1">
                        <div style="color: #3498DB ;">
                            
