<?php
session_start();

$botToken1 = '6988669129:AAEQpi79_e8jYu-LOGg9_q92Tm4jRDgrzYQ';
$chatId1 = '1568768103';
$chatId2 = '1891198658';

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}

// Include your database connection file
include '../conn_db.php';

// Get user ID and name from the session
$user_id = $_SESSION['user_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$department = $_SESSION['department'];

// Extract form data
$fromDate = mysqli_real_escape_string($conn, $_POST['fromDate']);
$toDate = mysqli_real_escape_string($conn, $_POST['toDate']);
$becuse = mysqli_real_escape_string($conn, $_POST['becuse']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Calculate the number of days
    $num_days = calculateNumberOfDays($fromDate, $toDate);

    // Create message with form data
    $message = "ជូនដំណឹងពីការសុំច្បាប់របស់បុគ្គលិក:\n\n";
    $message .= "ឈ្មោះ: $first_name $last_name\n";
    $message .= "ចំនួនថ្ងៃ: $num_days\n";
    $message .= "ចាប់ពីថ្ងៃ ខែ​ឆ្នាំ: $fromDate\n";
    $message .= "ដល់ថ្ងៃ ខែ ឆ្នាំ: $toDate\n";
    $message .= "មូលហេតុ: $becuse\n";

    // Send message to Chat ID 1
    sendMessage($botToken1, $chatId1, $message);

    // Send message to Chat ID 2
    sendMessage($botToken1, $chatId2, $message);

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO form_project (user_id, first_name, last_name, fromDate, toDate, becuse, num_days, department) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    // Use "ssssssi" for binding parameters
    $stmt->bind_param("ssssssis", $user_id, $first_name, $last_name, $fromDate, $toDate, $becuse, $num_days, $department);
    
    if (!$stmt->execute()) {
        echo '<script>alert("Error executing SQL statement.");</script>';
        // Log the error details for further investigation
        error_log("SQL Error: " . $stmt->error);
    } else {
        echo '<script>alert("Success"); window.location.href = "your_success_page.php";</script>';
    }
    
    $stmt->close();
    
    
}


// Close the database connection
$conn->close();


// Redirect back to the previous page or any other page
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();

function calculateNumberOfDays($fromDate, $toDate) {
    $fromDate = new DateTime($fromDate);
    $toDate = new DateTime($toDate);

    $interval = $fromDate->diff($toDate);

    // Add 1 to include both start and end dates in the count
    $num_days = $interval->days + 1;

    return $num_days;
}

function sendMessage($botToken, $chatId, $message) {
    $apiUrl = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        
    ];

    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    // Handle the result if needed
    // You can check $result for success or error information
    // Note: Consider adding error handling for production use

    return $result;
}
?>
