<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: student_login.php");
    exit();
}
//checks if the user is logged in or not
//if not logged in, then it sends back the user to the login page 

include 'partial/_DBconnect.php';
//connecting database named "advising" on my local machine

$user_name = $_SESSION['user_name'];

// get student details from the database using the logged-in username
// here $user_name is retrieved from the form, and the user_name is the entity on database
$sql = "SELECT * FROM students WHERE user_name='$user_name'";
$result = mysqli_query($conn, $sql);
//$conn is the variable which holds the connection, it is created earlier in the _DBconnect.php file 

if (mysqli_num_rows($result) == 1) {
    $studentDetails = mysqli_fetch_assoc($result);
} else {
    // Handle the case where the user's data is not found in the database
    // You may redirect to an error page or display a message
    echo "Error: Student data not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    

    <div class="container my-4">
        <h1 class="text-center">Student Dashboard</h1>

        <!-- Display student details -->
        <ul>
            <li><strong>Student ID:</strong> <?php echo $studentDetails['student_id']; ?></li>
            <li><strong>Username:</strong> <?php echo $studentDetails['user_name']; ?></li>
            <li><strong>Email:</strong> <?php echo $studentDetails['email']; ?></li>
            <li><strong>Department:</strong> <?php echo $studentDetails['department']; ?></li>
            <li><strong>Admitted Semester:</strong> <?php echo $studentDetails['admitted_semester']; ?></li>
            
        </ul>
    </div>
    <!-- Bootstrap and other scripts here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
