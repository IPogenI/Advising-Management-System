<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         
         $con = mysqli_connect("localhost","root","","advising") or die("Couldn't connect");
         if(isset($_POST['submit'])){
            $Student_id = $_POST['student_id'];
            $Student_name = $_POST['student_name'];
            $student_mail = $_POST['email'];
            $Student_department = $_POST['department'];
            $password = $_POST['password'];

      

         $s_query = mysqli_query($con,"SELECT Student_id FROM student WHERE Student_id='$Student_id'");

         if(mysqli_num_rows($s_query) !=0 ){
            echo "<div class='message'>
                      <p>You are already registered!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO student(Student_id,Student_name,student_mail,Student_department,s_password) VALUES('$Student_id','$Student_name','$student_mail','$Student_department', '$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
         

         }

         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Student_id">ID</label>
                    <input type="number" name="Student_id" id="student_id" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Student_name">Name</label>
                    <input type="text" name="Student_name" id="student_name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="student_mail">Email</label>
                    <input type="text" name="student_mail" id="email" autocomplete="off" required>
                </div>


                <div>


                <select name ="Student_department">
                    <label for="Student_department">Department</label>
                    <?php 
                        $dept = mysqli_query($con,"select * from department order by D_id");
                        while($dpt = mysqli_fetch_array($dept)){
                    ?>
                    <option value= "<?php echo $dpt['D_id'] ?>"><?php echo $dpt['D_id'] ?></option>
                    <?php } ?>
                </select>

                </div>



                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Log In</a>
                </div>
                <div class="links">
                    Forgot Password? <a href="reset.php">Reset Password</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>
