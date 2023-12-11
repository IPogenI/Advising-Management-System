<?php include("header.php"); ?>
<?php include 'partial/_DBconnect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Student SignUp</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

            <?php 
            if(isset($_POST['submit'])){
                $Student_id = $_POST['stId'];
                $Student_name = $_POST['name'];
                $student_mail = $_POST['email'];
                $password = $_POST['password'];

        

            $s_query = mysqli_query($conn,"SELECT student_id FROM student WHERE student_id='$Student_id'");

            if(mysqli_num_rows($s_query) !=0 ){
                echo "<div class='message'>
                        <p>You are already registered!</p>
                    </div> <br>";
                echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
            }
            else{

                mysqli_query($conn,"INSERT INTO student(student_id, name, email, password) VALUES('$Student_id','$Student_name','$student_mail', '$password')") or die("Erroe Occured");

                echo "<div class='message'>
                        <p>Registration successfully!</p>
                    </div> <br>";
                echo "<a href='index.php'><button class='btn'>Login Now</button>";
            }

            }else{
            
            ?>

                <header class="align-self-center">Student SignUp</header>
                <form action="" method="post">
                    <div class="field input">
                        <input type="text" name="stId" id="student_id" autocomplete="off" placeholder="Student ID" required>
                    </div>

                    <div class="field input">
                        <input type="text" name="name" id="student_name" autocomplete="off" placeholder="Name" required>
                    </div>

                    <div class="field input">
                        <input type="text" name="email" id="email" autocomplete="off" placeholder="Email" required>
                    </div>
                    <div class="field input">
                        <input type="password" name="password" id="password" autocomplete="off" placeholder="Password" required>
                    </div>
                    <div class="links">
                        Already a member? <a href="index.php">Log In</a>
                    </div>
                    <div class="field button">
                        <input type="submit" class="btn" name="submit" value="Submit" required>
                    </div>
                </form>
            <?php } ?>
      </div>
    </div>
</body>
</html>
