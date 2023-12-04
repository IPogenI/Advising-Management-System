<!DOCTYPE html>
<html>
<head>
    <title>Faculty Form</title>
    <style>
        /* Add your CSS here */
    </style>
</head>
<body>
    <form id="facultyForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="faculty_id">Faculty ID:</label><br>
        <input type="text" id="faculty_id" name="faculty_id" required><br>
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br>
        <label for="middle_name">Middle Name:</label><br>
        <input type="text" id="middle_name" name="middle_name"><br>
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="department">Department:</label><br>
        <input type="text" id="department" name="department" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>
    <script>
        // Add your JavaScript here
    </script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "advising";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO faculty (faculty_id, first_name, middle_name, last_name, email, department, password)
    VALUES ('".$_POST["faculty_id"]."', '".$_POST["first_name"]."', '".$_POST["middle_name"]."', '".$_POST["last_name"]."', '".$_POST["email"]."', '".$_POST["department"]."', '".$_POST["password"]."')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("location: success.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
