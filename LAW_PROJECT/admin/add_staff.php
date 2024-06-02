<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KSIT</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="styles.css" rel="stylesheet">
</head>
<body>

<?php include ('include/index_admin2.php');?>

<div class="container-a">
    <div class="input-box">
        <form action="insert_staff.php" method="post" enctype="multipart/form-data">
            <div class="input_field">
                <label for="firstName">នាម:</label>
                <input type="text" id="firstName" name="first_name" class="form-control" required>

                <label for="lastName">គោត្តនាម:</label>
                <input type="text" id="lastName" name="last_name" class="form-control" required>
            </div>

            <div class="input_field">
                <label for="role">តំណែង:</label>
                <select id="role" name="role" class="form-select" required>
                    <option value="admin">មន្រ្តីរដ្ឋាបាល</option>
                    <option value="staff">នាយក/នាយករង</option> 
                </select>
                <label for="department">ដេប៉ាតឺម៉ង់/បុគ្គលិកការរិយាល័យ:</label>
                <select id="department" name="department" class="form-select" required>
                    <option value="នាយក">នាយក</option>
                    <option value="នាយករង">នាយករង</option>
                    <option value="បុគ្គលិកការរិយាល័យរដ្ឋបាល">បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
                </select>
            </div>
            <div class="input_field">
                <label for="">តួនាទី:</label>
                <select id="skills" name="skills" class="form-select" required>
                    <option value="">នាយក</option>
                    <option value="">នាយករង</option>
                    <option value="">បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
                </select>

                <label for="phoneNumber">លេខទូរស័ព្ទ:</label>
                <input type="tel" id="phoneNumber" name="phone_number" class="form-control" required>
            </div>

            <div class="input_field">
                <label for="username">ឈ្មោះអ្នកប្រើប្រាស់:</label>
                <input type="text" id="username" name="username" class="form-control" required>

                <label for="password">ពាក្យសម្ងាត់:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="input_field">
                <label for="gmail">អ៊ីម៉ែល:</label>
                <input type="email" id="gmail" name="gmail" class="form-control" required>

                <label for="password">បញ្ចូលរូបភាពរបស់អ្នក:</label>
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            </div>

            <button type="submit" class="btn">បញ្ចួលគ្រូបង្រៀន</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
