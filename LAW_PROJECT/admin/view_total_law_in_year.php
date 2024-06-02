<!-- Header for home page -->
<?php include("include/index_admin.php"); ?>

<?php
// Database connection parameters
include('../conn_db.php');

// Retrieve the current year
$current_year = date('Y');

// Retrieve project form submissions for the current year
$sql = "SELECT id, first_name, last_name, department, num_days, fromDate, toDate, becuse, status FROM form_project WHERE YEAR(fromDate) = ?";
$stmt = $conn->prepare($sql);

// Check if the statement preparation was successful
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $current_year);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>

<div class="containera">
    <div class="contenta">
        <div style="color: #3498DB ;">
            <p style="font-family: Khmer OS Siemreap;">ផ្ទាំងបង្ហាញអំពីបញ្ជីការស្នើសុំច្បាប់ឆ្នាំ <?php echo $current_year; ?></p>
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
                            if($row['status'] == 'អនុញ្ញាត'){
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['first_name'] . $row['last_name'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            echo "<td>" . $row['num_days'] . "</td>";
                            echo "<td>" . date('d/m/Y', strtotime($row['fromDate'])) . "</td>";
                            echo "<td>" . date('d/m/Y', strtotime($row['toDate'])) . "</td>";
                            echo "<td>" . $row['becuse'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='8'>No records found for the year $current_year.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
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
                    