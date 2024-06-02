<?php
include('../conn_db.php');

$searchResults = array();

function searchRecords($fromDate, $toDate, $department, $search, $conn) {
    $sql = "SELECT  first_name, last_name, num_days, fromDate, toDate, becuse, department, status, status_date FROM form_project WHERE 1";

    if (!empty($fromDate) && !empty($toDate)) {
        $sql .= " AND fromDate <= ? AND toDate >= ?";
    }

    if (!empty($department)) {
        $sql .= " AND department = ?";
    }

    if (!empty($search)) {
        $sql .= " AND CONCAT(first_name, ' ', last_name) LIKE CONCAT('%', ?, '%')";
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

    if (!empty($search)) {
        $paramTypes .= 's';
        $bindParams[] = $search;
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
    $search = $_POST['search'];

    $searchResults = searchRecords($fromDate, $toDate, $department, $search, $conn);
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

<?php include("include/index_staff.php"); ?>
<style>
    .search2 {
        justify-content: flex-end;
        display: flex;
    }

    .search-button1 {
        /* Add your button styles here */
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-button:hover {
        background-color: #58f59a;
    }



    .search1 {
        font-family: "Khmer OS Siemreap", Arial, sans-serif;
        font-size: 14px; /* Adjust the font size as needed */
    }

</style>

<div class="container1">
    <div class="sidebar">
        <div class="logo">
            <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
            <h1 style="color:#F4F6F6";">KSIT</h1>
        </div><br>
        <ul class="menu-list ">
            <li><a href="index.php" class="menu"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
            <li><a href="view_list_law.php" class="menu"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
            <li class="active"><a href="report.php" class="active"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
            <li><a href="view_list_teacher.php" class="menu"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
        </ul>
        <?php include('include/view_profile.php');?>
        <div class="profile-details">
            <a href="view_profile.php?user_id=<?php echo $userData['user_id']; ?>" class="profile-link" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <div class="profile-content">
                  
                    <?php
                    // Assuming $userData['images'] contains the path or URL to the image
                    $imagePath = $userData['images'];

                    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                        // If it's a URL, directly display it
                        echo '<img src="' . htmlspecialchars(__DIR__ . '/' . $imagePath) . '" alt="Profile Picture" style="width: 50px; height: 50px; align-items: center; object-fit: cover; border-radius: 50%;">';
                    } elseif (file_exists($imagePath)) {
                        // If it's a local file, display it
                        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Profile Picture" style="width: 50px; height: 50px; align-items: center; object-fit: cover; border-radius: 50%;">';

                    } else {
                        // If the file doesn't exist or it's not a valid URL, display an error message
                        echo "Image not found!";
                    }
                    ?>
                </div>
        <div class="name">
            <div class="profile_name" style="color:#FBFCFC; font-weight: bold; font-size: 14px;">
                <?php
                // Assuming $userData['first_name'] and $userData['last_name'] contain the first and last names
                echo htmlspecialchars($userData['first_name'] . ' ' . $userData['last_name']);
                ?>
            </div>
        </div>
    </a>
   <style>

             
  .table {  
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px; /* Adjust the top margin as needed */
    
}

.table th,
.table td {
    border: 1px solid #bfc1c2;
    background: #e1ecf3;
    text-align: left;
    padding: 8px;
    font-family: Khmer OS Siemreap;
    text-align: center;
    color: #1A5276;
    
}

.table th {
    background-color: #5f9cd9  ; /* Set the background color for table header cells */
    color: #ffffff; /* Set the text color for table header cells */
    

}
   </style>
</div>
    </div>
    <div class="navbar-header1" >
        <div class="text_navbar">
            <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
        </div>
        <div class="containera">
            <div class="contenta">
                <div style="color: #3498DB ;">
                    <p  style="font-family: Khmer OS Siemreap;">ផ្ទាំងបង្ហាញអំពីបញ្ជីការស្នើសុំច្បាប់</p>
                </div>
                <br>
                    <div class="search1">
                        <form method="post" action="">
                        <div class="row">
            <div class="col-md-3">
                <label for="fromDate" class="form-label">From Date:</label>
                <input type="date" id="fromDate" name="fromDate" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="toDate" class="form-label">To Date:</label>
                <input type="date" id="toDate" name="toDate" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="department" class="form-label">Department:</label>
                <select id="department" name="department" class="form-select">
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
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label">Search:</label>
                <input type="text" id="search" name="search" class="form-control" onkeyup="liveSearch()">
            </div>
        </div>
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
