<?php include ('include/view_profile.php');?>
            <div class="containera">
                <div class="contenta">
            </header>
            <div class="container-a">
                <div class="container-xl px-4 mt-4">
                    <hr class="mt-0 ">
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                    <div class="card-body text-center">
                                    <?php
        // Assuming $userData['images'] contains the path or URL to the image
        $imagePath = $userData['images'];

        

        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            // If it's a URL, directly display it
            echo '<img src="' . htmlspecialchars(__DIR__ . '/' . $imagePath) . '" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover;">';

        } elseif (file_exists($imagePath)) {
            // If it's a local file, display it
            echo '<img src="' . htmlspecialchars($imagePath) . '" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover;">';
        } else {
            // If the file doesn't exist or it's not a valid URL, display an error message
            echo "Image not found!";
        }
        ?>

                                </div>

                                </div>
                            </div>
                            <div class="col-xl-8">
                                <!-- Account details card-->
                                <div class="card mb-4">
                                    <div class="card-header">Account Details</div>
                                    <div class="card-body">
                                    <form id="profileForm" action="update_profile.php" method="POST">
                                            <div class="mb-3">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="<?php echo $userData['username']; ?>">
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputFirstName">First name</label>
                                                    <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="<?php echo $userData['first_name']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputLastName">Last name</label>
                                                    <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="<?php echo $userData['last_name']; ?>">
                                                </div>
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputDepartment">Department</label>
                                                    <input class="form-control" id="inputDepartment" type="text" placeholder="Enter your department" value="<?php echo $userData['department']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputSkills">Skills</label>
                                                    <input class="form-control" id="inputSkills" type="text" placeholder="Enter your skills" value="<?php echo $userData['skills']; ?>">
                                                </div>
                                            </div>
                                            <div class="row gx-3 mb-3">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputEmail">Email</label>
                                                    <input class="form-control" id="inputEmail" type="email" placeholder="Enter your email" value="<?php echo $userData['gmail']; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1" for="inputPhoneNumber">Phone Number</label>
                                                    <input class="form-control" id="inputPhoneNumber" type="tel" placeholder="Enter your phone number" value="<?php echo $userData['phone_number']; ?>">
                                                </div>
                                            </div>
                                            <a class="btn btn-primary" href="edit_profile.php">Edit Profile</a>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function toggleEditMode() {
                        var formElements = document.querySelectorAll("form input, form select");
                        var editButton = document.querySelector(".btn-primary");

                        // Toggle disabled attribute for form elements
                        formElements.forEach(function (element) {
                            element.disabled = !element.disabled;
                        });

                        // Change button text based on edit mode
                        if (formElements[0].disabled) {
                            editButton.innerText = "Edit Profile";
                        } else {
                            editButton.innerText = "Save Changes";
                        }
                    }
                </script>
                <!-- Bootstrap JavaScript Libraries -->
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            </body>
            </html>
