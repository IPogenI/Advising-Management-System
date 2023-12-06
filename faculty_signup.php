<?php include("header.php"); ?>
<?php include 'partial/_DBconnect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Faculty SignUp</title>
</head>
<body>
<div class="container">
        <div class="box form-box">
            <header>Faculty SignUp</header>
            <form id="facultyForm" method="post" action="fdata_insert.php">
                <div class="field input">
                    <input type="text" name="faculty_id" id="faculty_id" autocomplete="off" placeholder="Faculty ID" required>
                </div>

                <div class="field input">
                    <input type="text" name="name" id="name" autocomplete="off" placeholder="Name" required>
                </div>

                <div class="field input">
                    <input type="text" name="email" id="email" autocomplete="off" placeholder="Email" required>
                </div>

                <div class="field input">
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="Password" required>
                </div>

                <div class="field button">
                    <input type="submit" class="btn" name="submit" value="Submit" required>
                </div>
                <div class="links">
                    Already a member? <a href="faculty_login.php">Log In</a>
                </div>
            </form> 
      </div>
    </div>
</body>
</html>

