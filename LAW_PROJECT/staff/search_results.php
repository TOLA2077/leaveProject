<?php
// Include your database connection file
include '../conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Function to search records between fromDate and toDate
    function searchRecords($fromDate, $toDate, $conn) {
        // Perform a SELECT query based on fromDate and toDate
        $sql = "SELECT * FROM form_project WHERE fromDate >= ? AND toDate <= ?";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ss", $fromDate, $toDate);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the records
        $records = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();

        return $records;
    }

    // Example usage:
    $searchResults = searchRecords($fromDate, $toDate, $conn);

    // Display the search results
    if (!empty($searchResults)) {
        foreach ($searchResults as $record) {
            // Output the data as needed
            echo "ID: " . $record['id'] . ", fromDate: " . $record['fromDate'] . ", toDate: " . $record['toDate'] . "<br>";
        }
    } else {
        echo "No records found between $fromDate and $toDate.";
    }
}

// Close the database connection
$conn->close();
?>
