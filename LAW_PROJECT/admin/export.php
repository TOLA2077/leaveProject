<?php
// Include database connection parameters
include('../conn_db.php');

// Fetch data based on the provided criteria
$fromDate = $_POST['fromDate'];
$toDate = $_POST['toDate'];
$department = $_POST['department'];

// Perform a SELECT query based on fromDate, toDate, and department
$sql = "SELECT first_name, last_name, num_days, fromDate, toDate, becuse, department, status, status_date FROM form_project WHERE 1";

// Add condition for fromDate and toDate if provided
if (!empty($fromDate) && !empty($toDate)) {
    $sql .= " AND fromDate <= ? AND toDate >= ?";
}

// Add condition for department if provided
if (!empty($department)) {
    $sql .= " AND department = ?";
}

// Add condition for status "អនុញ្ញាត"
$sql .= " AND status = 'អនុញ្ញាត'";

$stmt = $conn->prepare($sql);

// Bind parameters if they are provided
$paramTypes = '';
$bindParams = array();

if (!empty($fromDate) && !empty($toDate)) {
    $paramTypes .= 'ss';
    $bindParams[] = $toDate;
    $bindParams[] = $fromDate;
}

if (!empty($department)) {
    $paramTypes .= 's';
    $bindParams[] = $department;
}

if (!empty($paramTypes)) {
    // Bind parameters
    $stmt->bind_param($paramTypes, ...$bindParams);
}

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
?>
