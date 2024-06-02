<?php
include_once ('include/index_staff.php');
?>
<div class="containera">
    <div class="contenta">
        <div style="color: #3498DB ;">
            <p>ផ្ទាំងបង្ហាញអំពីព័ត៌មានលម្អិត</p>
        </div>
    </div>
    <?php
    include('../conn_db.php');

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Retrieve details for the selected record
        $sql = "SELECT id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date FROM form_project WHERE id = $id";
        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='details-container'>";

            echo "<div class='details-field'>
                    <div class='details-label'>នាម:</div>
                    <div class='details-value'>" . $row['first_name'] . "</div>

                    <div class='details-label'>គោត្តនាម:</div>
                    <div class='details-value'>" . $row['last_name'] . "</div>
                    
                  </div>";


            echo "<div class='details-field'>
                    <div class='details-label'>ចាប់ពី ថ្ងៃ ខែ​​ ឆ្នាំ:</div>
                    <div class='details-value'>" . $row['fromDate'] . "</div>

                    <div class='details-label'>ដល់​ថ្ងៃ ខែ​ ឆ្នាំ:</div>
                    <div class='details-value'>" . $row['toDate'] . "</div>
                  </div>";


            echo "<div class='details-field'>
                    <div class='details-label'>មូលហេតុ:</div>
                    <div class='details-value'>" . $row['becuse'] . "</div>

                    <div class='details-label'>ស្ថានភាព:</div  >
                    <div class='details-value'>" . $row['status'] . "</div>
                    
                  </div>";


            echo "<div class='details-field'>
                    <div class='details-label'>ពេលស្នើសុំច្បាប់:</div>
                    <div class='details-value'>" . $row['status_date'] . "</div>

                    <div class='details-label'>ចំនួនថ្ងៃ:</div>
                    <div class='details-value'>" . $row['num_days'] . "ថ្ងៃ</div>
                  </div>";

            echo "</div>";
        } else {
            echo "Record not found.";
        }

        $conn->close();
    } else {
        echo "Invalid request.";
    }
    ?>
</div>
