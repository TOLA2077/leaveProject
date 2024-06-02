<?php 
include('include/index_admin.php'); 
?>
<div class="containera">
    <div class="contenta">
        <div style="color: #3498DB ;">
            <p>បញ្ជីឈ្មោះUSER</p>
        </div>
    </div>
</div>

<div class="container-a">
    <table class="table table-bordered" id="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>នាម</th>
                <th>គោត្តនាម</th>
                <th>ដំណែង</th>
                <th>ដេប៉ាតឺម៉ង់</th>
                <th>ឈ្មោះអ្នកប្រើប្រាស់</th>
                <th>អ៊ីម៉ែល</th>
                <th>លេខទូរស័ព្ទ</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../conn_db.php');
            // Function to delete a staff member
            function deleteStaffMember($staffId, $conn)
            {
                $stmt = $conn->prepare("DELETE FROM form_project WHERE user_id = ?");
                $stmt->bind_param("i", $staffId);

                if ($stmt->execute()) {
                    return true; // Deletion successful
                } else {
                    return false; // Deletion failed
                }
            }

            // Retrieve user data from the database
            $sql = "SELECT user_id, first_name, last_name, role, department,  username, gmail, phone_number, active FROM user_info";
            $result = $conn->query($sql);
            $i = 1;
            if (!$result) {
                // Output error message
                echo "Error: " . $conn->error;
            } else {
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // Check if the user's role is "staff"
                        if ($row['role'] == 'user') {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['gmail'] . "</td>";
                            echo "<td>" . $row['phone_number'] . "</td>";
                            echo "<td>";
                            if ($row['active'] == 1) {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                            echo "</td>";
                            echo "<td>";
                            echo "<a href='edit_user.php?id=" . $row['user_id'] . "'><i class='fas fa-edit'></i> Edit</a>";
                            echo "<a href='delete_staff.php?user_id=" . $row['user_id'] . "' onclick='return confirm(\"Are you sure you want to delete this staff member?\");'><i class='fas fa-trash'></i> Delete</a>";
                            // Toggle active status
                            echo "<a href='toggle_active.php?user_id=" . $row['user_id'] . "&active=" . ($row['active'] == 1 ? 0 : 1) . "'><i class='fas fa-toggle-" . ($row['active'] == 1 ? "on" : "off") . "'></i> Toggle Active</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='10'>0 results</td></tr>";
                }
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</div>
</body>
</html>
