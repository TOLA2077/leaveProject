<?php
include('../conn_db.php');

$searchResults = array();

function searchRecords($fromDate, $toDate, $department, $conn) {
    $sql = "SELECT  first_name, last_name, num_days, fromDate, toDate, becuse, department, status, status_date FROM form_project WHERE 1";

    if (!empty($fromDate) && !empty($toDate)) {
        $sql .= " AND fromDate <= ? AND toDate >= ?";
    }

    if (!empty($department)) {
        $sql .= " AND department = ?";
    }
    
    $stmt = $conn->prepare($sql);

    $paramTypes = '';
    $bindParams = array();

    if (!empty($fromDate) && !empty($toDate)) {
        $paramTypes .= 'ss';
        $bindParams[] = $toDate;
        $bindParams[] = $fromDate;
    }

    if (!empty($department)) {
        $paramTypes .= 's';
        $bindParams[] = $department;
    }

    if (!empty($paramTypes)) {
        $stmt->bind_param($paramTypes, ...$bindParams);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $records = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    return $records;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $department = $_POST['department'];

    $searchResults = searchRecords($fromDate, $toDate, $department, $conn);
}

if (isset($_POST['export'])) {
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="exported_data.xls"');

    echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
    echo '<head><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"></head>';
    echo '<body>';
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Num Days</th><th>From Date</th><th>To Date</th><th>Because</th><th>Department</th><th>Status</th><th>Status Date</th></tr>';
    
    $i = 1;
    foreach ($searchResults as $row) {
        echo '<tr>';
        echo "<td>$i</td>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo '</tr>';
        $i++;
    }
    
    echo '</table>';
    echo '</body>';
    echo '</html>';

    exit;
}
?>

<?php include("include/index_admin.php"); ?>

       
</div>

        <div class="containera">
            <div class="contenta">
            <div style="color: #3498DB ;">
                    <p  style="font-family: Khmer OS Siemreap;">ផ្ទាំងបង្ហាញអំពីបញ្ជីការស្នើសុំច្បាប់</p>
                </div>
                <br>
                    <div class="search1">
                        <form method="post" action="">
                            <label for="fromDate" class="search-label ">ចាប់ពីថ្ងៃ ខែ​ ឆ្នាំ:</label>
                            <input type="date" id="fromDate" name="fromDate">
                            <label for="toDate" class="search-label" >ដល់ថ្ងៃ ខែ ឆ្នាំ:</label>
                            <input type="date" id="toDate" name="toDate">
                            <label for="department" class="search-label">ដេប៉ាតឺម៉ង់​:</label>
                            <select id="department" name="department" class="search-input">
                                <option value="">All Departments</option>
                                <option>វិទ្យាសាស្រ្តកុំព្យូទ័រ</option>
                                <option>បស្សុវប្បកម្ម</option>
                                <option>បច្ចេកវិទ្យាអគ្គីសនី</option>
                                <option>បច្ចេកវិទ្យាអាហារ</option>
                                <option>វិទ្យាសាស្រ្តដំណាំ</option>
                                <option>បស្សុវប្បកម្ម៩+៣</option>
                                <option>បុគ្គលិកការរិយាល័យ</option>
                                <option>បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
                            </select>
                            <button type="submit" class="search-button" name="view">View Data</button>
                        </form>
                    </div>
                <div class="container-a">
                    <table class="table table-bordered" id="my-data-table">
                        <thead>
                                                 <!-- Export to Excel button outside the table -->
    <div class="search2">
        <form method="post" action="export.php">
            <input type="hidden" name="fromDate" value="<?php echo isset($_POST['fromDate']) ? $_POST['fromDate'] : ''; ?>">
            <input type="hidden" name="toDate" value="<?php echo isset($_POST['toDate']) ? $_POST['toDate'] : ''; ?>">
            <input type="hidden" name="department" value="<?php echo isset($_POST['department']) ? $_POST['department'] : ''; ?>">
            <button type="submit" class="search-button1">
            <i class="fas fa-file-excel"></i> Export to Excel
    </button>
        </form>
    </div>
                            <tr>
                                <th>ល.រ</th>
                                <th>ឈ្មោះ</th>
                                <th>ដេប៉ាតឹម៉ង់</th>
                                <th>ចាប់ពីថ្ងៃ ខែ ឆ្នាំ</th>
                                <th>ដល់ថ្ងៃ ខែ ឆ្នាំ</th>
                                <th>ចំនួនថ្ងៃ</th>
                                <th>មូលហេតុ</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($searchResults as $value) {
                                if($value['status'] == 'អនុញ្ញាត'){
                                    echo "<tr>";
                                    echo "<td>" . $i++ . "</td>";
                                    echo "<td>" . $value['first_name'] . " " . $value['last_name'] . "</td>";
                                    echo "<td>" . $value['department'] . "</td>";
                                    echo "<td>" . $value['fromDate'] . "</td>";
                                    echo "<td>" . $value['toDate'] . "</td>";
                                    echo "<td>" . $value['num_days'] . "</td>";
                                    echo "<td>" . $value['becuse'] . "</td>";
                                    echo "<td>" . $value['status'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
