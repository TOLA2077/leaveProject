<?php
// Include necessary files, database connection, and session start
include('../conn_db.php');
include('include/index_staff.php');

// Check if user_id is set in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch total cases and total days
    $queryTotal = "SELECT COUNT(*) AS total_cases, status, SUM(num_days) AS total_days FROM form_project WHERE user_id = ? AND status = 'អនុញ្ញាត'";
    $stmtTotal = $conn->prepare($queryTotal);
    $stmtTotal->bind_param("s", $user_id);
    $stmtTotal->execute();
    $resultTotal = $stmtTotal->get_result();
    $rowTotal = $resultTotal->fetch_assoc();
    $stmtTotal->close();

    // Fetch yearly cases
    $queryYearly = "SELECT COUNT(*) AS yearly_cases, status, SUM(num_days) AS total_year FROM form_project WHERE user_id = ? AND YEAR(fromDate) = YEAR(NOW())AND status = 'អនុញ្ញាត'";
    $stmtYearly = $conn->prepare($queryYearly);
    $stmtYearly->bind_param("s", $user_id);
    $stmtYearly->execute();
    $resultYearly = $stmtYearly->get_result();
    $rowYearly = $resultYearly->fetch_assoc();
    $stmtYearly->close();

    // Fetch monthly cases
    $queryMonthly = "SELECT COUNT(*) AS monthly_cases, status, SUM(num_days) AS total_month FROM form_project WHERE user_id = ? AND MONTH(fromDate) = MONTH(NOW())AND status = 'អនុញ្ញាត'";
    $stmtMonthly = $conn->prepare($queryMonthly);
    $stmtMonthly->bind_param("s", $user_id);
    $stmtMonthly->execute();
    $resultMonthly = $stmtMonthly->get_result();
    $rowMonthly = $resultMonthly->fetch_assoc();
    $stmtMonthly->close();

    // Fetch user details
    $queryUserData = "SELECT * FROM user_info WHERE user_id = ?";
    $stmtUserData = $conn->prepare($queryUserData);
    $stmtUserData->bind_param("i", $user_id);
    $stmtUserData->execute();
    $resultUserData = $stmtUserData->get_result();
    $userData = $resultUserData->fetch_assoc();
    $stmtUserData->close();
?>

<?php
    // Fetch user details from the user_info table based on user_id
    $query = "SELECT * FROM user_info WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();


        $stmt->close();
        ?>
        <style>

.contenta {
    margin-top: 20px;
}

.contenta p {
    
    font-family: 'Khmer OS Siemreap', sans-serif;
}

.iteme {
    display: flex;
    justify-content: space-evenly;

}

.iteme a {
    text-decoration: none;
}

.item-content {

    padding: 20px;
    border-radius: 8px;
    color: #fff;
    

}

.text_box {
    color: #fff;
    margin-bottom: 10px;
}

.bg-red {

    background-color:#6082ae;
}

.bg-dak {

    background-color: #6082ae;
}

