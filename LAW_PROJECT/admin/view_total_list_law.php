<!-- Header for home page -->
<?php include("include/index_admin.php"); ?>

<?php
// Database connection parameters
include('../conn_db.php');



// Processing form submission (if form submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the button is clicked and update the status accordingly
    if (isset($_POST['status']) && isset($_POST['staff_id'])) {
        $staff_id = $_POST['staff_id'];
        $newStatus = ($_POST['status'] == 'អនុញ្ញាត') ? 'អនុញ្ញាត' : 'មិនអនុញ្ញាត';

        // Update the status in the database or your data source
        // Assuming you have a function like updateStatus($staffId, $newStatus)
        // You need to implement this function according to your database structure
        $sql = "UPDATE form_project SET status = '$newStatus' WHERE id = '$staff_id'";
        if (!$conn->query($sql) === TRUE) {
            die('Failed to update status.');
        }
    }
}



// Modify your SQL query to include LIMIT
$sql = "SELECT id, first_name, last_name, department,  num_days, fromDate, toDate, becuse, status, status_date FROM form_project ";
$result = $conn->query($sql);

?>

<div class="containera">
    <div class="contenta">
        <div style="color: #3498DB ;">
            <p style="font-family: Khmer OS Siemreap;">ផ្ទាំងបង្ហាញអំពីបញ្ជីការស្នើសុំច្បាប់</p>
        </div>
        <div class="container-a">
        <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                    <th>ID</th>
                        <th>ឈ្មោះ</th>
                        <th>ដេប៉ាតឹម៉ង់</th>
                        <th>ចំនួនថ្ងៃ</th>
                        <th>ចាប់ពីថ្ងៃ​ ខែ ឆ្នាំ</th>
                        <th>ដល់ថ្ងៃ​ ខែ ឆ្នាំ</th>
                        <th>មូលហេតុ</th>
                        <th>សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$i = 1;
// Display the table
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Corrected the not equal comparison operator
        if($row['status'] == 'អនុញ្ញាត'){
            echo "<tr>";
            echo "<td>" . $i++ . "</td>";
            echo "<td>" . $row['first_name'] . $row['last_name'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['num_days'] . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['fromDate'])) . "</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['toDate'])) . "</td>";
            
            echo "<td>" . $row['becuse'] . "</td>";
            echo "<td>";
            if ($row["status"] == 'អនុញ្ញាត') {
                echo "អនុញ្ញាត";
            } elseif ($row["status"] == 'មិនអនុញ្ញាត') {
                echo "មិនអនុញ្ញាត";
            } elseif ($row["status"] == 'បោះបង់ការស្នើសុំ') {
                echo "បានបោះបង់ការស្នើសុំ";
            }
            echo "</td>";
            // View, Edit, and Delete actions
            // echo "<td>";
            // echo "<a href='view_details.php?id=" . $row['id'] . "'><i class='fas fa-eye'>View Details</i></a>";
            // echo "</td>";
            echo "</tr>";
        }
    }
} else {
    echo "No records found for the current user.";
}
?>

                </tbody>
            </table>

            
       
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>
