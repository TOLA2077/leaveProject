<?php
if(isset($_GET['id'])) {
    // Fetch details based on the ID from the database
    $id = $_GET['id'];
    // Perform a database query and fetch details based on the $id
    // Display the edit status form with the fetched status

    // Example form
    echo "<form method='post' action='update_status.php'>";
    echo "<input type='hidden' name='id' value='" . $id . "' />";
    
    // Assuming 'status' is the column in your database table for status
    echo "<label for='status'>Select Status:</label>";
    echo "<select name='status'>";
    echo "<option value='allow'>Allow</option>";
    echo "<option value='not allow'>Not Allow</option>";
    echo "</select>";

    echo "<input type='submit' value='Update Status' />";
    echo "</form>";
} else {
    echo "Invalid ID";
}
?>