.bg-blue {

    background-color: #6082ae;
}
</style>
        <!-- Rest of your HTML and PHP code... -->
        <div class="container1">
            <div class="sidebar">
                <div class="logo">
                    <img src="img/Copy-of-Stamp-KSIT.png" alt="Logo" style="width: 70px;">
                    <h1 style="color:#F4F6F6";">KSIT</h1>
                </div><br>
                <!-- <div class="sidebar-am"> --> 
                <ul class="menu-list">
                    <li><a href="index.php" class="menu"><i class="fas fa-home menu-icon"></i>ទំព័រដើម</a></li>
                    <li><a href="view_list_law.php" class="menu"><i class="fas fa-list-alt menu-icon"></i>បញ្ជីឈ្មោះសុំច្បាប់</a></li>
                    <li ><a href="report.php" class="menu"><i class="fas fa-chart-bar menu-icon"></i>របាយការណ៍</a></li>
                    <li><a href="view_list_teacher.php" class="menu"><i class="fas fa-users menu-icon"></i>បញ្ជីអំពីបុគ្គលិក</a></li>
                </ul>

        

            </div>
            <!-- And Sidebar -->
            <!-- Nav bar -->
            <div class="navbar-header1" >
                <div class="text_navbar">
                    <p>ប្រព័ន្ធសុំច្បាប់របស់បុគ្គលិកនៅក្នុងវិទ្យាស្ថានបច្ចេកវិទ្យាកំពង់ស្ពឺ</p>
            </div>
            <div class="containera">
    <div class="contenta">
        <div style="color: #3498DB;">
            <p><i class="fas fa-info-circle"></i> ព័ត៌មានលម្អិតរបស់ <?php echo $userData['first_name'] . ' ' . $userData['last_name']; ?></p>
        </div>
        <div class="iteme">
            <a href="view_total_list_law.php?user_id=<?php echo $user_id; ?>">
                <div class="item-content bg-red">
                    <p class="text_box"><i class="fas fa-tasks"></i> ចំនួនសុំច្បាប់សរុប: &nbsp; <?php echo $rowTotal['total_cases']; ?></p>
                    <p class="text_box"><i class="far fa-calendar-alt"></i> ចំនួនថ្ងៃសរុប: &nbsp; <?php echo $rowTotal['total_days']; ?></p>
                </div>
            </a>
            <a href="view_total_list_law_year.php?user_id=<?php echo $user_id; ?>">
                <div class="item-content bg-dak">
                    <p class="text_box"><i class="fas fa-calendar-alt"></i> ចំនួនសុំច្បាប់ក្នុងឆ្នាំនេះ: &nbsp; <?php echo $rowYearly['yearly_cases']; ?></p>
                    <p class="text_box"><i class="far fa-calendar"></i> ចំនួនថ្ងៃសរុប:   &nbsp; <?php echo $rowYearly['total_year']; ?></p>
                </div>
            </a>
            <div id="yearly_cases_table" style="display:none;">
                <!-- Your yearly cases table content goes here -->
            </div>
            <a href="view_total_list_law_month.php?user_id=<?php echo $user_id; ?>">
                <div class="item-content bg-dak">
                    <p class="text_box"><i class="fas fa-calendar"></i> ចំនួនសុំច្បាប់ក្នុងខែនេះ:  &nbsp;<?php echo $rowMonthly['monthly_cases']; ?></p>
                    <p class="text_box"><i class="far fa-calendar"></i> ចំនួនថ្ងៃសរុប:  &nbsp;<?php echo $rowMonthly['total_month']; ?></p>
                </div>
            </a>
        </div>
    </div>
</div>


            <div class="container-a">
            <!-- Table for user details -->
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>ល.រ</th>
                        <th>ឈ្មោះ</th>
                        <th>ចំនួនថ្ងៃ</th>
                        <th>ចាប់ពី ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                        <th>ដល់ ថ្ងៃ ខែ​​​ ឆ្នាំ</th>
                        <th>មូលហេតុ</th>
                        <th>ស្ថានភាព</th>
           
                    </tr>
                </thead>
                <tbody>
                <?php
    // Fetch user details from the user_info table based on user_id
    $query = "SELECT * FROM user_info WHERE user_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();

        $stmt->close();

        // Fetch and display user details from the form_project table
        $sql = "SELECT user_id, first_name, last_name, num_days, fromDate, toDate, becuse, status, status_date FROM form_project WHERE user_id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if ($result->num_rows > 0) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    if( $row['status'] == "អនុញ្ញាត"){
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['num_days']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fromDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['toDate']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['becuse']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        
                      
                        echo "</tr>";
                    }
                   
                }

                echo '</tbody>
                    </table>';
            } else {
                echo "No records found for the current user.";
            }
        } else {
            echo "Prepare failed: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Handle the case when user_id is not set in the URL
    echo "User ID not provided.";
}

// Close the database connection
$conn->close();
?>
                </tbody>
            </table>
        </div>
        </div>

       
    </body>
    </html>
<?php
} // Close the outer if statement
?>
