<?php $connect = mysqli_connect("localhost","root","","test");
   
   if(isset($_POST['submit']))
   {
       $name = $_POST['name'];
       $age = $_POST['age'];
       $gender = $_POST['gender'];
       $phone = $_POST['phone'];
       $city = $_POST['city'];

       $sql = "INSERT into student(name,age,gender,phone,city)VALUES('$name','$age','$gender','$phone','$city')";
       $query = mysqli_query($connect,$sql);

       header('Location:index.php');
    }

?>
 <h4 class="text-center  ml-4 mb-5">Insert Records</h4>
     <form  action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        
        <div class="form-group">
         <input type="text" class="form-control  mb-4" name="name" placeholder="Enter name" required="">
        </div>

        <div class="form-group">
         <input type="text" class="form-control  mb-4" name="age" placeholder="Enter age" required="">
        </div>

        <span><strong>Select Gender : </strong></span>
          Male <input type="radio" class=" mb-4" name="gender" value="Male" style="pointer:cursor">
          Female <input type="radio" class=" mb-4" name="gender" value="Female" style="pointer:cursor">
        <br> <br>

        <div class="form-group mt-3">
         <input type="text" class="form-control mb-4" name="phone" placeholder="Enter phone">
        </div>

        <div class="form-group">
         <input type="text" class="form-control mb-4" name="city" placeholder="Enter city" required="">
        </div>

        <input type="submit" name="submit" class="btn btn-primary btn-block" style="float:right;" value="Submit">
     </form>