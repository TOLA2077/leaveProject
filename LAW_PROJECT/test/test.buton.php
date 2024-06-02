<?php

// Assuming $row contains data about the project
$row = [
    'id' => 1,
    'status' => 'allow'
];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['project_id']) && isset($_POST['status'])) {
        $projectId = $_POST['project_id'];
        $status = $_POST['status'];

        // Toggle the status
        $newStatus = ($status == 'allow') ? 'not_allow' : 'allow';

        // Your processing logic based on the toggled status
        echo "Project ID $projectId status toggled to $newStatus.";
        // Add your database update or other processing logic here
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toggle Allow/Not Allow Button</title>
</head>
<body>

<form method="post" action="">
    <input type="hidden" name="project_id" value="<?= $row['id'] ?>">
    <input type="hidden" name="status" value="<?= $row['status'] ?>">
    <button type="submit">Toggle Allow/Not Allow</button>
</form>

</body>
</html>
