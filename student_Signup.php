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
         
         $con = mysqli_connect("localhost","root","","advisingManagement") or die("Couldn't connect");
         if(isset($_POST['submit'])){
            $Student_id = $_POST['stId'];
            $Student_name = $_POST['name'];
            $student_mail = $_POST['email'];
            $password = $_POST['password'];

      

         $s_query = mysqli_query($con,"SELECT stId FROM studentlogininfo WHERE stId='$Student_id'");

         if(mysqli_num_rows($s_query) !=0 ){
            echo "<div class='message'>
                      <p>You are already registered!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO studentlogininfo(stId,name,email,password) VALUES('$Student_id','$Student_name','$student_mail', '$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
            
            header("location: student_login.php");

         }

         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Student_id">ID</label>
                    <input type="text" name="stId" id="student_id" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Student_name">Name</label>
                    <input type="text" name="name" id="student_name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="student_mail">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <!--
                <div>


                <select name ="Student_department">
                    <label for="Student_department">Department</label>
                    <?php 
                        // $dept = mysqli_query($con,"select * from department order by D_id");
                        // while($dpt = mysqli_fetch_array($dept)){
                    ?>
                    <option value= "<?php echo $dpt['D_id'] ?>"><?php echo $dpt['D_id'] ?></option>
                    <?php 
                //} ?>
                </select>

                </div>
                  -->


                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="./student_login.php">Log In</a>
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
