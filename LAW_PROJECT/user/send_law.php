<?php
session_start();
include ('../conn_db.php');

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or show an error message
    header("Location: login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Calculate the difference between fromDate and toDate
    $diff = abs(strtotime($toDate) - strtotime($fromDate));
    $daysDifference = floor($diff / (60 * 60 * 24));

    // Check if the difference exceeds 3 days
    if ($daysDifference > 3) {
        // Redirect back to the form page with an error message
        header("Location: form_page.php?error=Duration between fromDate and toDate exceeds the limit of 3 days.");
        exit();
    } else {
        // Proceed with processing the form data
        // Your code to process the form data goes here
    }
}
?>

<!-- // header for home page -->
<?php include("include/sidebar_navbar.php"); ?>
<!-- // header for home page -->
<div class="containera">
    <div class="contenta">
        <br>
        <div class="container-a">
            <div class="input-box">
                <form action="process_send_law.php" method="post" id="myForm">
                    <div class="input-box">
                        <label for="fromDate" class="label">ចាប់ពីថ្ងៃទី*:</label>
                        <input type="date" id="fromDate" name="fromDate" required>
                    </div>

                    <div class="input-box">
                        <label for="toDate" class="label">ដល់ថ្ងៃទី*:</label>
                        <input type="date" id="toDate" name="toDate" required disabled>
                    </div>

                    <div class="input-box">
                        <label for="becuse" class="label">មូលហេតុ*:</label>
                        <textarea id="becuse" name="becuse" rows="4" cols="50" placeholder="សូមបំពេញពីមូលហេតុរបស់អ្នកនៅទីនេះ" required></textarea>
                    </div>

                    <button type="submit" class="styled-button">ដាក់ស្នើ</button>
                </form>
                <div class="toast" id="toast">
                    <div class="toast-content">
                        <div class="message">
                            <span class="text text-1">Success</span>
                            <span class="text text-2">Your changes have been saved</span>
                        </div>
                        <div class="progress-bar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Get the input elements
    const fromDateInput = document.getElementById('fromDate');
    const toDateInput = document.getElementById('toDate');

    // Add event listener to fromDateInput
    fromDateInput.addEventListener('change', function() {
        // Enable toDateInput
        toDateInput.disabled = false;

        // Calculate the maximum toDate considering 3 days limit
        const fromDate = new Date(this.value);
        const maxToDate = new Date(fromDate);
        maxToDate.setDate(fromDate.getDate() + 3);

        // Format the maxToDate as YYYY-MM-DD
        const maxToDateFormatted = maxToDate.toISOString().split('T')[0];

        // Set the max attribute of toDateInput
        toDateInput.setAttribute('max', maxToDateFormatted);

        // Reset toDateInput value if it exceeds the maxToDate
        if (new Date(toDateInput.value) > maxToDate) {
            toDateInput.value = maxToDateFormatted;
        }

        // Reset toDateInput value if it precedes the fromDate
        if (new Date(toDateInput.value) < fromDate) {
            toDateInput.value = this.value;
        }
    });

    // Add event listener to toDateInput
    toDateInput.addEventListener('change', function() {
        // Get the selected fromDate
        const fromDate = new Date(fromDateInput.value);
        // Get the selected toDate
        const toDate = new Date(this.value);

        // Get the current date
        const currentDate = new Date();

        // Reset toDateInput value if it is before the current date or the fromDate
        if (toDate < fromDate) {
            // Set toDateInput value to the fromDate
            this.value = fromDateInput.value;
        } else if (toDate > currentDate) {
            // If toDate is after the current date, set it to the current date
            this.value = currentDate.toISOString().split('T')[0];
        }
    });
</script>





</body>
</html>
