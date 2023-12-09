<?php
    include 'partial/_DBconnect.php';
    include 'header.php'; 
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //here we are connecting the database through the _DBconnect file
    $stId = $_POST["student_id"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    //sql query here table name: students // modify as per needed 
    $sql = "SELECT * FROM student WHERE student_id='$stId' AND password='$password' AND email='$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
       header("location: studentDashboard.php");
        exit();
    } else {
        $loginError = "Invalid credentials. Please try again.";
    }
} 
?>

<!-- html and css code here  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
        
    <style>
        body {  
            background: #e4e9f7; /* White background for the body */
        }

        .container{
            padding-top: 7.5rem;
        }

        .login-container {
            background-color: #fff; /* Light ash color for the login container */
            border-radius: 8px;
            padding: 40px;
            margin: auto;
            margin-top: 100px; /* Adjust the top margin for centering */
            width: 450px;
            text-align: center;
            min-height: 400px;
            border-radius: 20px;
            box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
                0 32px 64px -48px rgba(0,0,0,0.5);
        }
        .login-container h1 {
            color: #000000; /* Black font for "Student Login" */
            font-size: 25px;
            margin-bottom: 1rem;
        }
        .form-control {
            background-color: #ffffff; /* White background for form inputs */
            color:#e9e9e9; /* Ash color for form input text */
            /* margin-bottom #007bff: 15px; */
            /* border-radius #007bff: 20px; */
            padding: 1.3rem;
        }
        .btn-blue {
            display: flex;
            align-self: center;
            background: rgba(49, 92, 242, 71%) !important; /* Blue color for the submit button */
            color: #ffffff; /* White font for the submit button */
            border-radius: 5px;
            width: fit-content;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <div class="container my-4">
        <div class="login-container">
            <h1>Student Login</h1>

            <?php
            //error handling
            if (isset($loginError)) {
                echo
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> ' . $loginError . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }
            ?>

            <form class="d-flex flex-column justify-content-center" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Student ID">
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="field button">
                        <input type="submit" class="btn" name="submit" value="Submit" required>
                </div>
                <div class="links">
                        Not Registered? <a href="student_Signup.php">Sign Up</a>
                </div>
            </form>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
