<?php
// Headers for download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename=MyData.xls");

// Ensure no output before generating Excel content
ob_start();

// Include the file that generates Excel content
require('view_list_law.php');

// Capture the output
$excelContent = ob_get_clean();

// Output the captured Excel content
echo $excelContent;
?>
