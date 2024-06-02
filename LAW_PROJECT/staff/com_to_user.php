<?php


// Include database connection
include '../conn_db.php';

if(!empty($_GET['id'])){
    $check_id = mysqli_query($conn, "SELECT * FROM form_project WHERE id = '". $_GET['id'] . "'");
    if ($check_id === false) {
        echo "Error: " . mysqli_error($conn); // Output the specific error message
        exit; // Terminate the script
    }

    if(mysqli_num_rows($check_id) > 0){
        $staff_id = $_GET['id'];
    } else {
        header("location: com_to_user.php");
        exit(0);
    }
}



// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    // Sanitize input data
    $id = $_POST['student_id']; // Changed from 'student_id' to 'staff_id'
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    
    // Update status and comment in the database
    $update_query = "UPDATE form_project SET status = 'មិនអនុញ្ញាត', comment = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);

    // Check if the prepare() method returned a prepared statement object
    if ($update_stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit; // Terminate the script
    }
    $update_stmt->bind_param("si", $comment, $id);

    if ($update_stmt->execute()) {  
        header("Location: index.php?success=true");
        exit();
    } else {
        echo "Error updating comment: " . $update_stmt->error;
    }
    
}
?>

<!-- Rest of your HTML code remains unchanged -->

<?php   include('include/index_staff.php');?>

<!-- HTML content starts here -->
<div class="container1">
    <div class="sidebar">
        <!-- Sidebar content -->
        <div class="logo">
            <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
            <h1 style="color:#F4F6F6;">KSIT</h1>
        </div>
        <br>
        <ul class="menu-list">
            <li class="active"><a href="index.php" class="active"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
            <li><a href="view_list_law.php" class="menu"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
            <li><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
            <li><a href="view_list_teacher.php" class="menu"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
        </ul>
        
    </div>
    <!-- And Sidebar -->
    <!-- Nav bar -->
    <div class="navbar-header1">
        <div class="text_navbar">
            <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
        </div>
        <style>
          .containera {
    width: 80%; /* Adjust as needed */
    padding: 30px;
    border: 2px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    margin-bottom: 15px;
    margin: 0 auto;
    margin-top: 70px;
}

.contenta {
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    color: black;
    font-family: Khmer OS Siemreap;
}

textarea {
    color: black;
    font-family: Khmer OS Siemreap;
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #559DE0; /* Green */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    justify-content: flex-end;

}

input[type="submit"]:hover {
    background-color: #45a049; /* Darker Green */
}
        </style>
        <div class="containera">
            <div class="contenta">
                <form action="" method="post">
                <input type="hidden" name="student_id" value = "<?=$staff_id;?>">
                    <label for="comment" style="font-size: 18px;">មូលហេតុ:</label>
                    <textarea id="comment" name="comment" rows="4" placeholder="សូមបំពេញពីមូលហេតុរបស់អ្នកនៅទីនេះ" required></textarea>
                    <input type="submit" name="submit_comment"  id="alertContainer" value="Submit">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- HTML content ends here -->
<script>
    // Check if the URL has a success parameter
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get('success');

    // If success parameter is present and true, show Bootstrap alert
    if (success === 'true') {
        // Get the container for the alert
        const alertContainer = document.getElementById('alertContainer');

        // Create the Bootstrap alert
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show';
        alertDiv.role = 'alert';
        alertDiv.innerHTML = '<strong>Success!</strong> Your comment has been submitted successfully.';
        
        // Create the close button for the alert
        const closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.className = 'btn-close';
        closeButton.setAttribute('data-bs-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Close');
        
        // Append the close button to the alert
        alertDiv.appendChild(closeButton);
        
        // Append the alert to the container
        alertContainer.appendChild(alertDiv);
    }
</script>
