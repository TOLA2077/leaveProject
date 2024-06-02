<?php include ('include/index_admin.php');?>

<div style="color: #3498DB;">
    <p>កែប្រែពត៌មានគ្រូបង្រៀន</p>
</div>

<div class="container-a">
    <div class="input-box">
        <?php
        include('../conn_db.php');

        // Assuming you have retrieved details from the database and stored them in $row
        $id = $_GET['id']; // Assuming you are passing the ID through the URL

        // Fetch details from the database using $id
        $sql = "SELECT * FROM user_info WHERE user_id = $id";
        $result = $conn->query($sql);

        // Display details
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>

            <form method="post" action="update_user.php">
                <div class="input_field">
                    <label for="firstName">នាម:</label>
                    <input type="text" id="firstName" name="first_name" value="<?php echo $row['first_name']; ?>" required>

                    <label for="lastName">គោត្តនាម:</label>
                    <input type="text" id="lastName" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                </div>

                <div class="input_field">
                    <label for="role">តំណែង:</label>
                    <select id="role" name="role" required>
                        <option value="user" <?php echo ($row['role'] == 'user') ? 'selected' : ''; ?>>គ្រូបង្រៀន</option>
                        <option value="staff" <?php echo ($row['role'] == 'staff') ? 'selected' : ''; ?>>ប្រធានដេប៉ាតឺម៉ង់</option>
                    </select>

                    <label for="department">ដេប៉ាតឺម៉ង់/បុគ្គលិកការរិយាល័យ:</label>
                  <select id="department" name="department" required>
                      <option value="computer" <?php echo ($row['department'] == 'computer') ? 'selected' : ''; ?>>កុំព្យូទ័រ</option>
                      <option value="animal" <?php echo ($row['department'] == 'animal') ? 'selected' : ''; ?>>បស្សុវប្បកម្ម</option>
                      <!-- Add more options as needed -->
                  </select>
                </div>

                <div class="input_field">
                    <label for="username">ឈ្មោះអ្នកប្រើប្រាស់:</label>
                    <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>

                    <label for="password">ពាក្យសម្ងាត់:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="input_field">
                    <label for="phoneNumber">លេខទូរស័ព្ទ:</label>
                    <input type="text" id="phoneNumber" name="phone_number" value="<?php echo $row['phone_number']; ?>" required>

                    <label for="gmail">អ៊ីម៉ែល:</label>
                    <input type="text" id="gmail" name="gmail" value="<?php echo $row['gmail']; ?>" required>
                </div>

                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                <input type="submit" value="កែប្រែ">
            </form>

            <?php
        } else {
            echo "<p>No details found for the given ID.</p>";
        }

        // Close the connection when you're done
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
