<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Report</title>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $department = $_POST['department'];

    // Here you can perform any necessary database queries to fetch the data based on the form inputs
    // For demonstration purposes, I'm just using sample data
    $data = array(
        array("ល.រ", "ឈ្មោះ", "ដេប៉ាតឹម៉ង់", "ចាប់ពីថ្ងៃ ខែ ឆ្នាំ", "ដល់ថ្ងៃ ខែ ឆ្នាំ", "ចំនួនថ្ងៃ", "មូលហេតុ", "សកម្មភាព"),
        array("1", "HORCHANTHA", "វិទ្យាសាស្រ្តកុំព្យូទ័រ", "01/03/2024", "03/03/2024", "3", "go to home", "អនុញ្ញាត"),
        array("2", "HORCHANTHA", "វិទ្យាសាស្រ្តកុំព្យូទ័រ", "26/02/2024", "29/02/2024", "4", "ASDFGHJKL;", "អនុញ្ញាត"),
        // Add more data rows as needed
    );

    // Display the data in a table
    echo "<h2>Report</h2>";
    echo "<table>";
    foreach ($data as $row) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>$cell</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>

<!-- Button for exporting to Excel -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="fromDate" value="<?php echo isset($_POST['fromDate']) ? $_POST['fromDate'] : ''; ?>">
    <input type="hidden" name="toDate" value="<?php echo isset($_POST['toDate']) ? $_POST['toDate'] : ''; ?>">
    <input type="hidden" name="department" value="<?php echo isset($_POST['department']) ? $_POST['department'] : ''; ?>">
    <button type="submit">Export to Excel</button>
</form>

</body>
</html>
