<?php
// Include database connection parameters
include('../conn_db.php');

// Check if user_id is provided in the URL
if(isset($_GET['user_id'])) {
    // Define the user_id
    $user_id = $_GET['user_id']; // Assuming you're getting the user_id from the URL

    // Define the desired status
    $status = "អនុញ្ញាត"; // Change this to the desired status

    // Perform a SELECT query to fetch all data from the form_project table for a specific user_id and status
    $sql = "SELECT first_name, last_name, num_days, fromDate, toDate, becuse, department, status, status_date FROM form_project WHERE user_id = ? AND status = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the user_id and status parameters
    $stmt->bind_param("ss", $user_id, $status);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Set headers for Excel file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="exported_data.xls"');

    // Output Excel-specific HTML
    echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    echo '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"></head>';
    echo '<body>';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>គោត្តនាម</th><th>នាម</th><th>ចំនួនថ្ងៃ</th><th>ចាប់ពីថ្ងៃទី ខែ​ ឆ្នាំ</th><th>ដល់ថ្ងៃទី ខែ​ ឆ្នាំ</th><th>មូលហេតុ</th><th>ដេប៉ាតឺម៉ង់</th><th>សកម្មភាព</th><th>ពេលស្នើសុំច្បាប់</th></tr>';

    // Output data rows
    $i = 1; // Initialize sequential ID counter
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>$i</td>"; // Output sequential ID
        foreach ($row as $value) {
            echo "<td>$value</td>"; // Output value
        }
        echo '</tr>';
        $i++; // Increment sequential ID counter
    }

    echo '</table>';
    echo '</body>';
    echo '</html>';

    // Close the statement
    $stmt->close();
} else {
    echo "User ID not provided.";
}
?>
