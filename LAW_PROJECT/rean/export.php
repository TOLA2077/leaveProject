<?php

// Include the autoload.php file from PhpSpreadsheet
require_once 'PHPExcel/PHPExcel.php'; // Adjust the path accordingly
// Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Create a new Xlsx Writer object
$Excel_writer = new Xlsx($spreadsheet);

// Get the active sheet
$activeSheet = $spreadsheet->getActiveSheet();

// Set column headers
$activeSheet->setCellValue('A1', 'Name');
$activeSheet->setCellValue('B1', 'Age');
$activeSheet->setCellValue('C1', 'Gender');
$activeSheet->setCellValue('D1', 'Phone');
$activeSheet->setCellValue('E1', 'My City');

// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "new_project";

// Connect to the database
$connect = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the database
$query = "SELECT * FROM student";
$statement = mysqli_query($connect, $query);

// Check if there are rows returned
if (mysqli_num_rows($statement) > 0) {
    $i = 2;
    // Loop through the rows and populate the spreadsheet
    while ($row = mysqli_fetch_assoc($statement)) {
        $activeSheet->setCellValue('A'.$i, $row['name']);
        $activeSheet->setCellValue('B'.$i, $row['age']);
        $activeSheet->setCellValue('C'.$i, $row['gender']);
        $activeSheet->setCellValue('D'.$i, $row['phone']);
        $activeSheet->setCellValue('E'.$i, $row['city']);
        $i++;
    }
}

// Close the database connection
mysqli_close($connect);

// Generate a random filename for the Excel file
$randomFilename = 'export_' . uniqid() . '.xlsx';

// Set headers to force download of the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $randomFilename . '"');
header('Cache-Control: max-age=0');

// Save the Excel file to output
$Excel_writer->save('php://output');

?>
