<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $projectId = $_POST['project_id'];
        $action = $_POST['action'];

        // Your processing logic based on the clicked button
        if ($action == 'allow') {
            // Perform actions when 'Allow' button is clicked
            echo "Project ID $projectId has been allowed.";
            // Add your database update or other processing logic here
        } elseif ($action == 'not_allow') {
            // Perform actions when 'Not Allow' button is clicked
            echo "Project ID $projectId has not been allowed.";
            // Add your database update or other processing logic here
        }
    }
} else {
    // Redirect or handle the case where the form is accessed directly without submission.
    echo "Form submission only.";
}

?>
