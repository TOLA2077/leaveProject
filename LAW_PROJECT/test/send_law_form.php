<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}
?>

<!-- HTML form for sending a law -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Law</title>
</head>
<body>
    <h2>Send Law</h2>
    <form action="process_send_law.php" method="post">
        <!-- The user's name will be retrieved from the session -->
        <label for="fromDate">From Date:</label>
        <input type="date" id="fromDate" name="fromDate" required>

        <label for="toDate">To Date:</label>
        <input type="date" id="toDate" name="toDate" required>

        <label for="because">Because:</label>
        <textarea id="because" name="because" rows="4" required></textarea>

        <input type="submit" value="Send Law">
    </form>
</body>
</html>
