<?php
// Include database connection
include '../conn_db.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: ../index.php");
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $staff_id = ($_POST['staff_id']); // Assuming staff_id is being submitted via POST method

    // Check if the record exists for the given staff_id
    $check_record_query = "SELECT COUNT(*) FROM form_project WHERE id=?";
    $check_record_stmt = $conn->prepare($check_record_query);

    // Check if the statement preparation succeeded
    if ($check_record_stmt === false) {
        echo "Error preparing check record statement: " . $conn->error;
        exit();
    }

    // Bind parameters
    $bind_result = $check_record_stmt->bind_param("i", $staff_id);

    // Check if binding parameters succeeded
    if ($bind_result === false) {
        echo "Error binding parameters: " . $check_record_stmt->error;
        exit();
    }

    // Execute the check record statement
    $check_record_stmt->execute();
    $check_record_stmt->bind_result($record_count);
    $check_record_stmt->fetch();
    $check_record_stmt->close();

    if ($record_count > 0) {
        // If record exists, update the comment
        $update_comment_query = "UPDATE form_project SET comment=? WHERE id=?";
        $update_comment_stmt = $conn->prepare($update_comment_query);

        // Check if the statement preparation succeeded
        if ($update_comment_stmt === false) {
            echo "Error preparing update comment statement: " . $conn->error;
            exit();
        }

        // Bind parameters
        $bind_result = $update_comment_stmt->bind_param("si", $comment, $staff_id);

        // Check if binding parameters succeeded
        if ($bind_result === false) {
            echo "Error binding comment parameters: " . $update_comment_stmt->error;
            exit();
        }

        // Execute comment update statement
        $execute_result = $update_comment_stmt->execute();

        // Check if execution succeeded
        if ($execute_result === false) {
            echo "Error updating comment: " . $update_comment_stmt->error;
            exit();
        }
    } else {
        // If record doesn't exist, insert a new record
        $insert_record_query = "INSERT INTO form_project (id, comment) VALUES (?, ?)";
        $insert_record_stmt = $conn->prepare($insert_record_query);

        // Check if the statement preparation succeeded
        if ($insert_record_stmt === false) {
            echo "Error preparing insert record statement: " . $conn->error;
            exit();
        }

        // Bind parameters
        $bind_result = $insert_record_stmt->bind_param("is", $staff_id, $comment);

        // Check if binding parameters succeeded
        if ($bind_result === false) {
            echo "Error binding record parameters: " . $insert_record_stmt->error;
            exit();
        }

        // Execute record insertion statement
        $execute_result = $insert_record_stmt->execute();

        // Check if execution succeeded
        if ($execute_result === false) {
            echo "Error inserting record: " . $insert_record_stmt->error;
            exit();
        }
    }

    // Redirect to appropriate page after successful update
    header("Location: com_to_user.php");
    exit();
}
?>
