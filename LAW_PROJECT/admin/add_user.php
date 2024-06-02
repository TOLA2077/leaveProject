<?php include ('include/index_admin3.php');?>
<!-- And Sidebar -->
<!-- Nav bar -->
<div style="color: #3498DB ;">
    <p>បញ្ចូលគ្រូបង្រៀន</p>
</div>
<div class="container-a">
    <div class="input-box">
        <form action="insert_user.php" method="post" enctype="multipart/form-data">

            <div class="input_field">
                <label for="firstName">នាម:</label>
                <input type="text" id="firstName" name="first_name" required>

                <label for="lastName">គោត្តនាម:</label>
                <input type="text" id="lastName" name="last_name" required>
            </div>

            <div class="input_field">
                <label for="role">តំណែង:</label>
                <select id="role" name="role" required>
                    <option value="user">USER</option>
          
                </select>

                <label for="department">ដេប៉ាតឺម៉ង់/បុគ្គលិកការរិយាល័យ:</label>
                <select id="department" name="department" required>
                    <option >វិទ្យាសាស្រ្តកុំព្យូទ័រ</option>
                    <option >បស្សុវប្បកម្ម</option>
                    <option >បច្ចេកវិទ្យាអគ្គីសនី</option>
                    <option >បច្ចេកវិទ្យាអាហារ</option>
                    <option >វិទ្យាសាស្រ្តដំណាំ</option>
                    <option >បស្សុវប្បកម្ម៩+៣</option>
                    <option >បុគ្គលិកការរិយាល័យ</option>
                    <option >បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
                </select>
            </div>
            <div class="input_field">
                <label for="">តួនាទី:</label>
                <select id="skills" name="skills" required>
                    <option >គ្រូបង្រៀន</option>
                    <option >ប្រធានដេប៉ាតឹម៉ង់</option>
                    <option >បុគ្គលិកការរិយាល័យ</option>
                    <option >បុគ្គលិកការរិយាល័យរដ្ឋបាល</option>
    
                </select>

              <label for="phoneNumber">លេខទូរស័ព្ទ:</label>
                <input type="tel" id="phoneNumber" name="phone_number" required>
            </div>




            <div class="input_field">
                <label for="username">ឈ្មោះអ្នកប្រើប្រាស់:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">ពាក្យសម្ងាត់:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input_field">
                

                <label for="gmail">អ៊ីម៉ែល:</label>
                <input type="email" id="gmail" name="gmail" required>

                <label for="password">បញ្ចូលរូបភាពរបស់អ្នក:</label>
                <input type="file" name="images[]" accept="image/*" multiple require>

            </div>

            
            
           


                <button type="submit" class="btn" style="float: right;">បញ្ចួលគ្រូបង្រៀន</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
